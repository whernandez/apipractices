<?php
/**
 * Created by PhpStorm.
 * User: whernandez
 * Date: 3/21/2018
 * Time: 2:52 PM
 */

namespace AppBundle\Util\Rest;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormInterface;

use Symfony\Component\HttpFoundation\JsonResponse;

class RestResponse extends JsonResponse
{
    /**
     * RestResponse constructor.
     * @param null $data
     * @param int $status
     * @param string $message
     * @param null $errors
     * @param null $redirect
     * @param array $headers
     */
    public function __construct($data = null, $status = 200, $message = "", $errors = null, $redirect = null, array $headers = array())
    {
        // Prepare form errors if provided
        if($errors instanceof Form) {
            $errors = $this->getFormErrors($errors);
        }

        $form = array(
            "has_error" => $this->isError($status),
            "additional_errors" => $errors,
            "code" => $status,
            "message" => ($message != "") ? $message : null,
            "data" => $data,
            "redirect" => ($redirect != "") ? $redirect : null,
        );

        parent::__construct($form, $status, $headers);
    }

    /**
     * @param Form $form
     * @return array
     */
    private function getFormErrors(Form $form)
    {
        $errors = array();

        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }

        foreach ($form->all() as $childForm) {
            if($childForm instanceof FormInterface) {
                if($childErrors = $this->getFormErrors($childForm)) {
                    foreach ($childErrors as $childError) {
                        $errors[] = $childError;
                    }
                }
            }
        }
        return $errors;
    }

    /**
     * @param $status
     * @return bool
     */
    private function isError($status)
    {
        if($status >= 200 && $status <= 299) { return false; }
        if($status >= 300 && $status <= 399) { return false; }
        if($status >= 400 && $status <= 499) { return true; }
        if($status >= 500 && $status <= 599) { return false; }
    }
}