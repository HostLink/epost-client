<?php

namespace Epost;


class ContactGroup extends GQL
{
    const DEFAULT_FIELDS = ["contactgroup_id" => true, "name" => true];

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
