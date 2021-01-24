<?php

namespace App\Repository;

use App\Entity\ListItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ListItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListItem[]    findAll()
 * @method ListItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListItem::class);
    }

	/**
	 * Saves changes
	 *
	 * @return void
	 *
	 * @throws \Doctrine\ORM\ORMException
	 * @throws \Doctrine\ORM\OptimisticLockException
	 */
    public function save(): void
    {
        $this->getEntityManager()->flush();
    }

	/**
	 * Fixes changes
	 *
	 * @param ListItem $item
	 *
	 * @return void
	 *
	 * @throws \Doctrine\ORM\ORMException
	 */
    public function persist(ListItem $item): void
	{
		$this->getEntityManager()->persist($item);
	}

	/**
	 * Removes a list item
	 *
	 * @param ListItem $item
	 *
	 * @throws \Doctrine\ORM\ORMException
	 */
    public function remove(ListItem $item): void
    {
        $this->getEntityManager()->remove($item);
    }

	/**
	 * Finds list items by its parent ID
	 *
	 * @param int $parent_id
	 *
	 * @return ListItem[]
	 */
	public function findByParentId(int $parent_id): array
	{
		return $this->findBy([
			'parentId' => $parent_id
		]);
	}

	/**
	 * Removes list items by its parent ID
	 *
	 * @param int $parent_id
	 */
	public function removeByParentId(int $parent_id): void
	{
		$this->createQueryBuilder('li')
			->delete(ListItem::class, 'li')
			->where('li.parentId = :pid')
			->setParameter(':pid', $parent_id)
			->getQuery()
			->execute();
	}
}
