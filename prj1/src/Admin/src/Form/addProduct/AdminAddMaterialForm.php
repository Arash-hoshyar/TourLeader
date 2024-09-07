<?php

namespace Admin\Form\addProduct;

use Laminas\Form\Element;
use Laminas\Form\Form;
use Laminas\InputFilter\InputFilterInterface;
use Laminas\Validator\NotEmpty;
use Laminas\Validator\Regex;
use Laminas\Validator\StringLength;

class AdminAddMaterialForm extends Form
{
    public function __construct(array $options = [])
    {
        parent::__construct('AdminAddMaterialForm', $options);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'name',
        ]);

    }

    public function getInputFilter(): InputFilterInterface
    {
        $inputFilter = parent::getInputFilter();

        $inputFilter->add([
                'name' => 'name',
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'min' => 3,
                            'max' => 25,
                        ]
                    ],
                    [
                        'name' => NotEmpty::class
                    ],
                    [
                        'name' => Regex::class,
                        'options' => [
                            'pattern' => '/^.*$/',
                            'messages' => [
                                Regex::INVALID => 'LBF get angry',
                                Regex::NOT_MATCH => 'BAD writer'
                            ]
                        ],
                    ]
                ],
            ]
        );

        return $inputFilter;
    }
}