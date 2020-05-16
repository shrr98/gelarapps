<?php

namespace Gelarapps\Common\Web\Validator;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Alnum;
use Phalcon\Validation\Validator\StringLength;

class ProfilValidation extends Validation
{
    public function initialize()
    {

        $this->add(
            'nama',
            new PresenceOf(
                [
                    'message' => 'Nama tidak boleh kosong.',
                ]
            )
        );

        $this->add(
            'status',
            new StringLength(
                [
                    'max'            => 255,
                    'messageMaximum' => 'Password harus memiliki panjang kurang dari 256 karakter.'
                ]
            )
        );
    }
}