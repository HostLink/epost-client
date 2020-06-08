<?php

use Epost\API;
use PHPUnit\Framework\TestCase;

final class DemographicTest extends TestCase
{
    public function getAPI()
    {
        $ini = parse_ini_file(__DIR__ . "/config.ini");
        return new API($ini["admin_token"]);
    }

    public function test_list()
    {
        $api = $this->getAPI();

        $api->addDemographic("hello");
        $datas = $api->listDemographic();
        $this->assertGreaterThan(0, $datas);


        $api->deleteDemographic("hello");

        $datas2 = $api->listDemographic();

        $this->assertLessThan(count($datas), count($datas2));
    }
}
