<?php

namespace App\Repository;

use App\Entity\Content;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Content>
 *
 * @method Content|null find($id, $lockMode = null, $lockVersion = null)
 * @method Content|null findOneBy(array $criteria, array $orderBy = null)
 * @method Content[]    findAll()
 * @method Content[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Content::class);
    }

    public function findByType(string $type): array
    {
        $qb = $this->createQueryBuilder('c')
            ->where('c.type = :type')
            ->setParameter('type', $type);

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function findCoursesByTitle(string $title): array
    {
        $qb = $this->createQueryBuilder('c')
            ->where('c.type = :type')
            ->andWhere('c.title = :title')
            ->setParameter('type', 'course')
            ->setParameter('title', $title);
    
        $query = $qb->getQuery();
    
        return $query->getResult();
    }
}

