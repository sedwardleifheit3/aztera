<?php

namespace App\Http\Controllers\Web;

use App\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Program;
use App\User;
use Illuminate\Support\Facades\Session;
use YaroslavMolchan\Rbac\Models\Role;

class ProfileController extends Controller
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
				return view('profile.index');
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
				return view('profile.show', [
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
				return view('profile.edit', [
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
					'password' => 'sometimes|confirmed',
				]);


				$user = User::findOrFail($id);
				$input['password'] = bcrypt($input['password']);

				$user->update($input);
				$user->roles()->sync([$request->get('role_id')]);


				Session::flash('flash_message', 'Profile successfully updated!');

				return redirect('/profile/' . $id . '/edit');

		}

}
