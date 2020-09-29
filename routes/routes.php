<?php

$router->get('/', 'JournalistController@index');
$router->get('/journalist/{id:int}/edit', 'JournalistController@edit');

/** API routes */
$router->post('/search', 'ApiJournalistController@searchById');
$router->post('/journalist/add', 'ApiJournalistController@addJournalist');
$router->post('/journalist/filter', 'ApiJournalistController@filter');
$router->post('/journalist/update', 'ApiJournalistController@updateJournalist');




