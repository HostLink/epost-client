<?php

namespace Epost;

class Schedule
{
    public static function Create(string $name, string $email = null, string $phone = null)
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
