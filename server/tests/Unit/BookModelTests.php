<?php

namespace Tests\Unit;

use App\Book;
use Jenssegers\Mongodb\Connection;
use Jenssegers\Mongodb\Query\Builder;
use Jenssegers\Mongodb\Query\Processor;
use Tests\TestCase;

class BookModelTests extends TestCase
{
    private $book;
    private $dummyBuilder;

    protected function setUp(): void
    {
        parent::setUp();
        $this->book = new Book();
        $this->book->setRawAttributes(['price' => '12', 'author' => 'someAuthor', 'title' => 'someTitle']);
        $this->dummyBuilder = new Builder(new Connection(['host' => 'dummyHost', 'database' => 'dummyDatabase']),new Processor());
    }

    public function testPriceType()
    {
        $this->assertIsFloat($this->book->price);
    }

    public function testScopeSearchPriceDesc()
    {
        $query = $this->book->scopeSearch($this->dummyBuilder,'','priceDesc');
        $this->assertEquals(['price' => -1],$query->orders);
    }

    public function testScopeSearchPriceAsc()
    {
        $query = $this->book->scopeSearch($this->dummyBuilder,'','price');
        $this->assertEquals(['price' => 1],$query->orders);
    }

    public function testScopeSearchOrderByTitle()
    {
        $query = $this->book->scopeSearch($this->dummyBuilder,'','title');
        $this->assertEquals(['title' => 1],$query->orders);
    }

    public function testScopeSearchOrderByAuthor()
    {
        $query = $this->book->scopeSearch($this->dummyBuilder,'','author');
        $this->assertEquals(['author' => 1],$query->orders);
    }
}
