<?php namespace TapestryCloud;

use Tapestry\Entities\Configuration;
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
        $this->tapestry->register(\TapestryCloud\Asset\ServiceProvider::class);
        $this->tapestry->register(\TapestryCloud\CodeExample\ServiceProvider::class);

        // Inverse the documentation menu for breadcrumb lookup
        /** @var Configuration $config */
        $config = $this->container->get(Configuration::class);

        $arr = [];
        foreach ($config->get('site.documentation-menu', []) as $parent => $children) {
            foreach ($children as $child => $item) {
                    $arr[url($item)] = [
                        $parent,
                        $child
                    ];
            }
        }

        $config->set('site.documentation-menu-breadcrumb-lookup', $arr);
    }
}