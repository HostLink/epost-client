<?php

namespace Epost;

use ArrayIterator;
use IteratorAggregate;
use GQL\Client;

class QueryList implements IteratorAggregate
{

    public $fields;
    public $limit;
    public $offset = 0;
    public $filter = [];
    public $gql;
    public $name;

    public function __construct(Client $gql, $name)
    {
        $this->gql = $gql;
        $this->name = $name;
    }

    public function limit(int $limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function offset(int $offset)
    {
        $this->offset = $offset;
        return $this;
    }

    public function filter(array $filter)
    {
        $this->filter = $filter;
        return $this;
    }

    public function getIterator()
    {
        $gql = $this->fields;

        if ($this->limit) {
            $gql["__args"]["limit"] = $this->limit;
        }

        if ($this->offset) {
            $gql["__args"]["offset"] = $this->offset;
        }

        if ($this->filter) {
            $gql["__args"]["filter"] = $this->filter;
        }

        $resp = $this->gql->query([
            "list{$this->name}" => $gql
        ]);

        return new ArrayIterator($resp["data"]["list{$this->name}"]);
    }

    public function toArray()
    {
        return iterator_to_array($this);
    }

    public function count(): int
    {
        $args = [];
        if ($this->filter) {
            $args["filter"] = $this->filter;
        }

        $resp = $this->gql->query([
            "count{$this->name}" => [
                "__args" => $args
            ]
        ]);
        return $resp["data"]["count{$this->name}"];
    }
}
