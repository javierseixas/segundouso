<?php

namespace SegundoUso\AdBundle\Model;

// TODO Implement this interface
interface CategoryManagerInterface
{
    public function createCategory();

    public function updateCategory(CategoryInterface $category, $andFlush);

    public function findAll();

    public function findByName($name);
}