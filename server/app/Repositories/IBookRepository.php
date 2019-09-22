<?php


namespace App\Repositories;


interface IBookRepository
{
    /**
     * Get's a post by it's ID
     *
     * @param string $book_id
     */
    public function get(string $book_id);

    /**
     * Get all books.
     *
     * @param $queryString
     * @return mixed
     */
    public function all($queryString);

    /**
     * Deletes a book
     *
     * @param string $book_id
     */
    public function delete(string $book_id);

    /**
     * Updates a post
     *
     * @param string $book_id
     * @param array $book_data
     */
    public function update(string $book_id, array $book_data);

    /**
     * Creates a book
     *
     * @param array $book_data
     * @return void
     */
    public function create(array $book_data);

    /**
     * @return array
     */
    public function getFields();
}
