<?php
return array(
    "database" => [
        "controller" => "main",
        "action" => "list"
    ],
    "database/domain/([0-9]+)" => [
        "controller" => "main",
        "action" => "list"
    ],
    "database/?page=([0-9]+)/s" => [
        "controller" => "main",
        "action" => "list"
    ],
    "print" => [
        "controller" => "main",
        "action" => "print"
    ],
    "" => [
        "controller" => "main",
        "action" => "index"
    ]
);