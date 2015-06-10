<?php

namespace Site\MainBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class PhotoBiographyRepository extends EntityRepository
{
    public function findAll(){
        return $this->findBy(array(), array('date' => 'ASC'));
    }
}
