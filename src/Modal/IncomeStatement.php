<?php


namespace App\Modal;


class IncomeStatement
{
    private $id;
    private $chapterNumber;
    private $title;
    private $content;
    private $author;
    private $createdAt;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
}