<?php

require_once "Repository.php";
require_once __DIR__ . '/../models/library_position.php';

class LibraryRepository extends Repository{
    public function addElement(library_position $element){

        $additional_info_id = self::addAdditionalInfo($element);
        $library_id = self::addLibrary($element, $additional_info_id);
        self::addTags($element, $library_id);

    }

    public function getElementFromLibrary(string $search_phrase){
        $results = [];
        $search_phrase = '%'.strtolower($search_phrase).'%';

        $query = $this->database->connect()->prepare('
            select Distinct l.id, l.additional_info_id, l.original_title, l.pl_title, l.release_date, l.description,
                            t2.type_name, ai.pages, ai.length, ai.seasons from library l
                                join additional_info ai on l.additional_info_id = ai.id
                                join types t2 on t2.id = ai.type_id
            where lower(l.original_title) like :search_phrase or lower(l.pl_title) like :search_phrase
            union
            SELECT DISTINCT l.id, l.additional_info_id, l.original_title, l.pl_title, l.release_date, l.description,
                            t2.type_name, ai.pages, ai.length, ai.seasons from library l
                                join additional_info ai on l.additional_info_id = ai.id
                                join types t2 on t2.id = ai.type_id
                                join library_tags lt on l.id = lt.library_id
                                join tags t on t.id = lt.tags_id 
            where lower(t.tag_name) like :search_phrase
        ');
        $query->bindParam(':search_phrase',$search_phrase,PDO::PARAM_STR);
        $query->execute();
        $elements = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($elements as $element){
            $results[] = new library_position(
                $element['id'],
                $element['original_title'],
                $element['pl_title'],
                $element['release_data'],
                null,
                $element['description'],
                $element['type_name'],
                null,
                $element['pages'],
                $element['length'],
                $element['seasons']
            );
        }


        return $results;
    }

    private function addAdditionalInfo(library_position $element){
        $query = $this->database->connect()->prepare('
            INSERT INTO public.additional_info (type_id, pages, length, seasons)
            VALUES (?,?,?,?)
        ');
        $type = null;
        switch ($element->getType()){
            case "book":
                $type = 1;
                break;
            case "movie":
                $type = 2;
                break;
            case "series":
                $type = 3;
                break;
        }
        $query->execute([
            $type,
            $element->getPages(),
            $element->getLength(),
            $element->getSeasons()
        ]);

        $query = $this->database->connect()->prepare('
            SELECT * FROM public.additional_info WHERE id = (SELECT MAX(id) FROM public.additional_info)
        ');
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }

    private function addLibrary(library_position $element, $additional_info_id){
        $query = $this->database->connect()->prepare('
            INSERT INTO public.library (additional_info_id, original_title, pl_title, release_date, img, description)
            VALUES (?,?,?,?,?,?)
        ');
        $query->execute([
            $additional_info_id,
            $element->getOriginalTitle(),
            $element->getPlTitle(),
            $element->getReleaseDate(),
            $element->getImg(),
            $element->getDescription()
        ]);

        $query = $this->database->connect()->prepare('
            SELECT * FROM public.library WHERE id = (SELECT MAX(id) FROM public.library)
        ');
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }

    private function addTags(library_position $element, $library_id){
        $tags = $element->getTags();
        $tags_arr = explode("#", $tags);
        foreach ($tags_arr as $tag){
            $tag = trim($tag);
            $tag_id = $this->getTagId($tag);
            $query = $this->database->connect()->prepare('
            INSERT INTO public.library_tags (library_id, tags_id)
            VALUES (?, ?)
            ');
            $query->execute([
                $library_id,
                $tag_id
            ]);
        }
    }

    private function getTagId($tag){
        $query = $this->database->connect()->prepare('
            SELECT * FROM public.tags WHERE tag_name = :tag
        ');
        $query->bindParam(':tag',$tag, PDO::PARAM_STR);
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);

        if($data){
            return $data["id"];
        }

        $query = $this->database->connect()->prepare('
            INSERT INTO public.tags (tag_name)
            VALUES (?)
        ');
        $query->execute([
            $tag
        ]);

        $query = $this->database->connect()->prepare('
            SELECT * FROM public.tags WHERE id = (SELECT MAX(id) FROM public.tags)
        ');
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }

    public function inUserLibrary(int $element_id, int $user_id) :bool{
        $query = $this->database->connect()->prepare('
            SELECT * FROM public.users u
                join users_library ul on u.id = ul.user_id
                join library l on ul.library_id = l.id 
            where u.id = :id and l.id = :element_id
        ');
        $query->bindParam(':id',$user_id, PDO::PARAM_INT);
        $query->bindParam(':element_id',$element_id, PDO::PARAM_INT);
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);
        if($data){
            return true;
        }
        return false;
    }

    public function getLibrary(int $user_id){
        $results = [];
        $query = $this->database->connect()->prepare('
            select Distinct l.id, l.additional_info_id, l.original_title, l.pl_title, l.release_date, l.description,
                t2.type_name, ai.pages, ai.length, ai.seasons from library l
                    join additional_info ai on l.additional_info_id = ai.id
                    join types t2 on t2.id = ai.type_id
                    join users_library ul on l.id = ul.library_id
                    join users u on u.id = ul.user_id
                    where u.id = :id
        ');
        $query->bindParam(':id',$user_id,PDO::PARAM_INT);
        $query->execute();
        $elements = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($elements as $element){
            $results[] = new library_position(
                $element['id'],
                $element['original_title'],
                $element['pl_title'],
                $element['release_data'],
                null,
                $element['description'],
                $element['type_name'],
                null,
                $element['pages'],
                $element['length'],
                $element['seasons']
            );
        }
        return $results;
    }

    public function connectUserToElement(int $element_id, int $user_id){
        $query = $this->database->connect()->prepare('
            INSERT INTO public.users_library (user_id, library_id, add_date)
            VALUES (?, ?, ?)
        ');
        $query->execute([
            $user_id,
            $element_id,
            date("Y-m-d")
        ]);
    }

    public function disconnectUserToElement(int $element_id, int $user_id){
        $query = $this->database->connect()->prepare('
            DELETE from public.users_library where user_id = :user_id and library_id = :library_id
        ');
        $query->bindParam(':user_id',$user_id, PDO::PARAM_INT);
        $query->bindParam(':library_id',$element_id, PDO::PARAM_INT);

        $query->execute();
    }

    public function getElementById(int $element_id){
        $query = $this->database->connect()->prepare('
            select Distinct l.id, l.additional_info_id, l.original_title, l.pl_title, l.release_date, l.description,
                            t2.type_name, ai.pages, ai.length, ai.seasons from library l
                                join additional_info ai on l.additional_info_id = ai.id
                                join types t2 on t2.id = ai.type_id
            where l.id = :id
        ');
        $query->bindParam(':id',$element_id,PDO::PARAM_INT);
        $query->execute();
        $element = $query->fetchAll(PDO::FETCH_ASSOC);

        $single_element = new library_position(
            $element['id'],
            $element['original_title'],
            $element['pl_title'],
            $element['release_data'],
            null,
            $element['description'],
            $element['type_name'],
            null,
            $element['pages'],
            $element['length'],
            $element['seasons']
        );

        return $single_element;
    }
}