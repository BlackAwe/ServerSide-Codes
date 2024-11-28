<?php
class Item {
    protected $title;
    protected $author;
    protected $year;

    public function __construct($title, $author, $year) {
        $this->setTitle($title);
        $this->setAuthor($author);
        $this->setYear($year);
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        if (empty($title)) throw new Exception("Title cannot be empty");
        $this->title = $title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor($author) {
        if (empty($author)) throw new Exception("Author cannot be empty");
        $this->author = $author;
    }

    public function getYear() {
        return $this->year;
    }

    public function setYear($year) {
        if (!is_numeric($year)) throw new Exception("Year must be a number");
        $this->year = $year;
    }

    public function displayDetails() {
        return "Title: $this->title, Author: $this->author, Year: $this->year";
    }
}
?>
