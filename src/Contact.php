<?php

namespace Epost;

class Contact extends GQL
{
    const DEFAULT_FIELDS = ["contact_id", "contactgroup_id", "name", "email", "phone"];

    public function add(int $contactgroup_id, string $name, string $email = null, string $phone = null)
    {
        $ret = $this->subscription([
            "addContact" => [
                "__args" => [
                    "contactgroup_id" => $contactgroup_id,
                    "name" => $name,
                    "email" => $email,
                    "phone" => $phone
                ],
                "contact_id" => true
            ]
        ]);
        return $ret["data"]["addContact"];
    }
}
