<?php

namespace ApiBundle\Handler;


use ApiBundle\Model\UserInterface;

interface UserHandlerInterface {

	/**
	 * @param $id
	 * @return UserInterface
	 */
	public function get($id);

	/**
	 * @param int $limit
	 * @param int $offset
	 * @return array
	 */
	public function all($limit = 5, $offset = 0);

	/**
	 * @param array $parameters
	 * @return UserInterface
	 */
	public function post(array $parameters);

	/**
	 * @param UserInterface $page
	 * @param array $parameters
	 * @return UserInterface
	 */
	public function put(UserInterface $page, array $parameters);

	/**
	 * @param UserInterface $page
	 * @param array $parameters
	 * @return UserInterface
	 */
	public function patch(UserInterface $page, array $parameters);
}