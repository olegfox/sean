<?php

namespace Site\MainBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Site\MainBundle\Entity\Event;

class NewsRepository extends EntityRepository
{

//  Поиск всех новостей
    public function findAll(){
        return $this->createQueryBuilder('n')
            ->orderBy('n.date', 'desc')
            ->getQuery()
            ->getResult();
    }
}
