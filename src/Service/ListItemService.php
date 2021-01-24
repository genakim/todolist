<?php

namespace App\Service;

use App\Dto\Transformer\Request\DtoRequestTransformer;
use App\Dto\Transformer\Request\ListItemRequestDtoTransformer;
use App\Dto\ListItemDto;
use App\Entity\ListItem;
use App\Repository\ListItemRepository;

final class ListItemService
{
	private ListItemRepository $repo;
	private DtoRequestTransformer $transformer;

	public function __construct(
		ListItemRepository $repo,
		ListItemRequestDtoTransformer $transformer
	)
	{
		$this->repo = $repo;
		$this->transformer = $transformer;
	}

	/**
	 * Creates a list item entity
	 *
	 * @param int $parent_id
	 * @param ListItemDto $dto
	 *
	 * @return ListItem
	 */
	private function createItem(int $parent_id, ListItemDto $dto): ListItem
	{
		$item = new ListItem();
		$dto->parent_id = $parent_id;
		$this->transformer->transformObject($item, $dto);

		return $item;
	}

	/**
	 * Creates list items
	 *
	 * @param int $list_id
	 * @param ListItemDto[] $items
	 * @param bool $flush_immediately
	 *
	 * @throws \Doctrine\ORM\ORMException
	 * @throws \Doctrine\ORM\OptimisticLockException
	 */
	public function createItems(int $list_id, array $items, $flush_immediately = false): void
	{
		foreach ($items as $item_dto) {
			$item = $this->createItem($list_id, $item_dto);
			$this->repo->persist($item);
		}

		if ($flush_immediately) {
			$this->repo->save();
		}
	}

	/**
	 * Allows create, update or remove list items.
	 *
	 * @param int $list_id
	 * @param ListItemDto[] $items_dto
	 */
	public function refreshItems(int $list_id, array $items_dto): void
	{
		$list_items = $this->repo->findByParentId($list_id);

		$new_dto_items = [];
		$update_dto_items = [];

		foreach ($items_dto as $dto) {
			if ($dto->id) {
				$update_dto_items[$dto->id] = $dto;
			} else {
				$new_dto_items[] = $dto;
			}
		}

		foreach ($list_items as $list_item) {
			if (isset($update_dto_items[$list_item->getId()])) {
				$list_item = $this
					->transformer
					->transformObject(
						$list_item,
						$update_dto_items[$list_item->getId()]
					);

				$this->repo->persist($list_item);
			} else {
				$this->repo->remove($list_item);
			}
		}

		$this->createItems($list_id, $new_dto_items);

		$this->repo->save();
	}

	/**
	 * @return ListItemRepository
	 */
	public function getRepo(): ListItemRepository
	{
		return $this->repo;
	}
}