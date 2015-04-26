<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ApiBundle\Entity\Users;

class DefaultController extends Controller
{
	public function indexAction($name)
	{
		$em = $this->getDoctrine()->getManager();

		$userModel = new Users();
		$userModel->setEmail(time() . '@domain.md');
		$userModel->setFirstName('New');
		$userModel->setLastName('User');
		$em->persist($userModel);
		$em->flush();

		$usersRepository = $em->getRepository('ApiBundle:Users');
		$usersRecords = $usersRepository->findAll();
		return $this->render('ApiBundle:Default:index.html.twig',
			array(
				'name' => $name, 'users' => $usersRecords
			)
		);
	}
}
