<?php

namespace Epost;

use Exception;
use GQL\Client;

abstract class GQL
{
    public  function delete($id)
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


    public function __call(string $name, $arguments)
    {
        if ($name == "get") {
            $class = explode("\\", static::class)[1];
            $id = strtolower($class) . "_id";
            $gql = $arguments[1];
            $gql["__args"] = [];
            $gql["__args"][$id] = $arguments[0];

            $resp = $this->gql->query([
                "get{$class}" => $gql
            ]);

            return $resp["data"]["get{$class}"];
        }

        throw new Exception("method $name not found");
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
