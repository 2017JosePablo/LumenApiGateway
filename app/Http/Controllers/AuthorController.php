<?php

namespace App\Http\Controllers;


use App\Services\AuthorService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
	/**
	 * The service to consume the author service
	 * @var AuthorService
	 */
	public $authorService;

	/**
	 * Create a new controller instance.
	 *
	 * AuthorController constructor.
	 * @param AuthorService $authorService
	 */
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

	/**
	 * Retrieve and show all the Authors
	 * @return \Illuminate\Http\Response
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
    public function index(){
		return $this->successResponse($this->authorService->obtainAuthors());
	}

	/**
	 * Create an instance of Author
	 * @param Request $request
	 * @return Response
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function store(Request $request){
		return $this->successResponse($this->authorService->createAuthor($request->all()), Response::HTTP_CREATED);
	}

	/**
	 * Obtains and show an instance of Author
	 * @param $author
	 * @return Response
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function show($author){
		return $this->successResponse($this->authorService->obtainAuthor($author));
	}

	/**
	 * Update an instance of Authors
	 * @param Request $request
	 * @param $author
	 * @return Response
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function update(Request $request, $author){
		return $this->successResponse($this->authorService->editAuthor($request->all(), $author));
	}

	/**
	 * Remove an instance of Authors
	 * @param $author
	 * @return Response
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function destroy($author){
		return $this->successResponse($this->authorService->deleteAuthor($author));
	}
}
