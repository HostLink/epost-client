<?php

namespace Epost;

class SMS extends GQL
{
    const DEFAULT_FIELDS = ["sms_id" => true, "phone" => true, "content" => true, "contact_id" => true, "send_time" => true];
}
