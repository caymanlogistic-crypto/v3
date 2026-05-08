<?php

declare(strict_types=1);

namespace App\Core\Validation;

final class Validator
{
    private array $errors = [];

    public function required(
        string $field,
        mixed $value,
        ?string $message = null
    ): self {

        if (
            $value === null
            || trim((string) $value) === ''
        ) {

            $this->errors[$field][] =
                $message
                ?? "Field {$field} is required";
        }

        return $this;
    }

    public function minLength(
        string $field,
        string $value,
        int $length
    ): self {

        if (
            mb_strlen($value) < $length
        ) {

            $this->errors[$field][] =
                "Field {$field} minimum length {$length}";
        }

        return $this;
    }

    public function maxLength(
        string $field,
        string $value,
        int $length
    ): self {

        if (
            mb_strlen($value) > $length
        ) {

            $this->errors[$field][] =
                "Field {$field} maximum length {$length}";
        }

        return $this;
    }

    public function inn(
        string $field,
        string $value
    ): self {

        if (
            !preg_match(
                '/^\d{10,12}$/',
                $value
            )
        ) {

            $this->errors[$field][] =
                'Invalid INN format';
        }

        return $this;
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function fails(): bool
    {
        return !empty($this->errors);
    }
}
