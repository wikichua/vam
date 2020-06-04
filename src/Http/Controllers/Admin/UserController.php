<?php

namespace Wikichua\VAM\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $fields = collect($request->get('fields'))->where('filterable', true)->pluck('key')->all();
        $filter = $request->get('filter', '');
        $sortBy = $request->get('sortBy', '');
        $sortDesc = $request->get('sortDesc', '');
        $users = app(config('vam.models.user'))->query()->filter($filter, $fields)->sorting($sortBy, $sortDesc)->paginate($request->get('size', 20));
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'type' => 'required',
            'roles' => 'required',
        ]);

        $request->merge([
            'password' => bcrypt($request->get('password')),
        ]);

        $user = app(config('vam.models.user'))->create($request->all());
        $user->roles()->sync($request->get('roles'));

        activity('Created User: ' . $user->id, $request->all(), $user);

        return response()->json([
            'id' => $user->id,
            'status' => 'success',
            'message' => 'User created.',
            'redirectTo' => '/user/' . $user->id . '/show',
        ]);
    }

    public function show($id)
    {
        $user = app(config('vam.models.user'))->query()->findOrFail($id);
        $user->rolesShow = $user->roles->sortBy('name')->implode('name', ', ');
        $user->rolesSelected = $user->roles()->pluck('roles.id');
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = app(config('vam.models.user'))->query()->findOrFail($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'type' => 'required',
            'roles' => 'required',
        ]);

        $user->update($request->all());
        $user->roles()->sync($request->get('roles'));

        activity('Updated User: ' . $user->id, $request->all(), $user);

        return response()->json([
            'id' => $user->id,
            'status' => 'success',
            'message' => 'User Updated.',
            'redirectTo' => '/user/' . $user->id . '/edit',
        ]);
    }

    public function updatePassword(Request $request, $id)
    {
        $user = app(config('vam.models.user'))->query()->findOrFail($id);
        $request->validate([
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        $request->merge([
            'password' => bcrypt($request->get('password')),
        ]);

        $user->update($request->all());

        activity('Updated User Password: ' . $user->id, $request->all(), $user);

        return response()->json([
            'id' => $user->id,
            'status' => 'success',
            'message' => 'User Password Updated.',
            'redirectTo' => '/user',
        ]);
    }

    public function destroy($id)
    {
        $user = app(config('vam.models.user'))->query()->findOrFail($id);
        $user->delete();

        activity('Deleted User: ' . $user->id, [], $user);

        return response()->json([
            'id' => $user->id,
            'status' => 'success',
            'message' => 'User deleted.',
        ]);
    }
}
