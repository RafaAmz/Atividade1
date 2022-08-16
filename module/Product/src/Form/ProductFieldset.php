<?php

namespace Product\Form;

use Category\Model\CategoryTable;
use Laminas\Form\Element\Select;
use Laminas\Form\Fieldset;

class ProductFieldset extends Fieldset
{
    public function __construct(CategoryTable $categoryTable)
    {
        $categories = $categoryTable->fetchAll();

        $selectField = new Select();
        $selectField->setName('category_id')
            ->setOptions([
                $selectField->setLabel('category_id'),
                $selectField->setEmptyOption('Select...'),
                $selectField->setValueOptions($categories)
            ])
            ->setAttributes([
                'required' => true,
                'class' => 'custom-select'
            ]);

        $this->add($selectField);
    }
}
