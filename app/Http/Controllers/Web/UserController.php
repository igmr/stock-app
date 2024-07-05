<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordUserFormRequest;
use App\Http\Requests\UserFormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'menu' => 'user',
        ];
        return view('app.user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'menu' => 'user',
        ];
        return view('app.user.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserFormRequest $req)
    {
        $data = $req->validated();
        $user = new User();
        $user->name     = $data['name'];
        $user->email    = strtolower($data['email']);
        $user->password = Hash::make($data['password']);
        $user->status   = 'Active';
        if ($user->save()) {
            return redirect()->route('app.user.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $data = [
            'menu' => 'user',
            'user' => $user,
        ];
        return view('app.user.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserFormRequest $req, User $user)
    {
        $data = $req->validated();
        $user->name = $data['name'] ?? $user->name;
        $user->email = $data['email'] ?? $user->email;
        if ($user->save()) {
            return redirect()->route('app.user.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function datatable()
    {
        $users = User::all();
        return datatables($users)->toJson();
    }

    public function change_password(User $user)
    {
        $data = [
            'menu' => 'user',
            'user' => $user,
        ];
        return view('app.user.change-password', compact('data'));
    }
    public function change_password_action(ChangePasswordUserFormRequest $req, User $user)
    {
        $password = $req->validated('password');
        $user->password = Hash::make($password);
        if ($user->save()) {
            return redirect()->route('app.user.index');
        }
    }
}
