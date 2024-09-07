<?php

namespace Admin\Form\addProduct;

use Laminas\Form\Element;
use Laminas\Form\Form;
use Laminas\InputFilter\InputFilterInterface;
use Laminas\Validator\File\FilesSize;
use Laminas\Validator\NotEmpty;
use Laminas\Validator\Regex;
use Laminas\Validator\StringLength;

class AdminAddBrandForm extends Form
{
    public function __construct(array $options = [])
    {
        parent::__construct('AdminAddBrandForm', $options);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'name',

        ]);

        $this->add([
            'type' => Element\Image::class,
            'name' => 'image',

        ]);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'url',

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
                            'min' => 1,
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
       // $inputFilter->add([
       //         'name' => 'image',
       //         'required' => true,
       //         'validators' => [
       //             [
       //                 'name' => 'FileSize',
       //                 'options' => [
       //                     'max' => '2MB',
       //                 ],
       //             ],
       //             [
       //                 'name' => 'FileExtension',
       //                 'options' => [
       //                     'extension' => ['jpg', 'png', 'pdf'],
       //                 ],
       //             ],
       //         ],
       //     ]
       // );
        $inputFilter->add([
                'name' => 'url',
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'min' => 3,
                            'max' => 40,
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