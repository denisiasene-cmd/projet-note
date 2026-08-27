<?php
namespace App\Core;
class Validator
{
    public static function required(
        string $value,
        string $keyError,
        array &$errors,
        string $smsErrors = "Champ obligatoire"
    ): bool {
        if (empty($value)) {
            $errors[$keyError] = $smsErrors;
            return false;
        }

        return true;
    }

    public static function unique(
        string $value,
        string $keyError,
        array $data,
        array &$errors,
        string $smsErrors = "Ce champ doit être unique"
    ): bool {
        if (in_array($value, $data)) {
            $errors[$keyError] = $smsErrors;
            return false;
        }

        return true;
    }

    public static function isEmail(
        string $value,
        string $keyError,
        array &$errors,
        bool $required = true,
        string $smsErrors = "Cet email doit respecter ce format : fatou@gmail.com"
    ): bool {
        if ($required && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $errors[$keyError] = $smsErrors;
            return false;
        }

        return true;
    }

    public static function validPassword(
        string $value,
        string $keyError,
        array &$errors,
        bool $required = true,
        int $min = 4,
        string $smsErrors = "Ce champ doit contenir au moins 4 caractères."
    ): bool {
        if ($required && strlen($value) < $min) {
            $errors[$keyError] = $smsErrors;
            return false;
        }

        return true;
    }
}