<?php

namespace AppBundle\Entity\API;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Api
 *
 * @ORM\Table(name="api")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\API\ApiRepository")
 */
class Api
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotNull(message="Application name field should not be null")
     * @Assert\NotBlank(message="Application name field should not be blank")
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @Assert\NotNull(message="Application fullname field should not be null")
     * @Assert\NotBlank(message="Application fullname field should not be blank")
     * @ORM\Column(name="fullname", type="string", length=255)
     */
    private $fullname;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Api
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set fullname
     *
     * @param string $fullname
     *
     * @return Api
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * Get fullname
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->fullname;
    }
}

