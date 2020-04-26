<?php

namespace Gelarapps\Common\Web\Model;

use Phalcon\Mvc\Model;

class Pagelaran extends Model
{
    public $id;
    public $password;
    public $nama;
    public $email;
    public $status;
    public $photo;

    public function initialize()
    {
        $this->setSource('Pagelaran');
    }
}