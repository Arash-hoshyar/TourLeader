<?php

namespace Admin\Form\EditProduct;

use Laminas\Form\Element;
use Laminas\Form\Form;
use Laminas\InputFilter\InputFilterInterface;
use Laminas\Validator\NotEmpty;
use Laminas\Validator\Regex;
use Laminas\Validator\StringLength;

class AdminEditProductForm extends Form
{
    public function __construct(array $options = [])
    {
        parent::__construct('AdminEditProductForm', $options);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'id',

        ]);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'name',

        ]);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'label',
        ]);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'brand_id',
        ]);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'description',
        ]);

        $this->add([
            'type' => Element\Number::class,
            'name' => 'price',
        ]);

        $this->add([
            'type' => Element\Number::class,
            'name' => 'height',
        ]);

        $this->add([
            'type' => Element\Number::class,
            'name' => 'width',
        ]);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'material',
        ]);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'category_id',
        ]);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'package',
        ]);
    }

    public function getInputFilter(): InputFilterInterface
    {
        $inputFilter = parent::getInputFilter();

        $inputFilter->add([
                'name' => 'id',
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
        $inputFilter->add([
                'name' => 'label',
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
        $inputFilter->add([
                'name' => 'brand_id',
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => 20,
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
        $inputFilter->add([
                'name' => 'description',
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'min' => 3,
                            'max' => 200,
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
        $inputFilter->add([
                'name' => 'price',
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
        $inputFilter->add([
                'name' => 'height',
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
        $inputFilter->add([
                'name' => 'width',
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
        //         'name' => 'material',
        //         'validators' => [
        //             [
        //                 'name' => StringLength::class,
        //                 'options' => [
        //                     'min' => 1,
        //                     'max' => 25,
        //                 ]
        //             ],
        //             [
        //                 'name' => NotEmpty::class
        //             ],
        //             [
        //                 'name' => Regex::class,
        //                 'options' => [
        //                     'pattern' => '/^.*$/',
        //                     'messages' => [
        //                         Regex::INVALID => 'LBF get angry',
        //                         Regex::NOT_MATCH => 'BAD writer'
        //                     ]
        //                 ],
        //             ]
        //         ],
        //     ]
        // );
        $inputFilter->add([
                'name' => 'category_id',
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => 20,
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
        $inputFilter->add([
                'name' => 'package',
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