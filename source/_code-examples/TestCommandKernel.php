<?php

namespace Site;

use Tapestry\Modules\Kernel\KernelInterface;
use Tapestry\Tapestry;

class kernel implements KernelInterface
{
    /**
     * @var Tapestry
     */
    private $tapestry;

    public function __construct()
    {
        $this->tapestry = Tapestry::getInstance();
    }

    public function register()
    {
        // Not the ideal way of adding the file.
        include __DIR__.'/TestCommand.php';

        /** @var \Tapestry\Console\Application $cliApplication */
        $cliApplication = $this->tapestry->getContainer()->get(\Tapestry\Console\Application::class);
        $cliApplication->add(new TestCommand());
    }

    public function boot()
    {
        // ...
    }
}