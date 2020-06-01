<?php

namespace Epost;

class Letter extends GQL
{
    const DEFAULT_FIELDS = ["letter_id" => true, "subject" => true];

    public function create(string $subject, string $content)
    {
        $ret = $this->subscription([
            "createLetter" => [
                "__args" => [
                    "subject" => $subject,
                    "content" => $content
                ],
                "letter_id" => true,
                "subject" => true
            ]
        ]);
        return $ret["data"]["createLetter"];
    }
}
