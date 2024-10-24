<?php

namespace App\Domain\Messaging\Rules;

use App\Domain\Messaging\Resolvers\MessengerResolver;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class MessengerExists implements DataAwareRule, ValidationRule
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
        $type = '';

        if ( isset($this->data['sender_type']) ) {
            $type = $this->data['sender_type'];
        }
        else if ( isset($this->data['participant_type']) ) {
            $type = $this->data['participant_type'];
        }

        if ( !MessengerResolver::getMessenger($type, $value) ) {
            $fail('This messenger does not exist.');
        }
    }
}
