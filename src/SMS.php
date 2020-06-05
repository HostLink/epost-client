<?php

namespace Epost;

class SMS extends GQL
{
    const DEFAULT_FIELDS = ["sms_id" => true, "phone" => true, "contact" => true, "send_time" => true];
}
