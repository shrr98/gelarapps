<?php

namespace Gelarapps\Common\Web\Model;

use Phalcon\Mvc\Model;

class Kategori extends Model{
    public $id;
    public $kategori;
    public function initialize()
    {
        $this->setSource('Kategori');
    }
}