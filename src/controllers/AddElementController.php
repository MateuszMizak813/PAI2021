<?php

require_once "AppController.php";
require_once __DIR__ . "/../models/library_position.php";
require_once __DIR__ . "/../repository/LibraryRepository.php";

class AddElementController extends AppController{

    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    public function add_element_to_db(){
        if(!isset($_COOKIE['user'])){
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}");
        }
        if(!isset($_COOKIE['role']) or !($_COOKIE['role'] == 'admin')){
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/profile");
        }

        if(!$this->isPost()){
            return $this->render('profile');
        }



        $original_title = $_POST["original_title"];
        $pl_title = $_POST["pl_title"];
        $release_date = $_POST["release_date"];
        $description = $_POST["description"];
        $tags = $_POST["tags"];
        $pages = $_POST["pages"];
        $length = $_POST["length"];
        $seasons = $_POST["seasons"];

        if($original_title == null or $release_date == null or $description == null){
            return $this->render('profile',['messages' => ["Missing information"]]);
        }
        if($pages){
            $type = "book";
        }
        elseif ($length){
            $type = "movie";
        }
        elseif ($seasons){
            $type = "series";
        }
        else{
            return $this->render('profile',['messages' => ["Missing information"]]);
        }

        $repository = new LibraryRepository();
        $element = new library_position(null,$original_title, $pl_title, $release_date, null, $description, $type,
                                        $tags, $pages, $length, $seasons);

        $repository->addElement($element);

        return $this->render('profile');
    }

}