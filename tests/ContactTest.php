<?php

use Epost\API;
use Epost\Contact;
use Epost\ContactGroup;
use PHPUnit\Framework\Constraint\IsType;
use PHPUnit\Framework\TestCase;

final class ContactTest extends TestCase
{
    public function getAPI()
    {
        $ini = parse_ini_file(__DIR__ . "/config.ini");
        return new API($ini["token"]);
    }

    public function testCreate()
    {
        $api = $this->getAPI();

        //create group first 
        $cg = $api->createContactGroup("test contact");
        $c = $api->createContact($cg["contactgroup_id"], "raymond", "raymond@hostlink.com.hk");
        $this->assertEquals("raymond", $c["name"]);
        $this->assertEquals("raymond@hostlink.com.hk", $c["email"]);
        $this->assertNotEmpty($c["contact_id"]);

        //test get
        $d = $api->getContact($c["contact_id"]);
        $this->assertEquals($c["name"], $d["name"]);
        $this->assertEquals($c["email"], $d["email"]);
        $this->assertEquals($c["contact_id"], $d["contact_id"]);

        //test delete
        $ret = $api->deleteContact($c["contact_id"]);
        $this->assertTrue($ret);


        //contact should be deleted
        $ret = $api->getContactGroup($cg["contactgroup_id"], ["Contact" => Contact::DEFAULT_FIELDS]);
        $this->assertArrayHasKey("Contact", $ret);
        $this->assertCount(0, $ret["Contact"]);
    }
}
