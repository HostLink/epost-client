<?php

namespace Epost;

use Exception;
use GQL\Client;

abstract class GQL
{

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
