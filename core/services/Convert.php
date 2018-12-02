<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace core\services;

/**
 * Класс для упрощения конвертации и форматирования данных
 *
 * @package core\services
 */
class Convert
{
    /**
     * Метод очистки строки от лишних символов [$#!-+...]
     * Оставить: [ A-zА-я0-9_] -> [\w\d\s_]+
     * @param string $value
     *
     * @return string
     */
    public static function clearString(string $value)
    {
        $pattern = "/[^\w\d\s_]+/";

        $out = preg_replace($pattern, '', $value);

        return $out;
    }

    public static function errorMessage()
    {
        // return
    }
}