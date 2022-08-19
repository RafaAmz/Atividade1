<?php

namespace Product;

use Category\Controller\CategoryController;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Category\Model\CategoryTable;
use Product\Form\ProductForm;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\ProductTable::class => function ($container) {
                    $tableGateway = $container->get(Model\ProductTableGateway::class);
                    return new Model\ProductTable($tableGateway);
                },
                Model\ProductTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Product());
                    return new TableGateway('product', $dbAdapter, null, $resultSetPrototype);
                },
                Form\ProductForm::class => function ($container) {
                    $categoryTable = $container->get(CategoryTable::class);
                    $categories = $categoryTable->fetchAll();
                    $categoriesArray = [];
                    foreach($categories as $categorie){
                        $categoriesArray[$categorie->id] = $categorie->name;
                    };
                    return new Form\ProductForm($categoriesArray);
                },
            ],
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\ProductController::class => function ($container) {
                    $categoryTable = $container->get(CategoryTable::class);
                    $categories = $categoryTable->fetchAll();
                    $categoriesArray = [];
                    foreach($categories as $categorie){
                        $categoriesArray[$categorie->id] = $categorie->name;
                    };

                    return new Controller\ProductController(
                        $container->get(Model\ProductTable::class),
                        $container->get(Form\ProductForm::class),
                        $categoriesArray
                    );
                },
            ],
        ];
    }
}
