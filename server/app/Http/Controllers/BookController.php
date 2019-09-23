<?php

namespace App\Http\Controllers;

use App\Repositories\IBookRepository;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()
            ->json($this->bookRepository
                ->all($request->query('query'),$request->query('order')),200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->bookRepository->create($request->only($this->bookRepository->getFields()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = $this->bookRepository->get($id);

        if($book != null){
            return response()->json($book);
        } else {
            return response()->json("Not found", 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->bookRepository->update($id,$request->only($this->bookRepository->getFields()));
        return response()->json("1 book updated", 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->bookRepository->delete($id);
        return response()->json("1 book deleted", 200);
    }
}
