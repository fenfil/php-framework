<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace core\interfaces;

interface Validated
{
    public static function check($value) : bool;
}