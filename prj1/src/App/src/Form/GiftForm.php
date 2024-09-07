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

class GiftForm extends Form
{
    public function __construct(array $options = [])
    {
        parent::__construct('GiftForm', $options);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'firstName2',

        ]);

        $this->add([
            'type' => Email::class,
            'name' => 'email2',

        ]);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'address2',
        ]);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'city2',
        ]);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'country2',
        ]);

        $this->add([
            'type' => Element\Number::class,
            'name' => 'zipCode2',
        ]);

        $this->add([
            'type' => Element\Number::class,
            'name' => 'tel2',
        ]);

    }

    public function getInputFilter(): InputFilterInterface
    {
        $inputFilter = parent::getInputFilter();

        $inputFilter->add([
                'name' => 'firstName2',
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
                'name' => 'email2',
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
                'name' => 'address2',
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
                'name' => 'city2',
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
                'name' => 'country2',
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
                'name' => 'zipCode2',
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
                'name' => 'tel2',
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