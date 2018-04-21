<?php

namespace App\Http\Controllers\Web;
use Validator;

use App\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Program;
use App\User;
use Illuminate\Support\Facades\Session;
use YaroslavMolchan\Rbac\Models\Role;

class UserController extends Controller
{

		/**
		 * Display a listing of the resource.
		 *
		 * @param Request $request
		 *
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
		 */
		public function index(Request $request)
		{
				return view('user.index');
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create()
		{
			$roles = Role::all()->sortBy('name');
			return view('user.create',['roles' => $roles]);
		}

		/**
		 * Store a newly created resource in storage.
		 * @todo validation for language_id
		 * 
		 * @param  \Illuminate\Http\Request  $request
		 * @return \Illuminate\Http\Response
		 */
		public function store(Request $request)
		{
				$input = $request->all();

				$validate = $request->validate([
					'name' => 'required|string|max:255',
					'role_id' => 'required',
					'email' => 'required|string|email|max:255|unique:users',
					'password' => 'required|string|min:6|confirmed',
				]);

				$input['password'] = bcrypt($input['password']);
				$input['api_token'] = str_random(60); //set random api token


				$user = \App\User::create($input);
				$user->roles()->sync([$request->get('role_id')]);

				Session::flash('flash_message', 'User successfully added!');
				Session::flash('config_history_tab', 'user-tab');
				return redirect()->route('configurations');

		}

		/**
		 * Display the specified resource.
		 *
		 * @param $id
		 *
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
		 */
		public function show($id)
		{
				$user = User::findOrFail($id);
				$roles = Role::all()->sortBy('name');
				return view('user.show', [
					'user' => $user,
					'roles' => $roles,
				]);

		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param $id
		 *
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
		 */
		public function edit($id)
		{
				$user = User::findOrFail($id);
				$roles = Role::all()->sortBy('name');
				return view('user.edit', [
					'user' => $user,
					'roles' => $roles,
				]);
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param Request $request
		 * @param         $id
		 *
		 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function update(Request $request, $id)
		{
				$input = $request->all();
				
				$validate = $request->validate([
					'name' => 'required|string|max:255',
					'role_id' => 'required',
					'password' => 'sometimes|nullable|confirmed',
				]);

				$user = User::findOrFail($id);
				$input['password'] = bcrypt($input['password']);

				$user->update($input);
				$user->roles()->sync([$request->get('role_id')]);


				Session::flash('flash_message', 'User successfully updated!');

				return redirect('configurations');

		}

}
