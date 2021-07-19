<?php
namespace App\Services;

use App\Traits\ConsumesExternalService;

class BookService{
	use ConsumesExternalService;

	/**
	 * The base uri to be used to consume the books service
	 * @var string
	 */
	public $baseUri;

	/**
	 * The secret to be used to consume the books service
	 * @var string
	 */
	public $secret;

	public function __construct(){
		$this->baseUri = config('services.books.base_uri');
		$this->secret = config('services.books.secret');
	}

	/**
	 * Get the full list of books from the books service
	 * @return string
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function obtainBooks()
	{
		return $this->performRequest('GET','/books');
	}

	/**
	 * Create an instance of author using the books service
	 * @param $data
	 * @return string
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function createBook($data){
		return $this->performRequest('POST','/books', $data);
	}

	/**
	 * Get a single author from the books service
	 * @param $book
	 * @return string
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function obtainBook($book){
		return $this->performRequest('GET',"/books/{$book}");
	}

	/**
	 * Edit a single author from the books service
	 * @param $data
	 * @param $book
	 * @return string
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function editBook($data, $book){
		return $this->performRequest('PUT',"/books/{$book}", $data);
	}

	/**
	 * Remove a single author from the books service
	 * @param $book
	 * @return string
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function deleteBook($book){
		return $this->performRequest('DELETE',"/books/{$book}");
	}
}