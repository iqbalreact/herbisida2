<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $roles = Role::where('name', '<>', 'superadmin')->get();
        return view('admin.pengguna.index', compact('users','roles'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::all();
        return view('admin.pengguna.create', compact('roles'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->password != $request->konfirm_password) {
            return back()->withErrors(['msg' => "konfirmasi password anda !"]);
        } else {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->konfirm_password = Hash::make($request->konfirm_password);
            $user->save();
            $user->assignRole($request->role);
            return back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        User::where('id', $id)->delete();
        return back();
    }

    public function addRole(request $request){
        $role = Role::create(['name' => $request->name]);
        return redirect()->route('pengguna.index');
    }

    //get data penggun
    public function getPengguna($id) {
        $user = User::findOrFail($id);
        $user->getRoleNames()->first();
        return $user;
        return response()->json($user);
    }
    public function getRole($id) {
        $role = Role::findOrFail($id);
        return response()->json($role);
    }
    // end
    // update data
    public function updatePengguna (request $request) {
        // return $request;
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::findOrFail($request->id);
        $user->update($input);
        $user->syncRoles($request->role);
        return back();

    }
    public function updatePeran(request $request) {
        // return $request;
        $roles = Role::findOrFail($request->id);
        $roles->name = $request->name;
        $roles->save();
        return back();
    }
    public function deletePengguna($id)
    {
        User::findOrFail($id)->delete();
        return back();
    }

    public function deletePeran($id)
    {
        Role::findOrFail($id)->delete();
        return back();
    }
}
