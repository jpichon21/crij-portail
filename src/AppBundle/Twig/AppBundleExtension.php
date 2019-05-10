<?php
namespace AppBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigTest;

class AppBundleExtension extends AbstractExtension
{
    public function getTests()
    {
        return [
            new TwigTest('instanceof', [$this, 'isInstanceof'])
        ];
    }
    
    /**
     * @param $object
     * @param $class
     * @return bool
     */
    public function isInstanceof($object, $class)
    {
        $reflectionClass = new \ReflectionClass($class);
        return $reflectionClass->isInstance($object);
    }
}
