<?php
class comment
{
    private $id;
    private $comment;
    private $postId;
    private $userId;

    function __construct($id, $comment, $postId, $userId)
    {
        $this->id = $id;
        $this->comment = $comment;
        $this->postId = $postId;
        $this->userId = $userId;
    }

    function getId()
    {

        return $this->id;
    }
    function getComment()
    {

        return $this->comment;
    }
    function getPostId()
    {

        return $this->postId;
    }
    function getUserId()
    {

        return $this->userId;
    }
}
