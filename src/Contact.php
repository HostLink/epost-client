<?php

namespace Epost;

class Contact extends GQL
{
    const DEFAULT_FIELDS = ["contact_id" => true, "contactgroup_id" => true, "name" => true, "email" => true, "phone" => true];

    public function create(int $contactgroup_id, string $name, string $email = null, string $phone = null)
    {
        $ret = $this->subscription([
            "createContact" => [
                "__args" => [
                    "contactgroup_id" => $contactgroup_id,
                    "name" => $name,
                    "email" => $email,
                    "phone" => $phone
                ],
                "contact_id" => true,
                "name" => true,
                "email" => true,
                "phone" => true
            ]
        ]);
        return $ret["data"]["createContact"];
    }

}
