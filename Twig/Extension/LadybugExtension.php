<?php

namespace RaulFraile\Bundle\LadybugBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Twig extension for the bundle.
 */
class LadybugExtension extends \Twig_Extension
{
    /**
     * @var ContainerInterface $container The Symfony2 DIC.
     */
    private $container;

    /**
     * Main constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Getter.
     *
     * @return ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Getter.
     *
     * @return array
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('ladybug_dump', [$this, 'ladybug_dump'], ['is_safe' => ['html']]),
            new \Twig_SimpleFilter('ld', [$this, 'ladybug_dump'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * Getter.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('ladybug_dump', [$this, 'ladybug_dump'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('ld', [$this, 'ladybug_dump'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * Getter.
     *
     * @return string
     */
    public function ladybug_dump()
    {
        $ladybug = \Ladybug\Dumper::getInstance();
        $html = call_user_func_array(array($ladybug,'dump'), func_get_args());

        return $html;
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'ladybug_extension';
    }
}
