<?php

namespace Gelarapps\Common\Web\Form;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\File;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Submit;

use Gelarapps\Common\Web\Form\BaseForm;
use Gelarapps\Common\Web\Model\Kategori;

class KomunitasForm extends BaseForm {
    public function initialize()
    {
        $this->add(
            new Text(
                'nama_komunitas',
                [
                    'placeholder' => 'Nama Komunitas',
                    'class'       => 'fadeIn first'
                ]
            )
        );

        $this->add(
            new Select(
                'kategori',
                $this->generateOptions()
            )
        );

        $this->add(
            new File(
                'photo',
                [
                    'placeholder' => 'Gambar',
                    'class'       => 'fadeIn first'
                ]
            )
        );

        $this->add(
            new TextArea(
                'alamat',
                [
                    'placeholder' => 'Alamat',
                    'class'       => 'fadeIn second'
                ]
            )
        );
        $this->add(
            new TextArea(
                'deskripsi',
                [
                    'placeholder' => 'Deskripsi',
                    'class'       => 'fadeIn third'
                ]
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
        
        $this->add(
            new Submit (
                'Simpan',
                [
                    'name' => 'onsimpan',
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

    private function generateOptions(){
        $kategori = Kategori::find();

        $options = [];
        foreach($kategori as $k){
            $options[$k->id] = $k->kategori;
        }

        return $options;
    }
}