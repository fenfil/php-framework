<?php
/**
 * Created by Artem Manchenkov
 * artyom@manchenkoff.me
 * manchenkoff.me © 2018
 */

namespace tests;

use core\services\Convert;
use PHPUnit\Framework\TestCase;

class ConvertTest extends TestCase
{
    public function testClearString()
    {
        $this->assertEquals(
            'Artur123012',
            Convert::clearString('Artur123#$0,.+12*'),
            'Artur is invalid!'
        );
    }
}
