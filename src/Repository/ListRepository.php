<?php

namespace App\Repository;

use App\Entity\Lists;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Lists|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lists|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lists[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lists::class);
    }

    /**
     * Saves changes
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @return void
     */
    public function save(): void
    {
        $this->getEntityManager()->flush();
    }

	/**
	 * Fixes changes
	 *
	 * @param Lists $list
	 *
	 * @return void
	 *
	 * @throws \Doctrine\ORM\ORMException
	 */
	public function persist(Lists $list): void
	{
		$this->getEntityManager()->persist($list);
	}

	/**
	 * Removes a list
	 *
	 * @param Lists $list
	 *
	 * @throws \Doctrine\ORM\ORMException
	 */
    public function remove(Lists $list): void
	{
        $this->getEntityManager()->remove($list);
    }
}
