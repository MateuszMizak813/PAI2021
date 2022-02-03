<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/library_position.php';
require_once __DIR__.'/../repository/LibraryRepository.php';

class SingleElementController extends AppController
{
    private $libraryRepository;

    public function __construct()
    {
        parent::__construct();
        $this->libraryRepository = new LibraryRepository();
    }

    public function single_element(){
        if(!isset($_COOKIE['user'])){
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/home");
        }

        $element_id = $_POST['button_element2'];
        $element = $this->libraryRepository->getElementById($element_id);


        $this->render('single_element',['element' =>$element]);
    }

}