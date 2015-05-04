<?php

namespace ApiBundle\Handler;

use ApiBundle\Exception\InvalidFormException;
use ApiBundle\Form\UserType;
use ApiBundle\Model\UserInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;

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
		$user = $this->createUser();
		return $this->processForm($user, $parameters, 'POST');
	}

	/**
	 * @param UserInterface $user
	 * @param array $parameters
	 * @return UserInterface
	 */
	public function put(UserInterface $user, array $parameters)
	{
		// TODO: Implement put() method.
	}

	/**
	 * @param UserInterface $user
	 * @param array $parameters
	 * @return UserInterface
	 */
	public function patch(UserInterface $user, array $parameters)
	{
		// TODO: Implement patch() method.
	}

	/**
	 * Processes the form.
	 *
	 * @param UserInterface $user
	 * @param array         $parameters
	 * @param String        $method
	 *
	 * @return UserInterface
	 *
	 * @throws \ApiBundle\Exception\InvalidFormException
	 */
	private function processForm(UserInterface $user, array $parameters, $method = "PUT")
	{
		$form = $this->formFactory->create(new UserType(), $user, array('method' => $method));
		$form->submit($parameters, 'PATCH' !== $method);
		if ($form->isValid()) {
			$user = $form->getData();
//			var_dump($user); exit;
			$this->om->persist($user);
			$this->om->flush();

			return $user;
		}

		throw new InvalidFormException('Invalid submitted data', $form);
	}

	private function createUser()
	{
		return new $this->entityClass();
	}


}