<?php

require_once "AppController.php";
require_once __DIR__. "/../models/User.php";
require_once __DIR__. '/../repository/UserRepository.php';

class SecurityController extends AppController{

    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function login(){

        if(isset($_COOKIE['user'])){
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/home");
        }

        if(!$this->isPost()){
            return $this->render('login');
        }


        $email = $_POST["email"];
        $password = $_POST["password"];

        if($email == null or $password == null){
            return $this->render('login',['messages' => ["Missing information"]]);
        }

        $user = $this->userRepository->getUserByEmail($email);

        if(!$user){
            return $this->render('login',['messages' => ["User don't exist"]]);
        }

        if ($user->getEmail() !== $email){
            return $this->render('login',['messages' => ["User don't exist"]]);
        }

        $hash = $user->getPassword();
        if (!password_verify("$password", "$hash")){
            return $this->render('login',['messages' => ["Incorrect Password"]]);
        }

        setcookie('user', $user->getId(), time() + 86400, '/');
        setcookie('role', $this->userRepository->getUserRole($user->getId()), time() + 86400, '/');
        $this->userRepository->changeUserEnabled($user->getId(), true);
        session_start();

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/home");
    }

    public function signup(){
        $userRepository = new UserRepository();

        if(!$this->isPost()){
            return $this->render('signup');
        }

        $name = $_POST["name"];
        $email = $_POST["email"];
        $password1 = $_POST["password1"];
        $password2 = $_POST["password2"];

        if($name == null or $email == null or $password1 == null or $password2==null){
            return $this->render('signup',['messages' => ["Missing information"]]);
        }

        $user = $userRepository->getUserByEmail($email);

        if($user){
            return $this->render('signup',['messages' => ["User already exist"]]);
        }

        if($password1 !== $password2){
            return $this->render('signup',['messages' => ["Passwords are not the same"]]);
        }

        $password = password_hash("$password1", PASSWORD_BCRYPT);
        $user = new User(null, $email,$password,$name, null);

        $userRepository->addUser($user);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}");
    }

    public function logout(){
        if(isset($_COOKIE['user'])){

            $this->userRepository->changeUserEnabled($_COOKIE['user'], false);
            setcookie("user", "",time()-3600);
            setcookie("role", "",time()-3600);
            session_destroy();
        }
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/login");
    }
}