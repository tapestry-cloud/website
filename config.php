<?php

return [
    /**
     * Some example global data, this is available from $this->site(...) in any phtml file
     */
    'site' => [
        'title' => 'tapestry.cloud',
        'url' => 'http://localhost:3000',
        'description' => 'Tapestry static site generator.',
        'author' => 'Simon Dann',
        'email' => 'simon.dann@gmail.com'
    ],

    'plugins' => [
        'code_example_path' => __DIR__ . '/source/_code-examples/',
        'asset_manifest_path' => __DIR__ . '/rev-manifest.json'
    ],

    /*
     * The site kernel to be loaded during site building
     */
    'kernel' => \TapestryCloud\Kernel::class,

    'ignore' => [
        '_code-examples'
    ]
];