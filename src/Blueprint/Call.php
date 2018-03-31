<?php declare(strict_types=1);

namespace Oprokidnev\CodeceptToBlueprint\Blueprint;

class Call
{
    protected $title;
    protected $isAuthRequired;
    protected $request;
    protected $response;

    /**
     * Call constructor.
     *
     * @param $title
     */
    public function __construct($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return Call
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getisAuthRequired()
    {
        return $this->isAuthRequired;
    }

    /**
     * @param mixed $isAuthRequired
     * @return Call
     */
    public function setIsAuthRequired($isAuthRequired)
    {
        $this->isAuthRequired = $isAuthRequired;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param mixed $request
     * @return Call
     */
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     * @return Call
     */
    public function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }


}