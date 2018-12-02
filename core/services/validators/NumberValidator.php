<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace core\services\validators;

use core\interfaces\Validated;

class NumberValidator implements Validated
{
    public static function check($value): bool
    {
        if (is_integer($value) || is_float($value)) {
            return true;
        } else if (intval($value) > 0 || floatval($value) > 0) {
            return true;
        }

        return false;
    }
}