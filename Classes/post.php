<?php
class post
{
    private $id;
    private $username;
    private $title;
    private $image;
    private $date_time;
    private $content;

    function __construct($id, $username, $title, $image, $date_time, $content)
    {
        $this->id = $id;
        $this->username = $username;
        $this->title = $title;
        $this->date_time = $date_time;
        $this->content = $content;
        $this->image = $image;
    }

    function getId()
    {
        return $this->id;
    }
    function getUsername()
    {

        return  $this->username;
    }
    function getTitle()
    {

        return $this->title;
    }
    function getImage()
    {

        return $this->image;
    }
    function getDateTime()
    {

        return $this->date_time;
    }




    function getContent()
    {

        return $this->content;
    }
}
