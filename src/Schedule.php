<?php

namespace Epost;

class Schedule extends GQL
{
    const DEFAULT_FIELDS = ["schedule_id", "letter_id", "sender_name", "sender_email", "date", "time"];

    public function add(array $contactgroup_id, int $letter_id, string $sender_name, string $sender_email, string $date, string $time): array
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
            "addSchedule" => $gql
        ]);
        return $ret["data"]["addSchedule"];
    }

    public function listDelivery(int $contactgroup_id, int $first, int $offset, string $fields)
    {
        $gql = [];
        $gql["__args"] = [
            "contactgroup_id" => $contactgroup_id
        ];
        $gql["Delivery"] = $fields;
        $gql["Delivery"]["__args"] = [
            "first" => $first,
            "offset" => $offset
        ];

        $ret = $this->query([
            "getSchedule" => $gql
        ]);
        return $ret["data"]["getSchedule"]["Delivery"];
    }
}
