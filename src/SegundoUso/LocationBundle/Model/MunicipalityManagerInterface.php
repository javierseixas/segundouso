<?php

namespace SegundoUso\LocationBundle\Model;

use SegundoUso\LocationBundle\Model\MunicipalityInterface;

interface MunicipalityManagerInterface
{
    public function create();

    public function update(MunicipalityInterface $municipality, $andFlush);

    public function find($id);

    public function findBySlug($slug);
}