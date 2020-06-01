<?php

namespace Epost;


class ContactGroup extends GQL
{
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
