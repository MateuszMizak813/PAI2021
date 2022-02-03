<?php

require_once "Repository.php";
require_once __DIR__ . '/../models/User.php';

class UserRepository extends Repository{

    public function getUserByEmail(string $email): ?User{
        $query = $this->database->connect()->prepare('
            SELECT u.id, u.name, u.email, u.password, r.role_name FROM public.users u
                join roles r on r.id = u.role_id
            WHERE email = :email
        ');
        $query->bindParam(':email',$email, PDO::PARAM_STR);
        $query->execute();

        $user = $query->fetch(PDO::FETCH_ASSOC);

        if($user == false){
            return null;
        }

        return new User(
            $user['id'],
            $user['email'],
            $user['password'],
            $user['name'],
            $user['role_name']
        );
    }

    public function getUserByID(int $id): ?User{
        $query = $this->database->connect()->prepare('
            SELECT u.id, u.name, u.email, u.password, r.role_name FROM public.users u
                join roles r on r.id = u.role_id
            WHERE u.id = :id
        ');
        $query->bindParam(':id',$id, PDO::PARAM_INT);
        $query->execute();

        $user = $query->fetch(PDO::FETCH_ASSOC);

        if($user == false){
            return null;
        }

        return new User(
            $user['id'],
            $user['email'],
            $user['password'],
            $user['name'],
            $user['role_name']
        );
    }

    public function isUserEnabled(int $user_id) :bool {
        $query = $this->database->connect()->prepare('
            select enabled from users where id = :id
        ');
        $query->bindParam(':id',$user_id, PDO::PARAM_INT);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);

        return $user['enabled'];
    }

    public function getUserRole(int $user_id){
        $query = $this->database->connect()->prepare('
            select role_name from roles join users u on roles.id = u.role_id where u.id = :id
        ');
        $query->bindParam(':id',$user_id, PDO::PARAM_INT);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);

        return $user['role_name'];
    }

    public function changeUserEnabled(int $user_id, bool $enabled){
        $query = $this->database->connect()->prepare('
            update users set enabled = :enabled where id = :id
        ');
        $query->bindParam(':enabled',$enabled,PDO::PARAM_BOOL);
        $query->bindParam(':id',$user_id,PDO::PARAM_INT);
        $query->execute();
    }

    public function addUser(User $user){
        $query = $this->database->connect()->prepare('
            INSERT INTO public.users (name, email, password)
            VALUES (?,?,?)
        ');

        $query->execute([
            $user->getName(),
            $user->getEmail(),
            $user->getPassword()
        ]);
    }
}