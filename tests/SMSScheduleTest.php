<?php

use Epost\API;
use PHPUnit\Framework\TestCase;

final class SMSScheduleTest extends TestCase
{
    public function getAPI()
    {
        $ini = parse_ini_file(__DIR__ . "/config.ini");
        return new API($ini["admin_token"]);
    }

    public function test_list()
    {
        $api = $this->getAPI();
        $objs = $api->listSMSSchedule();
        $this->assertGreaterThan(0, count($objs));
    }

    public function test_get()
    {
        $api = $this->getAPI();

        $a = $api->listSMSSchedule()->toArray()[0];

        $b = $api->getSMSSchedule($a["smsschedule_id"]);

        $this->assertEquals($a, $b);
    }
}
