<?php

namespace Gelarapps\Common\Web\Model;

use Phalcon\Mvc\Model;

class Notif_Konten extends Model
{
    public $id;
    public $username;
    public $komunitas;
    public $kegiatan;
    public $pagelaran;
    public $jenis;
    public $waktu;
    private $predikat;


    public function initialize()
    {
        $this->setSource('Notif_Konten');
        $this->predikat = [
            ' ingin bergabung dengan komunitas ',
            ' telah bergabung dengan komunitas ',
            ' membuat pagelaran baru. ',
            ' membuat kegiatan baru. ',
            ' meninggalkan komentar baru di kegiatan ',
        ];
    }

    public function getPredikat(){
        return $this->predikat[$this->jenis];
    }
}