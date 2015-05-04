<?php

namespace ApiBundle\Controller;

use ApiBundle\Exception\InvalidFormException;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Util\Codes;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations;
use ApiBundle\Model\UserInterface;

class UsersController extends FOSRestController
{
	/**
	 * @param $id
	 * @return mixed
	 */
	public function getUserAction($id)
	{
		$page = $this->getOr404($id);

		//TODO de implimentat clasa de transdormer
		return $page;
	}


	/**
	 * Return users list
	 * @param Request $request
	 * @return array
	 */
	public function getUsersAction(Request $request)
	{
		$offset = $request->get('offset', 0);
		$limit = $request->get('limit', 5);

		return $this->container->get('api.user.handler')->all($limit, $offset);
	}


	/**
	 * @param Request $request
	 * @return \FOS\RestBundle\View\View
	 */
	public function postUserAction(Request $request)
	{
		try {
			$newPage = $this->container->get('api.user.handler')->post(
				$request->request->all()
			);

			$routeOptions = array(
				'id' => $newPage->getId(),
				'_format' => $request->get('_format')
			);

			return $this->routeRedirectView('api_v1_get_user', $routeOptions, Codes::HTTP_CREATED);

		} catch (InvalidFormException $exception) {

			return $exception->getForm();
		}
	}


	//TODO de mutat in clasa parinte
	protected function getOr404($id)
	{
		if (!($page = $this->container->get('api.user.handler')->get($id))) {
			throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.', $id));
		}
		return $page;
	}

}
