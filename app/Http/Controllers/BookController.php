<?php

namespace App\Http\Controllers;


use App\Services\AuthorService;
use App\Services\BookService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
	/**
	 * The service to consume the book service
	 * @var BookService
	 */
	public $bookService;

	/**
	 * The service to consume the author service
	 * @var AuthorService
	 */
	public $authorService;



	/**
	 * Create a new controller instance.
	 *
	 * BookController constructor.
	 * @param BookService $bookService
	 * @param AuthorService $authorService
	 */
	public function __construct(BookService $bookService, AuthorService $authorService)
	{
		$this->bookService = $bookService;
		$this->authorService = $authorService;
	}

	/**
	 * Retrieve and show all the Books
	 * @return \Illuminate\Http\Response
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function index(){
		return $this->successResponse($this->bookService->obtainBooks());
	}

	/**
	 * Create an instance of Book
	 * @param Request $request
	 * @return \Illuminate\Http\Response
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function store(Request $request){
		$this->authorService->obtainAuthor($request->author_id);
		return $this->successResponse($this->bookService->createBook($request->all()), Response::HTTP_CREATED);
	}

	/**
	 * Obtains and show an instance of Book
	 * @param $book
	 * @return \Illuminate\Http\Response
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function show($book){
		return $this->successResponse($this->bookService->obtainBook($book));
	}

	/**
	 * Update an instance of Books
	 * @param Request $request
	 * @param $book
	 * @return \Illuminate\Http\Response
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function update(Request $request, $book){
		return $this->successResponse($this->bookService->editBook($request->all(), $book));
	}

	/**
	 * Remove an instance of Books
	 * @param $book
	 * @return \Illuminate\Http\Response
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function destroy($book){
		return $this->successResponse($this->bookService->deleteBook($book));
	}
}
