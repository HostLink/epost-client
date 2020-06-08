<?php

namespace Epost;

class Letter extends GQL
{
    const DEFAULT_FIELDS = ["letter_id" => true, "subject" => true];

    public function add(string $subject, string $content)
    {
        $ret = $this->subscription([
            "addLetter" => [
                "__args" => [
                    "subject" => $subject,
                    "content" => $content
                ],
                "letter_id" => true,
                "subject" => true
            ]
        ]);
        return $ret["data"]["addLetter"];
    }
}
