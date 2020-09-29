<?php

namespace Core\Interfaces;

use Core\Request;

interface IDispatcher {

    public function handle(Request $request);

    public function notFound();
}