<?php

namespace Gelarapps\Common\Web\Validator;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\Callback;
use Gelarapps\Common\Web\Model\Users;


class PasswordValidation extends Validation
{
    public function initialize()
    {
        $this->add(
            'password',
            new PresenceOf(
                [
                    'message' => 'Password tidak boleh kosong.',
                ]
            )
        );

        $this->add(
            'password',
            new StringLength(
                [
                    'messageMinimum' => 'Password harus memiliki panjang lebih dari 8 karakter.',
                    'min'            => 8,
                    'messageMaximum' => 'Password harus memiliki panjang kurang dari 128 karakter.'
                ]
            )
        );

        $this->add(
            'confirm_password',
            new Confirmation(
                [
                    'with' => 'password',
                    'message' => 'Password Konfirmasi tidak cocok dengan Password'
                ]
            )
        );

        $this->add(
            'old_password',
            new Callback(
                [
                    'callback' => $this->isOldPasswordValid,
                    'message' => 'Password Konfirmasi tidak cocok dengan Password'
                ]
            )
        );
    }

    private function isOldPasswordValid($data){
        $ground_truth = Users::findFirst([
            [
                'username=:username:',
                'columns'   => 'password',
                'bind'      => ['username' => $this->session->get('auth')['username']]
            ]
        ]);

        return $this->security->checkHash($data, $ground_truth);
    }
}