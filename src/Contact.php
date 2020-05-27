<?php

namespace Epost;

class Contact
{
    public static function Create(int $contactgroup_id, string $name, string $email = null, string $phone = null)
    {
        return API::subscription([
            "createContact" => [
                "__args" => [
                    "contactgroup_id" => $contactgroup_id,
                    "name" => $name,
                    "email" => $email,
                    "phone" => $phone
                ]
            ]
        ]);
    }
}
