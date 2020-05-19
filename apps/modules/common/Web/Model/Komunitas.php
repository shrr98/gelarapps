<?php

namespace Gelarapps\Common\Web\Model;

use Phalcon\Mvc\Model;

class Komunitas extends Model
{
    public $id;
    public $nama_komunitas;
    public $alamat;
    public $kategori;
    // public $deskripsi;
    public $deskripsi;
    public $photo_path;
    public $owner;

    public function initialize()
    {
        $this->setSource('Komunitas');
    }
}