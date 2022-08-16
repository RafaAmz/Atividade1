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
                'label' => 'Which is your mother tongue?',
                'value_options' => [
                    '0' => 'French',
                    '1' => 'English',
                    '2' => 'Japanese',
                    '3' => 'Chinese',
                ],
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
