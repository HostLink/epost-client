<?php

use Epost\API;
use PHPUnit\Framework\TestCase;

final class DeliveryTest extends TestCase
{
    public function getAPI()
    {
        $ini = parse_ini_file(__DIR__ . "/config.ini");
        return new API($ini["token"]);
    }
}
