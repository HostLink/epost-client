<?php

use Epost\API;
use PHPUnit\Framework\TestCase;

final class LetterTest extends TestCase
{
    public function getAPI()
    {
        $ini = parse_ini_file(__DIR__ . "/config.ini");
        return new API($ini["token"]);
    }

    public function testCreate()
    {
        $api = $this->getAPI();


        //create
        $letter = $api->createLetter("hello", "test is a test mail");
        $this->assertEquals("hello", $letter["subject"]);
        $this->assertNotEmpty($letter["letter_id"]);

        //get
        $b = $api->getLetter($letter["letter_id"]);
        $this->assertEquals($letter, $b);

        //list
        $letters = $api->listLetter();
        $this->assertGreaterThan(0, count($letters));

        //delete all
        foreach ($letters as $letter) {
            $this->assertTrue($api->deleteLetter($letter["letter_id"]));
        }
    }
}
