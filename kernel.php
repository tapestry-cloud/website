<?php namespace TapestryCloud;

use Tapestry\Modules\Kernel\KernelInterface;

class Kernel implements KernelInterface
{

    /**
     * This method is executed by Tapestry when the Kernel is registered.
     *
     * @return void
     */
    public function register()
    {
        // ...
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