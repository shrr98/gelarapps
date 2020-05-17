<?php

namespace Gelarapps\Common\Web\Model;

use Phalcon\Mvc\Model;

class Komentar extends Model
{
    public $id;
    public $id_kegiatan;
    public $author;
    public $isi;

    public function initialize()
    {
        $this->setSource('Komentar');
    }
}