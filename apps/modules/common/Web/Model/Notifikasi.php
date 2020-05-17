<?php

namespace Gelarapps\Common\Web\Model;

use Phalcon\Mvc\Model;

class Notifikasi extends Model
{
    public $id_konten;
    public $username;
    public $is_read;

    public function initialize()
    {
        $this->setSource('Notifikasi');
    }
}