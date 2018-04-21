<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserCollection;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $limit = isset($params['limit']) ? $params['limit'] : 10;
        $sortField = isset($params['sort']) ? $params['sort'] : 'id';
        $order = isset($params['order']) ? $params['order'] : 'asc';

        //$users = (isset($params['is_blocked']) && $params['is_blocked'] == 1) ? User::with('program')->onlyTrashed() : User::with('program');
        $users = User::with('roles');
        if (isset($params['search'])) {

            //@since it has `OR` condition operator, use compound condition for onlyTrashed() to work
            $users->where(function($query) use (&$params) {
                $query->where('name', 'LIKE', '%' . $params['search'] . '%')
                  ->orWhere('email', 'LIKE', '%' . $params['search'] . '%');
            });
        }

        return $users->orderBy($sortField, $order)->paginate($limit);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return $user;
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
        $user = User::findOrFail($id);
        $user->update($request->all());
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::withTrashed()->findOrFail($id);

        if ($request->get('restore')) {
            $user->restore();
        } else {
            $user->delete();
        }
        return 204;
    }
}
