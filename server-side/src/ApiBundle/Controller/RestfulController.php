<?php

namespace ApiBundle\Controller;

use ApiBundle\Entity\Users;
use ApiBundle\Form\UsersType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use Symfony\Component\HttpFoundation\Request;

class RestfulController extends FOSRestController
{
	/**
	 * Return users list
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function getUsersAction()
	{
		$em = $this->getDoctrine()->getManager();

		$usersRepository = $em->getRepository('ApiBundle:Users');
		$usersRecords = $usersRepository->findAll();

		$data = $usersRecords;
		$view = $this->view($data, 200)
			->setTemplate('ApiBundle:Default:index.html.twig')
			->setTemplateVar('users');

		return $this->handleView($view);
	}

	/**
	 * Return one user by id
	 *
	 * @param $id
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function getUserAction($id)
	{
		$em = $this->getDoctrine()->getManager();
		$usersRepository = $em->getRepository('ApiBundle:Users');

		$data = $usersRepository->find($id);
		$view = $this->view($data, 200)
			->setTemplate('ApiBundle:Default:index.html.twig')
			->setTemplateVar('users');

		return $this->handleView($view);
	}

	public function postUserAction(Request $request)
	{
		$usersModel = new Users();
		$form = $this->createForm(new UsersType(), $usersModel);
		$form->submit($request);
		if ($form->isValid()) {
			
			$em = $this->getDoctrine()->getManager();
			$em->persist($usersModel);
			$em->flush();

			$routeOptions = array(
				'id' => $usersModel->getId(),
				'_format' => $request->get('_format')
			);

			return $this->routeRedirectView('api_v1_get_user', $routeOptions, Codes::HTTP_CREATED);
		}
	}
}