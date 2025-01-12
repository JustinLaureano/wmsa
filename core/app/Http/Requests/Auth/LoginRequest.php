<?php

namespace App\Http\Requests\Auth;

use App\Repositories\DomainAccountRepository;
use App\Repositories\UserRepository;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $rules = ['username' => ['required', 'string']];

        if ( !app()->environment(['local', 'testing']) ) {
            $rules['password'] = ['required', 'string'];
        }

        return $rules;
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if ( app()->environment(['local', 'testing']) ) {
            $this->authenticateLocal();
            return;
        }

        $this->authenticateProduction();
    }

    /**
     * Attempt to authenticate for local development
     * based on the given username.
     */
    public function authenticateLocal() : void
    {
        $domainAccount = (new DomainAccountRepository)->findBy('username', $this->input('username'));
        $user = (new UserRepository)->findBy('domain_account_guid', $domainAccount->guid);

        if ( !$user ) {
            $this->loginFailed();
        }

        Auth::login($user);

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Attempt to authenticate in production
     * based on the given username.
     */
    public function authenticateProduction() : void
    {
        $daRepository = new DomainAccountRepository();
        $domainAccount = $daRepository->findBy('username', $this->input('username'));
        $authenticated = $daRepository->validateCredentials($domainAccount->getDn(), $this->input('password'));

        if (!$authenticated) {
            $this->loginFailed();
        }

        $user = (new UserRepository)->findBy('domain_account_guid', $domainAccount->guid);

        if ( !$user ) {
            $this->loginFailed();
        }

        Auth::login($user);

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
            'username' => trans('auth.throttle', [
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
        return Str::transliterate(Str::lower($this->string('username')).'|'.$this->ip());
    }

    /**
     * Add a rate limit hit and fail the login with a response message.
     */
    protected function loginFailed() : void
    {
        RateLimiter::hit($this->throttleKey());

        throw ValidationException::withMessages([
            'username' => trans('auth.failed'),
        ]);
    }
}
