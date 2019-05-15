<?php
declare(strict_types=1);

return [
    'default' => 'main',
    'connections' => [
        'main' => [
            'salt' => 'laravelstarter58',
            'length' => '10',
        ],
        'alternative' => [
            'salt' => 'beesoft',
            'length' => '10',
        ],
    ],
];

