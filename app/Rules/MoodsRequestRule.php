<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use JsonException;

class MoodsRequestRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            if (!is_array($value) || empty($value)) {
                $fail('Could not parse');
            }

            foreach ($value as $key => $val) {
                if (!is_string($key) || !isset($val)) {
                    $fail('Structure should be key:value');
                }
            }

        } catch (JsonException $e) {
            $fail('Could not validate');
        }
    }
}
