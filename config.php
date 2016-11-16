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

    /**
     * The site kernel to be loaded during site building
     */
    'kernel' => \Site\SiteKernel::class,
];