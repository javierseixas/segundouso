<?php

/**
 * This class has been created following the example of FOSUserBundle where exists an UserInterface and a abstract User class
 * Then, a entity extending the abstract User is created
 * But in that case, as there is no needed to such as abstract class, this class is not use at the time of writing this note
 */

namespace SegundoUso\AdBundle\Model;


abstract class Ad implements AdInterface
{
    public function setPid()
    {
    }
}