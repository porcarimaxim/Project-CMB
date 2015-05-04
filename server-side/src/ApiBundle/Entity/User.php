<?php

namespace ApiBundle\Entity;

use ApiBundle\Entity\Company;
use ApiBundle\Model\UserInterface;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 */
class User implements UserInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $companyId;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $email;

    /**
     * @var \DateTime
     */
    private $updatedOn;

    /**
     * @var \DateTime
     */
    private $createdOn;

    /**
     * @var Company
     */
    private $company;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set companyId
     *
     * @param integer $companyId
     * @return User
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * Get companyId
     *
     * @return integer 
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

	/**
	 * Set updatedOn
	 *
	 * @return User
	 */
	public function setUpdatedOn()
	{
		$this->updatedOn = new DateTime('now');

		return $this;
	}

	/**
	 * Get updatedOn
	 *
	 * @return \DateTime
	 */
	public function getUpdatedOn()
	{
		return $this->updatedOn;
	}

	/**
	 * Set createdOn
	 *
	 * @return User
	 */
	public function setCreatedOn()
	{
		$this->createdOn = new DateTime('now');

		return $this;
	}

	/**
	 * Get createdOn
	 *
	 * @return \DateTime
	 */
	public function getCreatedOn()
	{
		return $this->createdOn;
	}

    /**
     * Set company
     *
     * @param Company $company
     * @return User
     */
    public function setCompany(Company $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return Company
     */
    public function getCompany()
    {
        return $this->company;
    }
}
