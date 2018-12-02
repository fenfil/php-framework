<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace tests;

use PHPUnit\Framework\TestCase;
use core\services\validators\NumberValidator;

class NumberValidatorTest extends TestCase
{
    public function numbersArray()
    {
        return [
            [4],
            [8],
            [15],
            ['20'],
            ['10.5'],
            ['A'],
            [16],
            [23],
            [42],
        ];
    }

    /**
     * @dataProvider numbersArray
     */
    public function testCheck($number)
    {
        $this->assertTrue(
            NumberValidator::check($number)
        );
    }
}
