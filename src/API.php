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

    //--- contact group ---
    public function getContactGroup(int $contactgroup_id, array $fields = ContactGroup::DEFAULT_FIELDS)
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

    public function listContactGroup(int $first = 25, int $offset = 0, array $fields = ContactGroup::DEFAULT_FIELDS)
    {
        $contactgroup = new ContactGroup($this->gql);
        return $contactgroup->list($first, $offset, $fields);
    }

    public function updateContactGroup(int $contactgroup_id, array $data, array $fields = ContactGroup::DEFAULT_FIELDS)
    {
        $contactgroup = new ContactGroup($this->gql);
        return $contactgroup->update($contactgroup_id, $data, $fields);
    }

    //--- contact ---
    public function createContact(int $contactgroup_id, string $name, string $email = null, string $phone = null)
    {
        $contact = new Contact($this->gql);
        return $contact->create($contactgroup_id, $name, $email, $phone);
    }

    public function getContact(int $contact_id, array $fields = Contact::DEFAULT_FIELDS)
    {
        $contact = new Contact($this->gql);
        return $contact->get($contact_id, $fields);
    }

    public function updateContact(int $contact_id, array $data, $fields = Contact::DEFAULT_FIELDS)
    {
        $contact = new Contact($this->gql);
        return $contact->update($contact_id, $data, $fields);
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

    //--- letter ---
    public function createLetter(string $subject, string $content)
    {
        $letter = new Letter($this->gql);
        return $letter->create($subject, $content);
    }

    public function listLetter(int $first = 25, int $offset = 0, array $fields = Letter::DEFAULT_FIELDS)
    {
        $letter = new Letter($this->gql);
        return $letter->list($first, $offset, $fields);
    }

    public function getLetter(int $letter_id, array $fields = Letter::DEFAULT_FIELDS)
    {
        $letter = new Letter($this->gql);
        return $letter->get($letter_id, $fields);
    }

    public function deleteLetter(int $letter_id)
    {
        $letter = new Letter($this->gql);
        return $letter->delete($letter_id);
    }

    public function updateLetter(int $letter_id, array $data, array $fields = Letter::DEFAULT_FIELDS)
    {
        $letter = new Letter($this->gql);
        return $letter->update($letter_id, $data, $fields);
    }


    //---

    public function createSchedule(array $contactgroup_id, int $letter_id, string $sender_name, string $sender_email, string $date, string $time)
    {
        $schedule = new Schedule($this->gql);
        return $schedule->create($contactgroup_id, $letter_id, $sender_name, $sender_email, $date, $time);
    }

    public function getSchedule(int $schedule_id, array $fields = Schedule::DEFAULT_FIELDS)
    {
        $schedule = new Schedule($this->gql);
        return $schedule->get($schedule_id, $fields);
    }

    public function listSchedule(int $first = 25, int $offset = 0, array $fields = Schedule::DEFAULT_FIELDS)
    {
        $schedule = new Schedule($this->gql);
        return $schedule->list($first, $offset, $fields);
    }

    public function deleteSchedule(int $schedule_id)
    {
        $schedule = new Schedule($this->gql);
        return $schedule->delete($schedule_id);
    }
}
