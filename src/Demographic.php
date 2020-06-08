<?php

namespace Epost;

class Demographic extends GQL
{
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

    public function list(array $filter = [], int $first = 0, int $offset = 0, array $fields = []): array
    {
        $ret = $this->query([
            "listDemographic" => [
                "demographic_id" => true,
                "name" => true
            ]
        ]);
        return $ret["data"]["listDemographic"];
    }
}
