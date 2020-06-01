<?php

namespace Epost;


class ContactGroup extends GQL
{
    public function get(int $contactgroup_id, array $fields)
    {
        $gql = $fields;
        $gql["__args"] = ["contactgroup_id" => $contactgroup_id];
        $resp = $this->query([
            "getContactGroup" => $gql
        ]);

        return $resp["data"]["getContactGroup"];
    }

    public function list(int $first, int $offset, array $fields)
    {
        $gql = $fields;
        $gql["__args"] = [
            "first" => $first,
            "offset" => $offset
        ];

        $resp = $this->query([
            "listContactGroup" => $gql
        ]);

        return $resp["data"]["listContactGroup"];
    }

    public function delete(int $contractgroup_id)
    {
        $resp = $this->mutation([
            "deleteContactGroup" => [
                "__args" => [
                    "contactgroup_id" => $contractgroup_id
                ]
            ]
        ]);
        return $resp["data"]["deleteContactGroup"];
    }

    public function create(string $name, string $remark = null)
    {
        $resp = $this->subscription([
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
}
