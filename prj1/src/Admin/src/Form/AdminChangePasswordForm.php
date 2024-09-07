<?php

namespace Admin\Form;

use Laminas\Filter\StringTrim;
use Laminas\Filter\StripTags;
use Laminas\Form\Element\Email;
use Laminas\Form\Element\Password;
use Laminas\Form\Form;
use Laminas\InputFilter\InputFilterInterface;
use Laminas\Validator\EmailAddress;
use Laminas\Validator\NotEmpty;
use Laminas\Validator\Regex;
use Laminas\Validator\StringLength;

class AdminChangePasswordForm extends Form
{
    public function __construct(array $options = [])
    {
        parent::__construct('AdminChangePasswordForm', $options);

        $this->add([
            'type' => Email::class,
            'name' => 'email',

        ]);

        $this->add([
            'type' => Password::class,
            'name' => 'password',
        ]);
    }

    public function getInputFilter(): InputFilterInterface
    {
        $inputFilter =  parent::getInputFilter();
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

        return $inputFilter;
    }
}