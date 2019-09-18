<?php
return [
    'class'  => 'Domain',
    'states' => [
        'initial'    => ['type' => 'initial', 'properties' => []],
        'pending' => ['type' => 'normal',  'properties' => []],
        'failed' => ['type' => 'final',   'properties' => []],
        'completed'  => ['type' => 'final',   'properties' => []],
    ],
    'transitions' => [
        'run' => ['from' => ['initial'],    'to' => 'pending'],
        'failure'  => ['from' => ['pending'], 'to' => 'failed'],
        'success'  => ['from' => ['pending'], 'to' => 'completed'],
    ]
];
