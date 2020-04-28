<?php

namespace Gelarapps\Common\Web\Model;

use Phalcon\Mvc\Model;

class Pagelaran extends Model
{
    public $id;
    public $judul;
    public $tempat;
    public $waktu_mulai;
    public $qaktu_selesai;
    public $deskripsi;
    public $photo_path;


    public function initialize()
    {
        $this->setSource('Pagelaran');
    }
}