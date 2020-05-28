<?php
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);

use Epost\API;
use PHPUnit\Framework\TestCase;

final class APITest extends TestCase
{


    public function testCreate()
    {

        $ini = parse_ini_file(__DIR__ . "/config.ini");
        $api = new API($ini["token"]);
        $this->assertInstanceOf(API::class, $api);
    }
}
