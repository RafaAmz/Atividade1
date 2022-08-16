<?php

namespace Product\Form;

use Category\Model\CategoryTable;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface as ContainerContainerInterface;

class ProductFieldsetFactory implements FactoryInterface
{
    public function __invoke(ContainerContainerInterface $container, $name, array $options = null)
    {
        return new ProductFieldset($container->get(CategoryTable::class));
    }
}