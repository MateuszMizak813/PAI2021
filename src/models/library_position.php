<?php

class library_position{
    private $id;
    private $original_title;
    private $pl_title;
    private $release_date;
    private $img;
    private $description;
    private $type;
    private $tags;
    private $pages;
    private $length;
    private $seasons;

    public function __construct($id, $original_title, $pl_title, $release_date, $img, $description, $type, $tags, $pages, $length, $seasons)
    {
        $this->id = $id;
        $this->original_title = $original_title;
        $this->pl_title = $pl_title;
        $this->release_date = $release_date;
        $this->img = $img;
        $this->description = $description;
        $this->type = $type;
        $this->tags = $tags;
        $this->pages = $pages;
        $this->length = $length;
        $this->seasons = $seasons;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getPages()
    {
        return $this->pages;
    }

    public function setPages($pages): void
    {
        $this->pages = $pages;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function setLength($length): void
    {
        $this->length = $length;
    }

    public function getSeasons()
    {
        return $this->seasons;
    }

    public function setSeasons($seasons): void
    {
        $this->seasons = $seasons;
    }

    public function getOriginalTitle()
    {
        return $this->original_title;
    }

    public function setOriginalTitle($original_title): void
    {
        $this->original_title = $original_title;
    }

    public function getPlTitle()
    {
        return $this->pl_title;
    }

    public function setPlTitle($pl_title): void
    {
        $this->pl_title = $pl_title;
    }

    public function getReleaseDate()
    {
        return $this->release_date;
    }

    public function setReleaseDate($release_date): void
    {
        $this->release_date = $release_date;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function setImg($img): void
    {
        $this->img = $img;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type): void
    {
        $this->type = $type;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function setTags($tags): void
    {
        $this->tags = $tags;
    }


}