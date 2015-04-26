<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ApiBundle\Entity\Users;
use ApiBundle\Entity\UsersRepository;

class DefaultController extends Controller
{
	public function indexAction($name)
	{
		$em = $this->getDoctrine()->getManager();
		$usersRepository = $em->getRepository('ApiBundle:Users');
		$usersRecords = $usersRepository->findAll();
		return $this->render('ApiBundle:Default:index.html.twig',
			array(
				'name' => $name, 'users' => $usersRecords
			)
		);
	}
}
