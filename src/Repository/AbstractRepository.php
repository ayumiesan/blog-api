<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

abstract class AbstractRepository extends ServiceEntityRepository
{
    const MIN_PAGE = 1;
    const MIN_LIMIT = 1;

    protected function paginate(QueryBuilder $qb, int $page, int $limit): Pagerfanta
    {
        if ($page < self::MIN_PAGE) {
            throw new \LogicException(sprintf('$page must be greater (or equal) than %s.', self::MIN_PAGE));
        }

        if ($limit < self::MIN_LIMIT) {
            throw new \LogicException(sprintf('$limit must be greater (or equal) than %s.', self::MIN_LIMIT ));
        }

        $pager = new Pagerfanta(new DoctrineORMAdapter($qb));

        $pager->setCurrentPage($page);
        $pager->setMaxPerPage($limit);

        return $pager;
    }
}
