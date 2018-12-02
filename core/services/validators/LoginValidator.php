<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace core\services\validators;

use core\interfaces\Validated;

class LoginValidator implements Validated
{

    public static function check($value): bool
    {
        return (mb_strlen($value) >= 8);
    }
}