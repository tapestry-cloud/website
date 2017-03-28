<?php namespace TapestryCloud;

use Tapestry\Modules\Kernel\KernelInterface;
use Tapestry\Plates\Engine;
use Tapestry\Tapestry;
use TapestryCloud\Lib\TestPlatesExtension;

class Kernel implements KernelInterface
{
    /**
     * @var Engine
     */
    private $engine;
    private $container;

    public function __construct(Tapestry $tapestry)
    {
        $this->container = $tapestry->getContainer();
        $this->engine = $this->container->get(Engine::class);
    }

    /**
     * This method is executed by Tapestry when the Kernel is registered.
     *
     * @return void
     */
    public function register()
    {
        include (__DIR__ . '/lib/TestPlatesExtension.php');
        $this->engine->loadExtension($this->container->get(TestPlatesExtension::class));
    }

    /**
     * This method of executed by Tapestry as part of the build process.
     *
     * @return void
     */
    public function boot()
    {
        // ...
    }
}