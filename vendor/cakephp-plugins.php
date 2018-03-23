<?php
$baseDir = dirname(dirname(__FILE__));
return [
    'plugins' => [
        'Bake' => $baseDir . '/vendor/cakephp/bake/',
        'CakeDC/Mixer' => $baseDir . '/vendor/cakedc/mixer/',
        'DebugKit' => $baseDir . '/vendor/cakephp/debug_kit/',
        'Media' => $baseDir . '/plugins/Media/',
        'Migrations' => $baseDir . '/vendor/cakephp/migrations/'
    ]
];