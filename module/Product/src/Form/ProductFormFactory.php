<?php

namespace Product\Form;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class ProductFormFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        $mapper = $container->get(CategoryMapper::class);
        $categoriesIDs = $mapper->findAllAsArray();
 
        return new ProductForm($categoriesIDs);
    }
}