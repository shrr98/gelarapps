<?php

namespace Gelarapps\Common\Web\Form;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;

use Gelarapps\Common\Web\Validator\PasswordValidation;
use Gelarapps\Common\Web\Form\BaseForm;

class PasswordForm extends BaseForm {
    public function initialize()
    {
        $this->add(
            new Password(
                'password',
                [
                    'placeholder' => 'Password',
                    'class'       => 'fadeIn third'
                ]
            )
        );

        $this->add(
            new Password(
                'confirm_password',
                [
                    'placeholder' => 'Konfirmasi Password',
                    'class'       => 'fadeIn third'
                ]
            )
        );

        $this->add(
            new Password(
                'old_password',
                [
                    'placeholder' => 'Password Lama',
                    'class'       => 'fadeIn third'
                ]
            )
        );



        $this->add(
            new Submit (
                'Simpan',
                [
                    'name' => 'simpan',
                    "class" => "fadeIn fourth"

                ]
            )
        );
        
        $this->setUserOptions([
            'method'=> 'POST',
            'class' => 'passwordForm',
            'action'=> '/profil/changepassword'
        ]);

        $this->setValidation(new PasswordValidation());
        
    }
}