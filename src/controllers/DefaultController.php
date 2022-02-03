<?php

require_once 'AppController.php';
require_once __DIR__."/../repository/LibraryRepository.php";

class DefaultController extends AppController{
    public function login() {
        if(isset($_COOKIE['user'])){
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/home");
        }

        $this->render('login');
    }
    public function home(){
        if(!isset($_COOKIE['user'])){
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}");
        }

        $this->render('home_page');
    }
    public function signup(){
        if(isset($_COOKIE['user'])){
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/home");
        }

        $this->render('signup');
    }
    public function profile(){
        if(!isset($_COOKIE['user'])){
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}");
        }

        $this->render('profile');
    }
    public function library(){
        if(!isset($_COOKIE['user'])){
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}");
        }

        $this->render('library');
    }
    public function add_element(){
        if(!isset($_COOKIE['user'])){
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}");
        }
        if(!isset($_COOKIE['role']) or !($_COOKIE['role'] == 'admin')){
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/profile");
        }

        $this->render('add_element');
    }
}