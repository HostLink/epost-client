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

    public function testDelete(){
        
    }
}
