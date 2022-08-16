<?php

namespace Product\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;
use Category\Model\CategoryTable;

class ProductForm22222222222222222222222 extends Form
{
    public function __construct(CategoryTable $categoryTable)
    {

        parent::__construct();
        $this->setAttribute('method', 'post');

        $this->add([
            'type' => Element\Select::class,
            'name' => 'category_id',
            'options' => [
                'label' => 'Categories',
                'value_options' => $categoryTable->fetchAll()
            ],
            'attributes' => [
                'required' => true,
                'class' => 'custom-select'
            ]
        ]);
    }
}