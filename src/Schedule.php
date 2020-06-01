<?php

namespace Epost;

class Schedule extends GQL
{
    const DEFAULT_FIELDS = ["schedule_id" => true, "letter_id" => true, "sender_name" => true, "sender_email" => true, "date" => true, "time" => true];

    public function create(array $contactgroup_id, int $letter_id, string $sender_name, string $sender_email, string $date, string $time): array
    {
        $gql = Schedule::DEFAULT_FIELDS;

        $gql["__args"] = [
            "contactgroup_id" => $contactgroup_id,
            "letter_id" => $letter_id,
            "sender_name" => $sender_name,
            "sender_email" => $sender_email,
            "date" => $date,
            "time" => $time
        ];

        $ret = $this->subscription([
            "createSchedule" => $gql
        ]);
        return $ret["data"]["createSchedule"];
    }
}
