<?php

$router->get('', 'PageController@home');
$router->get('about', 'PageController@about');
$router->get('contact', 'PageController@contact');
$router->post('names', 'PageController@insert');
