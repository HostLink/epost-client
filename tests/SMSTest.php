<?php

use Epost\API;
use PHPUnit\Framework\TestCase;

final class SMSTest extends TestCase
{
    public function getAPI()
    {
        $ini = parse_ini_file(__DIR__ . "/config.ini");
        return new API($ini["admin_token"]);
    }

    public function test_list()
    {

        $api = $this->getAPI();
        $smss = $api->listSMS();

        $this->assertGreaterThan(0, count($smss));
    }
}
