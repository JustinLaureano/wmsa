<?php

namespace App\Http\Requests\Auth;

use App\Domain\Auth\Enums\AuthMethodEnum;
use App\Repositories\TeammateRepository;
use App\Repositories\UserRepository;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ClockinRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'clock_number' => ['required', 'integer'],
            'building_id' => ['exists:buildings,id']
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $teammate = (new TeammateRepository)->findByClockNumber($this->input('clock_number'));

        if ( !$teammate ) {
            $this->loginFailed();
        }

        $user = (new UserRepository)->findBy('teammate_clock_number', $teammate->clock_number);

        if ( !$user ) {
            $this->loginFailed();
        }

        Auth::login($user);

        session([
            'auth_method' => AuthMethodEnum::CLOCK_NUMBER->value,
            'building_id' => $this->input('building_id')
        ]);

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'clock_number' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('clock_number')).'|'.$this->ip());
    }

    /**
     * Add a rate limit hit and fail the login with a response message.
     */
    protected function loginFailed() : void
    {
        RateLimiter::hit($this->throttleKey());

        throw ValidationException::withMessages([
            'clock_number' => trans('auth.failed'),
        ]);
    }
}
