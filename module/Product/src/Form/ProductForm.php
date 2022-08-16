<?php

namespace Product\Form;

use Laminas\Form\Form;
use Laminas\Form\Element;

class ProductForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('product');

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
            'name' => 'category_id',
            'type' => Element\Select::class,
            'options' => [
                'label' => 'category_id',
                'value_options' => [0, 1, 2, 3, 4, 5, 6]
            ],
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
