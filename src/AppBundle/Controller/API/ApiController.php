<?php

namespace AppBundle\Controller\API;

use AppBundle\Services\API\ApiService;
use AppBundle\Util\Rest\RestResponse;
use JMS\Serializer\SerializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * Prefix
 *
 * @Route("/api")
 */

class ApiController extends Controller
{

    /**
     * List all user data
     * @return RestResponse
     * @Route("/all", name="user_all")
     * @Method("GET")
     */
    public function getAllAction()
    {
        $api = $this->get(ApiService::class)->getAll();
        $context = SerializationContext::create()->setSerializeNull(true)->setGroups('user');
        $api = json_decode($this->container->get('jms_serializer')->serialize($api, 'json', $context));

        // Response to Client
        return new RestResponse($api, 200);
    }

}
