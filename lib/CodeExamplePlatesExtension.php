<?php namespace TapestryCloud;

use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;

class CodeExamplePlatesExtension implements ExtensionInterface
{
    public function register(Engine $engine)
    {
        $engine->registerFunction('codeExample', [$this, 'codeExample']);
    }

    public function codeExample($file)
    {
        $filePath = __DIR__ . '/../source/_code-examples/' . $file;
        if (! file_exists($filePath)) {
            throw new \Exception('File ['. $filePath .'] does not exist.');
        }

        return htmlentities(file_get_contents($filePath));
    }
}