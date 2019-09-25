<?php

namespace Tests\Unit;

use App\Book;
use App\Helpers\AppHelper;
use App\Repositories\IBookRepository;
use Tests\TestCase;
use App\Http\Resources\Book as BookResource;

class BookControllerTests extends TestCase
{
    private $mockedRepository;
    private $book;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mockedRepository = AppHelper::mock(IBookRepository::class);
        $this->book = new Book();
        $this->book->setRawAttributes(['_id' => 1, 'author' => 'someAuthor', 'price' => '13.5', 'title' => 'someTitle']);

        $this->mockedRepository->shouldReceive('getFields')->andReturn(['author', 'title', 'price']);
        $this->mockedRepository->shouldReceive('create')->andReturn(null);
        $this->mockedRepository->shouldReceive('update')->andReturn(true);
        $this->mockedRepository->shouldReceive('delete')->andReturn(true);
        $this->mockedRepository->shouldReceive('get')->andReturn(new BookResource($this->book));
        $this->mockedRepository->shouldReceive('all')->andReturn([$this->book, $this->book, $this->book]);
    }

    public function testGetAllBooks()
    {
        $response = $this->json('GET', 'api/books');
        $response
            ->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function testGetOneBook()
    {
        $response = $this->json('GET', 'api/books/id');
        $response
            ->assertStatus(200)
            ->assertJson(['data' => ['_id' => 1, 'author' => 'someAuthor', 'title' => 'someTitle', 'price' => '13.5']]);
    }

    public function testGetOneBookNotFound()
    {
        $mocked = AppHelper::mock(IBookRepository::class);
        $mocked->shouldReceive('get')->andReturn(null);
        $response = $this->json('GET', 'api/books/id');
        $response
            ->assertStatus(404);

    }

    public function testDelete()
    {
        $response = $this->json('DELETE', 'api/books/id');
        $response
            ->assertStatus(204);

    }

    public function testDeleteNotFound()
    {
        $mocked = AppHelper::mock(IBookRepository::class);
        $mocked->shouldReceive('delete')->andReturn(false);
        $response = $this->json('DELETE', 'api/books/id');
        $response
            ->assertStatus(404);

    }

    public function testValidCreate()
    {
        $response = $this->json('POST', 'api/books', ['author' => 'Sally', 'title' => 'A', 'price' => '12.33']);
        $response
            ->assertStatus(201);
    }

    public function testInvalidCreate()
    {
        $response = $this->json('POST', 'api/books', ['author' => 'S', 'title' => 'A', 'price' => '12.33']);
        $response
            ->assertStatus(422);
    }

    public function testValidEdit()
    {
        $response = $this->json('PUT', 'api/books/id', ['author' => 'Sally', 'title' => 'A', 'price' => '12.33']);
        $response
            ->assertStatus(204);
    }

    public function testInvalidEditAuthorTooShort()
    {
        $response = $this->json('PUT', 'api/books/id', ['author' => 'S', 'title' => 'A', 'price' => '12.33']);
        $response
            ->assertStatus(422);
    }

    public function testInvalidEditAuthorTooLong()
    {
        $response = $this->json('PUT', 'api/books/id', ['author' => 'zyxjejxvrfeecuytbiwpcnouojuqkczjtimrzqjhvnsjaloreywqbqgp', 'title' => 'A', 'price' => '12.33']);
        $response
            ->assertStatus(422);
    }

    public function testInvalidEditTitleEmpty()
    {
        $response = $this->json('PUT', 'api/books/id', ['author' => 'Sa', 'title' => '', 'price' => '12.33']);
        $response
            ->assertStatus(422);
    }

    public function testInvalidEditTitleTooLong()
    {
        $response = $this->json('PUT', 'api/books/id', ['author' => 'Saa', 'title' => 'zyxjejxvrfeecuytbiwpcnouojuqkczjtimrzqjhvnsjaloreywqbqgp', 'price' => '12.33']);
        $response
            ->assertStatus(422);
    }

    public function testInvalidPriceEmpty()
    {
        $response = $this->json('PUT', 'api/books/id', ['author' => 'Sa', 'title' => '', 'price' => '']);
        $response
            ->assertStatus(422);
    }

    public function testUpdateNotFound()
    {
        $mocked = AppHelper::mock(IBookRepository::class);
        $mocked->shouldReceive('update')->andReturn(false);
        $mocked->shouldReceive('getFields')->andReturn(['author', 'title', 'price']);

        $response = $this->json('PUT', 'api/books/id', ['author' => 'Sally', 'title' => 'A', 'price' => '12.33']);
        $response
            ->assertStatus(404);

    }
}
