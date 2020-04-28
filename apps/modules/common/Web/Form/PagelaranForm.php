<?php

namespace Gelarapps\Common\Web\Form;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\File;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Submit;

use Gelarapps\Common\Web\Form\BaseForm;
use Gelarapps\Common\Web\Model\Kategori;

class PagelaranForm extends BaseForm {
    public function initialize()
    {
        $this->add(
            new Text(
                'judul',
                [
                    'placeholder' => 'Judul Pagelaran',
                    'class'       => 'fadeIn first'
                ]
            )
        );

        $this->add(
            new Text(
                'tempat',
                [
                    'placeholder' => 'Tempat',
                    'class'       => 'fadeIn first'
                ]
            )
        );

        $this->add(
            new File(
                'photo',
                [
                    'placeholder' => 'Poster',
                    'class'       => 'fadeIn first'
                ]
            )
        );

        
        $this->add(
            new TextArea(
                'deskripsi',
                [
                    'placeholder' => 'Deskripsi',
                    'class'       => 'fadeIn first'
                ]
            )
        );

        $this->add(
             new Text (
                'waktu_mulai',
                [
                    'placeholder' => 'HH/BB/TTTT jj:mm',
                    'class'       => 'form-control fadeIn first'
                ]
            )
        );
        $this->add(
            new Text (
                'waktu_selesai',
                [
                    'placeholder' => 'HH/BB/TTTT jj:mm',
                    'class'       => 'form-control fadeIn first'
                ]
            )
        );

        $this->add(
            new Hidden(
                'komunitas')
        );

        $this->add(
            new Hidden(
                'creator'
            )
        );


        $this->add(
            new Submit (
                'Buat',
                [
                    'name' => 'onbuat',
                    "class" => "fadeIn fourth"

                ]
            )
        );
        
        $this->setUserOptions([
            'method'=> 'POST',
            'class' => 'loginForm',
            'enctype'=>"multipart/form-data"
        ]);        
    }
}