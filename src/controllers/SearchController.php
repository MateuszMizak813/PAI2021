<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/library_position.php';
require_once __DIR__.'/../repository/LibraryRepository.php';

class SearchController extends AppController{
    private $libraryRepository;

    public function __construct()
    {
        parent::__construct();
        $this->libraryRepository = new LibraryRepository();
    }

    public function searchResults(){
        if(!isset($_COOKIE['user'])){
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}");
        }

        $search_phrase = $_POST['search'];
        $elements = $this->libraryRepository->getElementFromLibrary($search_phrase);

        $this->render('search_results',['elements' =>$elements]);
    }

    public function library(){
        if(!isset($_COOKIE['user'])){
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}");
        }

        $elements = $this->libraryRepository->getLibrary($_COOKIE['user']);
        $this->render('library',['elements' =>$elements]);
    }

    public function change_state_of_element(){
        if(!isset($_COOKIE['user'])){
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}");
        }

        $element_id = $_POST['button_element'];
        $user_id = $_COOKIE['user'];

        if( $this->libraryRepository->inUserLibrary($element_id, $user_id)){
            $this->libraryRepository->disconnectUserToElement($element_id,$user_id);
        }
        else{
            $this->libraryRepository->connectUserToElement($element_id,$user_id);
        }

        self::library();
    }
}