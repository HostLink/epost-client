<?php

namespace Epost;


class ContactGroup extends GQL
{
    public function list(int $first, int $offset, array $fields)
    {

        $fields = array_flip($fields);
        $fields = array_map(function () {
            return true;
        }, $fields);

        $gql = $fields;
        $gql["__args"] = [
            "first" => $first,
            "offset" => $offset
        ];

        $resp = $this->gql->query([
            "listContactGroup" => $gql
        ]);

        return $resp["data"]["listContactGroup"];
    }

    public function delete(int $contractgroup_id)
    {
        $resp = $this->gql->mutation([
            "deleteContactGroup" => [
                "__args" => [
                    "contactgroup_id" => $contractgroup_id
                ]
            ]
        ]);
        return $resp["data"]["deleteContactGroup"];
    }

    public function create(string $name, string $remark)
    {
        $resp = $this->gql->subscription([
            "createContactGroup" => [
                "__args" => [
                    "name" => $name,
                    "remark" => $remark
                ],
                "contactgroup_id" => true,
                "name" => true,
                "remark" => true,
            ]
        ]);
        return $resp["data"]["createContactGroup"];
    }

    public function query(int $first, int $offset)
    {

        $this->api->query(["ContactGroup"]);
    }
}
