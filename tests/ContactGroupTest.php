<?php

use Epost\API;
use Epost\ContactGroup;
use PHPUnit\Framework\Constraint\IsType;
use PHPUnit\Framework\TestCase;

final class ContactGroupTest extends TestCase
{
    public function getAPI()
    {
        $ini = parse_ini_file(__DIR__ . "/config.ini");
        return new API($ini["token"]);
    }

    public function testCreate()
    {
        $api = $this->getAPI();
        $c = $api->createContactGroup("raymond test", "remark of raymond test");

        $this->assertEquals("raymond test", $c["name"]);
        $this->assertEquals("remark of raymond test", $c["remark"]);
    }

    public function testList()
    {

        foreach ($this->getAPI()->listContactGroup() as $g) {
            $this->assertInternalType(IsType::TYPE_INT, $g["contactgroup_id"]);
        }
    }

    public function testDelete()
    {
        $api = $this->getAPI();
        $c = $api->createContactGroup("raymond create");

        $ret = $api->deleteContactGroup($c["contactgroup_id"]);

        $this->assertTrue($ret);
    }

    public function testDeleteAll()
    {
        $api = $this->getAPI();
        foreach ($this->getAPI()->listContactGroup() as $g) {
            $api->deleteContactGroup($g["contactgroup_id"]);
        }

        $groups = $this->getAPI()->listContactGroup();
        $this->assertEquals(0, count($groups));
    }

    public function test_get()
    {
        $api = $this->getAPI();
        $a = $api->createContactGroup("raymond test", "remark of raymond test");

        $b = $api->getContactGroup($a["contactgroup_id"]);


        $this->assertEquals($a["name"], $b["name"]);
    }
}
