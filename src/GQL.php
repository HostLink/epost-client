<?php

namespace Epost;

use Exception;
use GQL\Client;

abstract class GQL
{
    public function update(int $id, array $data, array $fields)
    {
        $class = explode("\\", static::class)[1];
        $_id = strtolower($class) . "_id";

        $gql = $fields;
        $gql["__args"] = [
            $_id => $id,
            "data" => $data
        ];

        $resp = $this->mutation([
            "update{$class}" => $gql
        ]);

        if ($resp["error"]) {
            throw new Exception($resp["error"]["message"]);
        }

        return $resp["data"]["update{$class}"];
    }

    public function list(array $filter, int $first, int $offset = 0, array $fields): array
    {
        $class = explode("\\", static::class)[1];

        $gql = $fields;
        $gql["__args"] = [
            "filter" => $filter,
            "first" => $first,
            "offset" => $offset
        ];

        $resp = $this->query([
            "list{$class}" => $gql
        ]);

        if ($resp["error"]) {
            throw new Exception($resp["error"]["message"]);
        }

        return $resp["data"]["list{$class}"];
    }

    public function delete(int $id)
    {
        $class = explode("\\", static::class)[1];
        $_id = strtolower($class) . "_id";
        $gql["__args"] = [];
        $gql["__args"][$_id] = $id;
        $resp = $this->gql->mutation([
            "delete{$class}" => $gql
        ]);
        return $resp["data"]["delete{$class}"];
    }

    public function get(int $id, array $fields)
    {
        $class = explode("\\", static::class)[1];
        $_id = strtolower($class) . "_id";
        $gql = $fields;
        $gql["__args"] = [];
        $gql["__args"][$_id] = $id;

        $resp = $this->gql->query([
            "get{$class}" => $gql
        ]);


        if ($resp["error"]) {
            throw new Exception($resp["error"]["message"]);
        }

        return $resp["data"]["get{$class}"];
    }

    public function __construct(Client $gql)
    {
        $this->gql = $gql;
    }

    public function query(array $gql): array
    {
        $ret = $this->gql->query($gql);

        if ($ret["error"]) {
            throw new Exception($ret["error"]["message"]);
        }

        return $ret;
    }

    public function mutation(array $gql): array
    {
        $ret = $this->gql->mutation($gql);

        if ($ret["error"]) {
            throw new Exception($ret["error"]["message"]);
        }

        return $ret;
    }

    public function subscription(array $gql): array
    {
        $ret = $this->gql->subscription($gql);

        if ($ret["error"]) {
            throw new Exception($ret["error"]["message"]);
        }

        return $ret;
    }
}
