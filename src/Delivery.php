<?php

namespace Epost;

class Delivery extends GQL
{
    const DEFAULT_FIELDS = ["devliery_id" => true, "schedule_id" => true, "status" => 1, "time" => true, "email" => true];
}
