<?php

namespace App\Controller;

use App\Dto\MessageDto;
use App\Dto\Request\ListRequestDto;
use App\Entity\Lists;
use App\Form\Type\ListType;
use App\Service\ListService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ListController extends AbstractApiController
{
	/**
	 * Gets lists with items
	 *
	 * @param Request $request
	 * @param ListService $service

	 * @return Response
	 */
    public function index(Request $request, ListService $service): Response
    {
        $data = $service->all();
        return $this->response($data);
    }

	/**
	 * Creates list
	 *
	 * @param Request $request
	 * @param ListService $service
	 *
	 * @return Response
	 *
	 * @throws \Doctrine\ORM\ORMException
	 * @throws \Doctrine\ORM\OptimisticLockException
	 */
    public function create(Request $request, ListService $service): Response
    {
    	$dto = new ListRequestDto();
		$form = $this->buildForm(ListType::class, $dto);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			return $this->response(
				$service->createList($dto)
			);
		}

		return $this->response($form, Response::HTTP_BAD_REQUEST);
    }

	/**
	 * Updates list
	 *
	 * @param Lists $list
	 * @param Request $request
	 * @param ListService $service
	 *
	 * @return Response
	 *
	 * @throws \Doctrine\ORM\ORMException
	 * @throws \Doctrine\ORM\OptimisticLockException
	 */
    public function update(Lists $list, Request $request, ListService $service): Response
    {
		$dto = new ListRequestDto();
		$form = $this->buildForm(ListType::class, $dto);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			return $this->response(
				$service->updateList($list, $dto)
			);
		}

		return $this->response($form, Response::HTTP_BAD_REQUEST);
    }

	/**
	 * Deletes list
	 *
	 * @param Lists $list
	 * @param ListService $list_service
	 *
	 * @return Response
	 */
    public function delete(Lists $list, ListService $list_service): Response
    {
		$list_service->delete($list);
        return $this->response(new MessageDto('Deleted successfully'));
    }
}
