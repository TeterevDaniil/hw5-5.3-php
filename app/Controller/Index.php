<?php

namespace APP\Controller;

use Base\AbstractController;

class Index extends AbstractController
{
    public function indexAction()
    {
        var_dump($this->user);
    }
}
