<?php


namespace App\Controllers;


use App\Repositories\JournalistRepository as Repository;
use Core\Request;
use Core\Response;

class ApiJournalistController extends Controller {

    private $repository;

    public function __construct($loader, $twig) {
        parent::__construct($loader, $twig);
        $this->repository = new Repository();
    }

    public function searchById($params, Request $request) {
        $requestData = $request->getBody();
        $journalist = $this->repository->getJournalistById($requestData->id);

        $response = new Response();
        $response->setBody($journalist, true);
        $response->send();
    }

    public function addJournalist($params, Request $request) {
        $requestData = $request->getBody();
        $cleanedData = [
            'name' => htmlentities($requestData->name),
            'alias' => htmlentities($requestData->alias),
            'group_id' => htmlentities($requestData->group_id),
        ];

        if($this->repository->addJournalist($cleanedData)) {
            $response = new Response();
            $response->setBody(['status' => 'success'], true);
            $response->send();
        }

    }

    public function updateJournalist($param, Request $request) {
        $requestData = $request->getBody();
        $cleanedData = [
            'id'        => htmlentities($requestData->id),
            'name'      => htmlentities($requestData->name),
            'alias'     => htmlentities($requestData->alias),
            'group_id'  => htmlentities($requestData->group_id),
        ];
        $this->repository->editJournalist($cleanedData);
        setcookie('updated', 1, time() + (86400 * 30), "/");
        $response = new Response();
        $response->setBody(['status' => 'success'], true);
        $response->send();
    }

    public function filter($params, Request $request) {
        $requestData = $request->getBody();
        $journalists = $this->repository->getAllJournalist($requestData->id);

        $response = new Response();
        $response->setBody($journalists, true);
        $response->send();
    }

}