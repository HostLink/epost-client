<?php

namespace Epost;

class API
{
    const SERVER = "https://api.e-post.com.hk/v4/";

    public $gql;
    public function __construct(string $token)
    {
        $this->token = $token;
        $this->gql = new \GQL\Client(self::SERVER . "?token=$token", [], ["verify" => false]);
    }

    public function getContactGroup(int $contactgroup_id, array $fields = ["contactgroup_id" => true, "name" => true])
    {
        $contactgroup = new ContactGroup($this->gql);
        return $contactgroup->get($contactgroup_id, $fields);
    }

    public function createContactGroup(string $name, string $remark = null, array $contacts = []): array
    {
        $contactgroup = new ContactGroup($this->gql);
        return $contactgroup->create($name, $remark);
    }

    public function deleteContactGroup(int $contactgroup_id): bool
    {
        $contactgroup = new ContactGroup($this->gql);
        return $contactgroup->delete($contactgroup_id);
    }

    public function listContactGroup(int $first = 25, int $offset = 0, array $fields = ["contactgroup_id" => true, "name" => true])
    {
        $contactgroup = new ContactGroup($this->gql);
        return $contactgroup->list($first, $offset, $fields);
    }

    public function createContact(int $contactgroup_id, string $name, string $email = null, string $phone = null)
    {

        return $this->gql->subscription([
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

    public function getContact($contact_id, array $fields)
    {
    }
}
