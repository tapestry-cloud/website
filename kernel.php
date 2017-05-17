<?php namespace TapestryCloud;

use Tapestry\Modules\Kernel\KernelInterface;
use Tapestry\Plates\Engine;
use Tapestry\Tapestry;

class Kernel implements KernelInterface
{

    /**
     * @var Tapestry
     */
    private $tapestry;

    /**
     * @var Engine
     */
    private $engine;
    private $container;

    public function __construct(Tapestry $tapestry)
    {
        $this->tapestry = $tapestry;
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
        // Use project autoloader
        require_once(__DIR__ . '/vendor/autoload.php');
    }

    /**
     * This method of executed by Tapestry as part of the build process.
     *
     * @return void
     */
    public function boot()
    {
        $this->engine->loadExtension($this->container->get(TestPlatesExtension::class));
        $this->engine->loadExtension($this->container->get(CodeExamplePlatesExtension::class));
        $this->tapestry->register(\TapestryCloud\Asset\ServiceProvider::class);
    }
}