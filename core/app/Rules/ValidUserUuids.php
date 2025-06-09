<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidUserUuids implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check if the value is a valid JSON string
        // $uuids = json_decode($value, true);
        $uuids = array_unique($value);

        if (!is_array($uuids)) {
            $fail('The :attribute must be a valid JSON array of user UUIDs.');
            return;
        }

        // Ensure the array is not empty
        if (empty($uuids)) {
            $fail('The :attribute cannot be empty.');
            return;
        }

        // Check if all UUIDs exist in the users table
        $validUuidCount = User::whereIn('uuid', $uuids)->count();

        if ($validUuidCount !== count($uuids)) {
            $fail('The :attribute contains one or more invalid user UUIDs.');
        }
    }
}
