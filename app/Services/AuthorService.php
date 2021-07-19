<?php
namespace App\Services;

use App\Traits\ConsumesExternalService;

class AuthorService{
	use ConsumesExternalService;

	/**
	 * The base uri to be used to consume the authors service
	 * @var string
	 */
	public $baseUri;

	/**
	 * The secret to be used to consume the authors service
	 * @var string
	 */
	public $secret;

	public function __construct(){
		$this->baseUri = config('services.authors.base_uri');
		$this->secret = config('services.authors.secret');
	}

	/**
	 * Get the full list of authors from the authors service
	 * @return string
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function obtainAuthors()
	{
		return $this->performRequest('GET','/authors');
	}

	/**
	 * Create an instance of author using the authors service
	 * @param $data
	 * @return string
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function createAuthor($data){
		return $this->performRequest('POST','/authors', $data);
	}

	/**
	 * Get a single author from the authors service
	 * @param $author
	 * @return string
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function obtainAuthor($author){
		return $this->performRequest('GET',"/authors/{$author}");
	}

	/**
	 * Edit a single author from the authors service
	 * @param $data
	 * @param $author
	 * @return string
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function editAuthor($data, $author){
		return $this->performRequest('PUT',"/authors/{$author}", $data);
	}

	/**
	 * Remove a single author from the authors service
	 * @param $author
	 * @return string
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function deleteAuthor($author){
		return $this->performRequest('DELETE',"/authors/{$author}");
	}
}