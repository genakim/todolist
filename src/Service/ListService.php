<?php

namespace App\Service;

use App\Dto\Transformer\Request\DtoRequestTransformer;
use App\Dto\Transformer\Request\ListRequestDtoTransformer;
use App\Dto\Transformer\Response\ListItemResponseDtoTransformer;
use App\Dto\Transformer\Response\ListResponseDtoTransformer;
use App\Entity\Lists;
use App\Dto\ListDto;
use App\Repository\ListRepository;

final class ListService
{
	private ListRepository $repo;
	private ListItemService $item_service;
	private DtoRequestTransformer $transformer;

	public function __construct(
		ListRepository $repo,
		ListItemService $item_service,
		ListRequestDtoTransformer $transformer
	)
	{
		$this->repo = $repo;
		$this->item_service = $item_service;
		$this->transformer = $transformer;
	}

	/**
	 * Creates a list
	 *
	 * @param ListDto $dto
	 *
	 * @return Lists
	 *
	 * @throws \Doctrine\ORM\ORMException
	 * @throws \Doctrine\ORM\OptimisticLockException
	 */
	public function createList(ListDto $dto): Lists
	{
		$list = new Lists();

		$this->transformer->transformObject($list, $dto);

		$this->repo->persist($list);
		$this->repo->save();

		$this->item_service->createItems($list->getId(), $dto->items, true
		);

		return $list;
	}

	/**
	 * Updates list
	 *
	 * @param Lists $list
	 * @param ListDto $dto
	 *
	 * @return Lists
	 *
	 * @throws \Doctrine\ORM\ORMException
	 * @throws \Doctrine\ORM\OptimisticLockException
	 */
	public function updateList(Lists $list, ListDto $dto): Lists
	{
		$list = $this->transformer->transformObject($list, $dto);

		$this->repo->persist($list);
		$this->repo->save();

		$this->item_service->refreshItems($list->getId(), $dto->items);

		return $list;
	}

	/**
	 * Deletes a list
	 *
	 * @param Lists $list
	 */
	public function delete(Lists $list): void
	{
		$this
			->item_service
			->getRepo()
			->removeByParentId($list->getId());

		$this->repo->remove($list);
		$this->repo->save();
	}

	/**
	 * Returns all entities
	 */
	public function all(): array
	{
		// TODO: pagination + filters

		$lists_transformer = new ListResponseDtoTransformer();
		$items_transformer = new ListItemResponseDtoTransformer();

		$lists = $this->repo->findAll();
		$items = $this->item_service->getRepo()->findAll();

		$lists_dto = $lists_transformer->transformObjects($lists);
		$items_dto = $items_transformer->transformObjects($items);

		return array_merge($lists_dto, $items_dto);
	}
}