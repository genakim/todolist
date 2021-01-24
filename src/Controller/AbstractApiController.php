<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Returns response
 *
 * @param $data
 * @param int $status
 * @param array $headers
 *
 * @return JsonResponse
 */
class AbstractApiController extends AbstractFOSRestController
{
   protected function buildForm(string $type, $data = null, array $options = []): FormInterface
   {
       $options = array_merge($options, ['csrf_protection' => false]);

       return $this->container->get('form.factory')->createNamed('', $type, $data, $options);
   }

   protected function response($data, int $status_code = Response::HTTP_OK, $headers = []): Response
   {
       return $this->handleView($this->view($data, $status_code, $headers));
   }
}
