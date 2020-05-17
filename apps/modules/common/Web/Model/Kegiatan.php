<?php

namespace Gelarapps\Common\Web\Model;

use Phalcon\Mvc\Model;

class Kegiatan extends Model
{
    public $id;
    public $creator;
    public $judul;
    public $id_komunitas;
    public $waktu_mulai;
    public $waktu_selesai;
    public $deskripsi;
    public $tempat;


    public function initialize()
    {
        $this->setSource('Kegiatan');
    }
}