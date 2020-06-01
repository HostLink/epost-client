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

        //test update

        $api->updateContactGroup($b["contactgroup_id"], ["name" => "hello group"]);
        $c = $api->getContactGroup($b["contactgroup_id"]);
        $this->assertEquals("hello group", $c["name"]);
    }


    public function test_get_with_contact()
    {
        $api = $this->getAPI();
        $a = $api->createContactGroup("raymond test", "remark of raymond test");
        $api->createContact($a["contactgroup_id"], "raymond", "raymond@hostlink.com.hk", "12345678");

        $cg = $api->getContactGroup($a["contactgroup_id"], [
            "Contact" => [
                "contact_id" => true,
                "name" => true,
                "email" => true,
                "phone" => true
            ]
        ]);


        $this->assertArrayHasKey("Contact", $cg);
        $this->assertEquals("raymond", $cg["Contact"][0]["name"]);
        $this->assertEquals("raymond@hostlink.com.hk", $cg["Contact"][0]["email"]);
        $this->assertEquals("12345678", $cg["Contact"][0]["phone"]);
    }
}
