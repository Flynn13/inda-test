<?php

namespace App\Controllers;

use App\Repositories\JournalistRepository as Repository;
use Core\Request;

class JournalistController extends Controller {

    private $repository;

    public function __construct($loader, $twig) {
        parent::__construct($loader, $twig);
        $this->repository = new Repository();
    }

    public function index($params, Request $request) {
        $message = false;
        if(isset($_COOKIE['updated'])) {
            $message = true;
            setcookie('updated', 0, time() - 3600);
        }

        $journalists = $this->repository->getAllJournalist();
        $groups = $this->repository->getAllGroup();

        $tpl = $this->twig->load("@templates/journalist.twig");
        echo $tpl->render([
            'journalists' => $journalists,
            'groups'    => $groups,
            'message'   => $message
        ]);
    }

    public function edit($params) {
        $journalist = $this->repository->getJournalistById($params['id']);
        $groups = $this->repository->getAllGroup();

        $tpl = $this->twig->load("@templates/edit-journalist.twig");
        echo $tpl->render([
            'journalist' => $journalist,
            'groups'    => $groups
        ]);
    }
    
}