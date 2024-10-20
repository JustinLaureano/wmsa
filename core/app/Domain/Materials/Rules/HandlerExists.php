<?php

namespace App\Domain\Materials\Rules;

use App\Domain\Materials\Enums\HandlerTypeEnum;
use App\Domain\Materials\Resolvers\HandlerResolver;
use App\Repositories\TeammateRepository;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class HandlerExists implements DataAwareRule, ValidationRule
{
    /**
     * All of the data under validation.
     *
     * @var array<string, mixed>
     */
    protected $data = [];

    /**
     * Set the data under validation.
     *
     * @param  array<string, mixed>  $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;
 
        return $this;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        \Illuminate\Support\Facades\Log::debug('handler type: '. $this->data['handler_type'] .' handler value: '. $value);

        if ( !HandlerResolver::getHandler($this->data['handler_type'], $value) ) {
            $fail('This handler does not exist.');
        }
    }
}
