<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations;

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
	 *
	 * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing pages.")
	 * @Annotations\QueryParam(name="limit", requirements="\d+", default="5", description="How many pages to return.")
	 *
	 * @param ParamFetcherInterface $paramFetcher
	 * @return array
	 */
	public function getUsersAction(ParamFetcherInterface $paramFetcher)
	{
		$offset = $paramFetcher->get('offset');
		$offset = null === $offset ? 0 : $offset;
		$limit = $paramFetcher->get('limit');

		return $this->container->get('api.user.handler')->all($limit, $offset);
	}


	//TODO de mutat in clasa parinte
	protected function getOr404($id)
	{
		if (!($page = $this->container->get('api.user.handler')->get($id))) {
			throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.',$id));
		}
		return $page;
	}
}
