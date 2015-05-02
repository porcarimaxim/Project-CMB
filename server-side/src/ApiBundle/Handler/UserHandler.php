<?php

namespace ApiBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserHandler implements UserHandlerInterface {

	private $om;
	private $entityClass;
	private $repository;
	private $formFactory;

	public function __construct(ObjectManager $om, $entityClass, FormFactoryInterface $formFactory)
	{
		$this->om = $om;
		$this->entityClass = $entityClass;
		$this->repository = $this->om->getRepository($this->entityClass);
		$this->formFactory = $formFactory;
	}

	/**
	 * @param $id
	 * @return UserInterface
	 */
	public function get($id)
	{
		return $this->repository->find($id);
	}

	/**
	 * @param int $limit
	 * @param int $offset
	 * @return array
	 */
	public function all($limit = 5, $offset = 0)
	{
		return $this->repository->findBy(array(), null, $limit, $offset);
	}

	/**
	 * @param array $parameters
	 * @return UserInterface
	 */
	public function post(array $parameters)
	{
		// TODO: Implement post() method.
	}

	/**
	 * @param UserInterface $page
	 * @param array $parameters
	 * @return UserInterface
	 */
	public function put(UserInterface $page, array $parameters)
	{
		// TODO: Implement put() method.
	}

	/**
	 * @param UserInterface $page
	 * @param array $parameters
	 * @return UserInterface
	 */
	public function patch(UserInterface $page, array $parameters)
	{
		// TODO: Implement patch() method.
	}
}