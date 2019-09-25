<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Repositories\IBookRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\Book as BookResource;

class BookController extends Controller
{

    private $bookRepository;

    /**
     * BookController constructor.
     * @param $bookRepository
     */
    public function __construct(IBookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return response()
            ->json($this->bookRepository
                ->all($request->query('query'),$request->query('order')),JsonResponse::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BookRequest $request
     * @return void
     */
    public function store(BookRequest $request)
    {
        $this->bookRepository->create($request->only($this->bookRepository->getFields()));
        return response()->json('Book created', JsonResponse::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return BookResource
     */
    public function show($id)
    {
        $book = $this->bookRepository->get($id);

        if($book != null){
            return new BookResource($book);
        } else {
            return response()->json("Not found", JsonResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BookRequest $request
     * @param int $id
     * @return Response
     */
    public function update(BookRequest $request, $id)
    {
        $this->bookRepository->update($id,$request->only($this->bookRepository->getFields()));
        return response()->json("1 book updated", JsonResponse::HTTP_NO_CONTENT);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->bookRepository->delete($id);
        return response()->json("1 book deleted", JsonResponse::HTTP_NO_CONTENT);
    }
}
