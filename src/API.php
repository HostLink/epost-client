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

    public function addContactGroup(string $name, string $remark = null): array
    {
        $contactgroup = new ContactGroup($this->gql);
        return $contactgroup->add($name, $remark);
    }

    public function deleteContactGroup(int $contactgroup_id): bool
    {
        $contactgroup = new ContactGroup($this->gql);
        return $contactgroup->delete($contactgroup_id);
    }

    public function listContactGroup(array $fields = ContactGroup::DEFAULT_FIELDS)
    {
        $contactgroup = new ContactGroup($this->gql);
        return $contactgroup->list($fields);
    }

    public function updateContactGroup(int $contactgroup_id, array $data)
    {
        $contactgroup = new ContactGroup($this->gql);
        return $contactgroup->update($contactgroup_id, $data);
    }

    //--- contact ---
    public function addContact(int $contactgroup_id, string $name, string $email = null, string $phone = null)
    {
        $contact = new Contact($this->gql);
        return $contact->add($contactgroup_id, $name, $email, $phone);
    }

    public function getContact(int $contact_id, array $fields = Contact::DEFAULT_FIELDS)
    {
        $contact = new Contact($this->gql);
        return $contact->get($contact_id, $fields);
    }

    public function updateContact(int $contact_id, array $data)
    {
        $contact = new Contact($this->gql);
        return $contact->update($contact_id, $data);
    }

    public function deleteContact(int $contact_id)
    {
        $contact = new Contact($this->gql);
        return $contact->delete($contact_id);
    }

    public function listContact(array $fields = Contact::DEFAULT_FIELDS)
    {
        $contact = new Contact($this->gql);
        return $contact->list($fields);
    }

    //--- letter ---
    public function addLetter(string $subject, string $content)
    {
        $letter = new Letter($this->gql);
        return $letter->add($subject, $content);
    }

    public function listLetter(array $fields = Letter::DEFAULT_FIELDS)
    {
        $letter = new Letter($this->gql);
        return $letter->list($fields);
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

    public function updateLetter(int $letter_id, array $data)
    {
        $letter = new Letter($this->gql);
        return $letter->update($letter_id, $data);
    }

    //--- Schedule ---
    public function addSchedule(array $contactgroup_id, int $letter_id, string $sender_name, string $sender_email, string $date, string $time)
    {
        $schedule = new Schedule($this->gql);
        return $schedule->add($contactgroup_id, $letter_id, $sender_name, $sender_email, $date, $time);
    }

    public function getSchedule(int $schedule_id, array $fields = Schedule::DEFAULT_FIELDS)
    {
        $schedule = new Schedule($this->gql);
        return $schedule->get($schedule_id, $fields);
    }

    public function listSchedule(array $fields = Schedule::DEFAULT_FIELDS)
    {
        $schedule = new Schedule($this->gql);
        return $schedule->list($fields);
    }

    public function deleteSchedule(int $schedule_id)
    {
        $schedule = new Schedule($this->gql);
        return $schedule->delete($schedule_id);
    }

    public function listDelivery(array $fields = Delivery::DEFAULT_FIELDS)
    {
        $delivery = new Delivery($this->gql);
        return $delivery->list($fields);
    }

    public function getSMS(int $sms_id, array $fields = SMS::DEFAULT_FIELDS)
    {
        $obj = new SMS($this->gql);
        return $obj->get($sms_id, $fields);
    }

    public function listSMS(array $fields = SMS::DEFAULT_FIELDS)
    {
        $sms = new SMS($this->gql);
        return $sms->list($fields);
    }

    public function getSMSSchedule(int $smsschedule_id, array $fields = SMSSchedule::DEFAULT_FIELDS)
    {
        $obj = new SMSSchedule($this->gql);
        return $obj->get($smsschedule_id, $fields);
    }

    public function listSMSSchedule(array $fields = SMSSchedule::DEFAULT_FIELDS)
    {
        $obj = new SMSSchedule($this->gql);
        return $obj->list($fields);
    }

    public function listContactReject(array $fields = ContactReject::DEFAULT_FIELDS)
    {
        $obj = new ContactGroup($this->gql);
        return $obj->list($fields);
    }

    //--- demographic --
    public function addDemographic(string $name)
    {
        $obj = new Demographic($this->gql);
        return $obj->add($name);
    }

    public function listDemographic()
    {
        $obj = new Demographic($this->gql);
        return $obj->list(Demographic::DEFAULT_FIELDS);
    }

    public function deleteDemographic(string $name)
    {
        $obj = new Demographic($this->gql);
        return $obj->remove($name);
    }
}
