<?php

namespace Product\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Product\Model\ProductTable;
use Product\Form\ProductForm;
use Product\Model\Product;

class ProductController extends AbstractActionController
{

    private $table;
    private $productForm;
    private $categoriesArray;

    public function __construct(ProductTable $table, ProductForm $productForm, $categoriesArray)
    {
        $this->table = $table;
        $this->productForm = $productForm;
        $this->categoriesArray = $categoriesArray;
    }

    public function indexAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setVariable('products', $this->table->fetchAll());
        $viewModel->setVariable('categoriesArray', $this->categoriesArray);

        return $viewModel;
    }

    public function addAction()
    {
        $form = $this->productForm;
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }

        $product = new Product();
        $form->setInputFilter($product->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $product->exchangeArray($form->getData());
        $this->table->saveProduct($product);
        return $this->redirect()->toRoute('product');
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (0 === $id) {
            return $this->redirect()->toRoute('product', ['action' => 'add']);
        }

        try {
            $product = $this->table->getProduct($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('product', ['action' => 'index']);
        }

        $form = $this->productForm;
        $form->bind($product);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if (! $request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($product->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return $viewData;
        }

        try {
            $this->table->saveProduct($product);
        } catch (\Exception $e) {
        }

        return $this->redirect()->toRoute('product', ['action' => 'index']);
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('product');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->table->deleteProduct($id);
            }

            return $this->redirect()->toRoute('product');
        }

        return [
            'id'    => $id,
            'product' => $this->table->getProduct($id),
        ];
    }
}
