<?php

use Epost\API;
use PHPUnit\Framework\TestCase;

final class ScheduleTest extends TestCase
{
    public function getAPI()
    {
        $ini = parse_ini_file(__DIR__ . "/config.ini");
        return new API($ini["token"]);
    }

    public function testCreate()
    {
        $api = $this->getAPI();


        //create group
        $contactgroup = $api->addContactGroup("raymond");
        $letter = $api->addLetter("raymond testing", "this is a testing email");


        $schedule = $api->addSchedule([$contactgroup["contactgroup_id"]], $letter["letter_id"], "raymond", "raymond@hostlink.com.hk", "2099-12-01", "10:00:00");

        $this->assertEquals($letter["letter_id"], $schedule["letter_id"]);
        $this->assertEquals("raymond", $schedule["sender_name"]);
        $this->assertEquals("raymond@hostlink.com.hk", $schedule["sender_email"]);
        $this->assertEquals("2099-12-01", $schedule["date"]);
        $this->assertEquals("10:00:00", $schedule["time"]);
        $this->assertNotEmpty($schedule["schedule_id"]);

        //get
        $b = $api->getSchedule($schedule["schedule_id"]);
        $this->assertEquals($schedule, $b);

        //list
        $schedules = $api->listSchedule()->toArray();
        $this->assertGreaterThan(0, count($schedules));

        //delete all
        foreach ($schedules as $schedule) {
            $this->assertTrue($api->deleteSchedule($schedule["schedule_id"]));
        }

        //should be zero
        $schedules = $api->listSchedule()->toArray();
        $this->assertEquals(0, count($schedules));
    }
}
