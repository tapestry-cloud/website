<?php

namespace TapestryCloud;

use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;

class Helpers implements ExtensionInterface
{
    /** @var \Tapestry\Plates\Template */
    public $template;

    public function register(Engine $engine)
    {
        $engine->registerFunction('asset', [$this, 'asset']);
    }

    public function asset($src)
    {
        $manifestPath = __DIR__ . '/../rev-manifest.json';
        if (file_exists($manifestPath)) {
            $manifest = json_decode(file_get_contents($manifestPath), true);
            $filename = pathinfo($src, PATHINFO_BASENAME);
            if (isset($manifest[$filename])) {
                $src = str_replace($filename, $manifest[$filename], $src);
            }
        }
        return url($src);
    }
}
