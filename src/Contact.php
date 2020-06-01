<?php

namespace Epost;

class Contact extends GQL
{
    public function create(int $contactgroup_id, string $name, string $email = null, string $phone = null)
    {
        return $this->subscription([
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
