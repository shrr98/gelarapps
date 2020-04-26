<?php

namespace Gelarapps\Common\Web\Validator;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Alnum;
use Phalcon\Validation\Validator\StringLength;

class LoginValidation extends Validation
{
    public function initialize()
    {
        $this->add(
            'username',
            new PresenceOf(
                [
                    'message' => 'Username tidak boleh kosong.',
                ]
            )
        );
        
        $this->add(
            'password',
            new PresenceOf(
                [
                    'message' => 'Password tidak boleh kosong.',
                ]
            )
        );
    }
}