<?php

namespace Epost;

class Demographic extends GQL
{
    const DEFAULT_FIELDS = ["name"];

    public function add(string $name)
    {
        $ret = $this->subscription([
            "addDemographic" => [
                "__args" => [
                    "name" => $name,
                ],
                "demographic_id" => true,
                "name" => true
            ]
        ]);
        return $ret["data"]["addDemographic"];
    }

    public function list(array $fields): array
    {
        $ret = $this->query([
            "listDemographic" => $fields
        ]);

        return array_map(function ($o) {
            return $o["name"];
        }, $ret["data"]["listDemographic"]);
    }

    public function remove(string $name)
    {
        $ret = $this->mutation([
            "deleteDemographic" => [
                "__args" => [
                    "name" => $name
                ]
            ]
        ]);

        return $ret["data"]["deleteDemographic"];
    }
}
