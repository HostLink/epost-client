<?php
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);

use Epost\API;

require_once(__DIR__ . "/vendor/autoload.php");

$api = new API("eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJlLXBvc3QgYXBpIiwiaWF0IjoxNTkwNjM1NDk5LCJyb2xlIjoiVXNlcnMiLCJpZCI6NiwidHlwZSI6ImFjY2Vzc190b2tlbiJ9.BDQHWGdZ3EHOteM6mu8MqU_szHSXTIi--sNjziWDyCI");

$contactgroups = $api->listContactGroup()->toArray();
print_r($contactgroups);
