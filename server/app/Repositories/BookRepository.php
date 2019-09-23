<?php


namespace App\Repositories;


use App\Book;

class BookRepository implements IBookRepository
{

    private $book;

    /**
     * BookRepository constructor.
     * @param $book
     */
    public function __construct(Book $book)
    {
        $this->book = $book;
    }


    /**
     * Get's a post by it's ID
     *
     * @param string $book_id
     * @return Book model
     */
    public function get(string $book_id)
    {
        return $this->book->find($book_id);
    }

    /**
     * Get all books.
     *
     * @param $queryString
     * @param $order
     * @return mixed
     */
    public function all($queryString, $order)
    {
        return $this->book->search($queryString, $order)->paginate(20);
    }

    /**
     * Deletes a book
     *
     * @param string $book_id
     */
    public function delete(string $book_id)
    {
        $this->book->find($book_id)->delete();
    }

    /**
     * Updates a post
     *
     * @param string $book_id
     * @param array $book_data
     */
    public function update(string $book_id, array $book_data)
    {
        $book = $this->book->find($book_id);
        $book->fill($book_data)->save();
    }

    /**
     * Creates a book
     *
     * @param array $book_data
     * @return void
     */
    public function create(array $book_data)
    {
        $this->book->fill($book_data)->save();
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->book->getFillable();
    }
}
