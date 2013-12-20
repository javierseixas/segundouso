<?php

namespace SegundoUso\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SegundoUsoUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
