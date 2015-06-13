<?php

namespace Site\MainBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * CommentsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommentsRepository extends EntityRepository
{
    //  Поиск всех комментариев
    public function findAll(){
        return $this->createQueryBuilder('n')
            ->orderBy('n.date', 'desc')
            ->getQuery()
            ->getResult();
    }
}