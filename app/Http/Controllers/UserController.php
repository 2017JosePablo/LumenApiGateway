<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(){
		//
	}

	/**
	 * Return Users list
	 * @return Response
	 */
	public function index(){
		return $this->validResponse(User::all());
	}

	/**
	 * Create an instance of User
	 * @param Request $request
	 * @return Response
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function store(Request $request){
		$this->validate($request, [
			'name'=>'required|max:255',
			'email'=>'required|email|unique:users,email',
			'password'=>'required|min:8|confirmed',
		]);
		$fields = $request->all();
		$fields['password']=Hash::make($request->password);
		$user=User::create($fields);
		return $this->validResponse($user, Response::HTTP_CREATED);
	}

	/**
	 * Return an specific User
	 * @param $user
	 * @return Response
	 */
	public function show($user){
		return $this->validResponse(User::findOrFail($user));
	}

	/**
	 * Update the information of an existing User
	 * @param Request $request
	 * @param $user
	 * @return \Illuminate\Http\JsonResponse|Response
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function update(Request $request, $user){
		$this->validate($request, [
			'name'=>'max:255',
			'email'=>'email|unique:users,email,'.$user,
			'password'=>'min:8|confirmed',
		]);
		$user=User::findOrFail($user);
		$user->fill($request->all());
		if($request->has('password')){
			$user->password = Hash::make($request->password);
		}
		if($user->isClean()){
			return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
		}
		$user->save();
		return $this->validResponse($user);
	}

	/**
	 * Remove on existing User
	 * @param $user
	 * @return Response
	 */
	public function destroy($user){
		$user = User::findOrFail($user);
		$user->delete();
		return $this->validResponse($user);
	}

	/**
	 * Identifies the current user
	 * @param Request $request
	 * @return Response
	 */
	public function me(Request $request){
		return $this->validResponse($request->user());
	}
}
