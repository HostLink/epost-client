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
        $contact = new Contact($this->gql);
        return $contact->create($contactgroup_id, $name, $email, $phone);
    }

    public function getContact(int $contact_id, array $fields = ["contact_id" => true, "contactgroup_id" => true, "name" => true, "email" => true, "phone" => true])
    {
        $contact = new Contact($this->gql);
        return $contact->get($contact_id, $fields);
    }

    public function deleteContact(int $contact_id)
    {
        $contact = new Contact($this->gql);
        return $contact->delete($contact_id);
    }

    public function listContact(int $first = 25, int $offset = 0, array $fields = Contact::DEFAULT_FIELDS)
    {
        $contact = new Contact($this->gql);
        return $contact->list($first, $offset, $fields);
    }
}
