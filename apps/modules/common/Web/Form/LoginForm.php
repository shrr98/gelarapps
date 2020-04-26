<?php

namespace Gelarapps\Common\Web\Form;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Check;

use Gelarapps\Common\Web\Form\BaseForm;
use Gelarapps\Common\Web\Validator\LoginValidation;

class LoginForm extends BaseForm {
    public function initialize()
    {
        $this->add(
            new Text(
                'username',
                [
                    'placeholder' => 'Username',
                    'class'       => 'fadeIn second'
                ]
            )
        );


        $this->add(
            new Password(
                'password',
                [
                    'placeholder' => 'Password',
                    'class'       => 'fadeIn second'
                ]
            )
        );

        $cek = (
            new Check(
                'remember',
                [
                    'value' => 0,
                ]
            )
        );
        $cek->setLabel('Ingat saya');
        $this->add($cek);


        $this->add(
            new Submit (
                'Masuk',
                [
                    'name' => 'login',
                    "class" => "fadeIn fourth"

                ]
            )
        );
        
        $this->setUserOptions([
            'method'=> 'POST',
            'class' => 'loginForm'
        ]);

       $this->setValidation(new LoginValidation());
        
    }
}