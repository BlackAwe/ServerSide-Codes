<?php
require_once 'Item.php';
// Inheritance
class Book extends Item
{
    private $isbn;
    private $genre;

    public function __construct($title, $author, $year, $isbn, $genre)
    {
        parent::__construct($title, $author, $year);
        $this->setISBN($isbn);
        $this->setGenre($genre);
    }

    public function getISBN()
    {
        return $this->isbn;
    }

    public function setISBN($isbn)
    {
        if (empty($isbn)) throw new Exception("ISBN cannot be empty");
        $this->isbn = $isbn;
    }

    public function getGenre()
    {
        return $this->genre;
    }

    public function setGenre($genre)
    {
        if (empty($genre)) throw new Exception("Genre cannot be empty");
        $this->genre = $genre;
    }
    // Polymorphism
    public function displayDetails()
    {
        return parent::displayDetails() . ", ISBN: $this->isbn, Genre: $this->genre";
    }
}
