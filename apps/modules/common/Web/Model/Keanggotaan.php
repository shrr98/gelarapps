<?php

namespace Gelarapps\Common\Web\Model;

use Phalcon\Mvc\Model;

class Keanggotaan extends Model{
    public $id_user;
    public $id_komunitas;
    public $tgl_bergabung;
    public $tgl_keluar;
    public $verified;
    public $role;
    
    public function initialize()
    {
        $this->setSource('Keanggotaan');
    }
}