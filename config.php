<?php

return [
    /**
     * Some example global data, this is available from $this->site(...) in any phtml file
     */
    'site' => [
        'title' => 'Tapestry &mdash; PHP Static Site Generator',
        'url' => 'http://localhost:3000',
        'description' => 'Tapestry PHP Static Site Generator.',
        'author' => 'Simon Dann',
        'email' => 'simon.dann@gmail.com',
        'google-analytics' => null,
        'twitter-card' => [
            'site' => '@carbontwelve',
            'creator' => '@carbontwelve'
        ],
        'documentation-menu' => [

            'Getting Started' => [
                'Quickstart Guide' => 'documentation',
                'Installation/Upgrade' => 'documentation/installation',
                'Starting a new site' => 'documentation/start-new-website',
                'Configuration' => 'documentation/configuration',
                'Working Examples &amp; Plugins' => 'documentation/working-examples'
            ],

            'Your Content' => [
                'Front Matter' => 'documentation/front-matter',
                'Site Variables' => 'documentation/site-variables',
                'Helpers' => 'documentation/helpers',
                'Creating Content' => 'documentation/your-content',
                // 'Markdown Extra' => 'documentation/markdown-extra',
                // 'PHP Plates' => 'documentation/php-plates',
                'Collections' => 'documentation/collections',
                'Assets' => 'documentation/assets',
                'Pretty URLS' => 'documentation/permalinks',
                'Deploying your site' => 'documentation/deploying',
            ],

            'Core Concepts' => [
                'Commands' => 'documentation/commands',
                'Project Kernel' => 'documentation/kernel',
                'Content Types' => 'documentation/content-types',
                'Content Renderers' => 'documentation/content-renderers',
                'Content Generators' => 'documentation/content-generators',
                'Taxonomy' => 'documentation/taxonomy',
            ],

            'Extending Tapestry' => [
                'Writing Plugins' => 'documentation/writing-plugins',
                'Steps' => 'documentation/steps',
                'Container' => 'documentation/container',
                'Project' => 'documentation/project',
                'Events' => 'documentation/events',
            ]
        ]
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
        '_code-examples',
        'css',
        'img',
        'js',
    ],
    'copy' => [
        'css',
        'img',
        'js',
    ]
];