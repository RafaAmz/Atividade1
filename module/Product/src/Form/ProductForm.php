<?php

namespace Product\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;
use Category\Model\CategoryTable;

class ProductForm extends Form
{
    protected $categories;

    public function __construct($categories = [])
    {
        $this->categories = $categories;
        parent::__construct();

        $this->setAttribute('method', 'post');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'name',
            'type' => 'text',
            'options' => [
                'label' => 'Name',
            ],
        ]);

        $this->add([
            'type' => Element\Select::class,
            'name' => 'category_id',
            'options' => [
                'label' => 'Categories',
                'value_options' => $this->categories
            ],
            'attributes' => [
                'required' => true,
                'class' => 'custom-select'
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id'    => 'submitbutton',
            ],
        ]);
    }
}
