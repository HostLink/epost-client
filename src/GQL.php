<?php

namespace Epost;

use GQL\Client;

abstract class GQL
{

    public function __construct(Client $gql)
    {
        $this->gql = $gql;
    }
}
