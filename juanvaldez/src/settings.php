<?php
return [
    'settings' => [
        'displayErrorDetails' => false, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        'MODE' => [
            'MODE' => 'development'
        ],
        "db" => [
            "host" => "localhost",
            "dbname" => "nasryarg_juan_valdez",
            "user" => "nasryarg_jv",
            "pass" => "JuanValdez2016"
        ]
    ],
];
