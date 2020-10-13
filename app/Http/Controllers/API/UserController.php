<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize('isAdmin');
        if(Gate::allows('isAdmin') || Gate::allows('isAuthor')) {
            return User::latest()->paginate(2);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:8'
        ]);
        if(!$request['photo']){
            $photo = 'profile.png';
        }else{
            $photo = $request['photo'];
        }
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'type' => $request->user_type,
            'bio' => $request->bio,
            'photo' => $photo,
            'password' => Hash::make($request->password)
        ]);
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
     * get Profile method
     *
     * @return void
     */
    public function profile()
    {
        return auth('api')->user();
    }

    /**
     * Update profile with upload image
     *
     * @param Request $request
     * @return void
     */
    public function updateProfile(Request $request)
    {
        $user = auth('api')->user();
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|min:8'
        ]);
        $currentPhoto = $user->photo;
        if($request->photo != $currentPhoto) {
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            $path = public_path('img/profile/') . $name;
            Image::make($request->photo)->save($path);
            $request->merge(['photo' => $name]);

            $userPhoto = public_path('img/profile/').$currentPhoto;
            if(file_exists($userPhoto)) {
                @unlink($userPhoto);
            }
        }

        if(!empty($request->password)) {
            $request->merge(['password' => Hash::make($request->password)]);
        }

        $user->update($request->all());
        return ['message' => 'Success'];
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
        $user = User::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,' . $user->id,
            'password' => 'sometimes|min:8'
        ]);
        $user->update($request->all());
        return ['message' => 'Updated User ' . $user->name];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');
        $user = User::findOrFail($id);
        $user->delete();
        return ['message' => 'User Deleted ' . $user->name];
    }
}
