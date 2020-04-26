<?php

namespace Gelarapps\Common;

use Phalcon\Di\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces([
            'Gelarapps\Common\Web\Controller' => __DIR__ . '/Web/Controller',
            'Gelarapps\Common\Web\Model' => __DIR__ . '/Web/Model',
            'Gelarapps\Common\Web\Validator' => __DIR__ . '/Web/Validator',
            'Gelarapps\Common\Web\Form' => __DIR__ . '/Web/Form',

                    
        ]);

        $loader->register();
    }

    public function registerServices(DiInterface $di = null)
    {
        $moduleConfig = require __DIR__ . '/config/config.php';

        $di->get('config')->merge($moduleConfig);

        include_once __DIR__ . '/config/services.php';
    }

}