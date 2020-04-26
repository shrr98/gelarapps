<?php

namespace Gelarapps\Common\Web\Model;

use Phalcon\Mvc\Model;

class Users extends Model
{
    public $username;
    public $password;
    public $nama;
    public $email;
    public $status;
    public $photo;

    public function initialize()
    {
        $this->setSource('Users');
    }
}