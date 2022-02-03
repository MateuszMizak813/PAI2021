<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('home','DefaultController');
Routing::get('signup', "DefaultController");
Routing::get('profile', "DefaultController");
Routing::get('library','SearchController');
Routing::get('add_element', "DefaultController");
Routing::post('searchResults', "SearchController");
Routing::post('login', 'SecurityController');
Routing::post('signup', "SecurityController");
Routing::post('home_page',"SearchController");
Routing::post('add_element_to_db', "AddElementController");
Routing::post('logout',"SecurityController");
Routing::post('change_state_of_element', "SearchController");
Routing::post('single_element', "SingleElementController");

Routing::run($path);
