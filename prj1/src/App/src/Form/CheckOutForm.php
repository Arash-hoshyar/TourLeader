<?php

namespace App\Form;

use Laminas\Filter\StringTrim;
use Laminas\Filter\StripTags;
use Laminas\Form\Element;
use Laminas\Form\Element\Email;
use Laminas\Form\Form;
use Laminas\InputFilter\InputFilterInterface;
use Laminas\Validator\EmailAddress;
use Laminas\Validator\NotEmpty;
use Laminas\Validator\Regex;
use Laminas\Validator\StringLength;

class CheckOutForm extends Form
{
    public function __construct(array $options = [])
    {
        parent::__construct('CheckOutForm', $options);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'firstName',

        ]);

        $this->add([
            'type' => Email::class,
            'name' => 'email',

        ]);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'address',
        ]);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'city',
        ]);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'country',
        ]);

        $this->add([
            'type' => Element\Number::class,
            'name' => 'zipCode',
        ]);

        $this->add([
            'type' => Element\Number::class,
            'name' => 'tel',
        ]);
    }

    public function getInputFilter(): InputFilterInterface
    {
        $inputFilter = parent::getInputFilter();

        $inputFilter->add([
                'name' => 'firstName',
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
                'name' => 'email',
                'filters' => [
                    ['name' => StripTags::class],
                    ['name' => StringTrim::class],
                ],
                'validators' => [
                    [
                        'name' => EmailAddress::class,
                    ],
                ],
            ]
        );
        $inputFilter->add([
                'name' => 'address',
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => 30,
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
                'name' => 'city',
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
                'name' => 'country',
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
                'name' => 'zipCode',
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
                'name' => 'tel',
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

        return $inputFilter;
    }
}