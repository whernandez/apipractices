<?php

/**
 * Created by PhpStorm.
 * User: Wandy
 * Date: 2018-03-20
 * Time: 11:08 PM
 */

namespace AppBundle\Services\API;

use AppBundle\Entity\API;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializationContext;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class ApiService
{
    /** @var ContainerInterface $container */
    private $container;

    /** @var EntityManagerInterface $em */
    private $em;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        try {
            $this->em = $container->get('doctrine')->getManager();
        } catch (NotFoundExceptionInterface $e) {
        } catch (ContainerExceptionInterface $e) {
        }
    }

    /**
     * @return array|\Doctrine\Common\Persistence\ObjectRepository|mixed
     */
    public function getAll() {
        dump('ok');
        die;
        return $this->em->getRepository(API\Api::class)->findAll();
    }

}