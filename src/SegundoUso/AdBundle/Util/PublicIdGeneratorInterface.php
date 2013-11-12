<?php
/**
 * Created by JetBrains PhpStorm.
 * User: javierseixas
 * Date: 26/10/13
 * Time: 13:52
 * To change this template use File | Settings | File Templates.
 */
namespace SegundoUso\AdBundle\Util;


interface PublicIdGeneratorInterface
{

    const STRING_LENGTH = 64;

    public function generate();
}