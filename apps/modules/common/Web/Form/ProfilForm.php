<?php

namespace Gelarapps\Common\Web\Form;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Submit;

use Gelarapps\Common\Web\Validator\ProfilValidation;
use Gelarapps\Common\Web\Form\BaseForm;

class ProfilForm extends BaseForm {
    public function initialize()
    {
        $this->add(
            new Text(
                'nama',
                [
                    'placeholder' => 'Nama',
                    'class'       => 'fadeIn first'
                ]
            )
        );

        $this->add(
            new TextArea(
                'status',
                [
                    'placeholder' => 'Status',
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
            'class' => 'profilForm',
            'action'=>'profil/simpan'
        ]);

        $this->setValidation(new ProfilValidation());
        
    }
}