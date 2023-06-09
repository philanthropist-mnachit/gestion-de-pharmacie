<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreuserRequest;
use App\Http\Requests\UpdateuserRequest;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreuserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreuserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $users = User::all(); // fetch all users from the database
        view()->share(compact('users')); // push $users to all views
        return view('app');
    }

    public function Update_P($id, Request $request)
    {
        // dd($request->image_profile);
        $user = User::find($id);

        if ($request->file('image_profile')) {
            $Photo = Cloudinary::upload($request->file('image_profile')->getRealPath(), [
                "folder" => "product/",
                "public_id" => "poster_" . time(),
                "overwrite" => true
            ]);
        }
        $url = Auth::user()->image;
        $basename = basename($url);
        $pathinfo = pathinfo($basename);
        $public_id = $pathinfo['filename'];
        // dd($public_id);
        Cloudinary::destroy($public_id);
        // dd($Photo);
        if (!empty($Photo)) {
            $user->First = $request->first;
            $user->image = $Photo->getSecurePath();
            $user->Last = $request->last;
            $user->Num_tele = $request->num;
            $user->Address = $request->address;
            $user->Postcode = $request->post;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->Country = $request->country;
            $user->Region = $request->state;
        }
        else{
            $user->First = $request->first;
            // $user->image = $Photo->getSecurePath();
            $user->Last = $request->last;
            $user->Num_tele = $request->num;
            $user->Address = $request->address;
            $user->Postcode = $request->post;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->Country = $request->country;
            $user->Region = $request->state;
        }

        $user->update();

        // dd($user);
        return redirect('/Profile');
    }

    public function Update_P1($id, Request $request)
    {
        // dd($request->all());
        $user = User::find($id);

        if ($request->file('image_profile')) {
            $Photo = Cloudinary::upload($request->file('image_profile')->getRealPath(), [
                "folder" => "product/",
                "public_id" => "poster_" . time(),
                "overwrite" => true
            ]);
        }
        $url = Auth::user()->image;
        $basename = basename($url);
        $pathinfo = pathinfo($basename);
        $public_id = $pathinfo['filename'];
        Cloudinary::destroy($public_id);
        if (!empty($Photo)) {
            $user->First = $request->first;
            $user->image = $Photo->getSecurePath();
            $user->Last = $request->last;
            $user->Num_tele = $request->num;
            $user->Address = $request->address;
            $user->Postcode = $request->post;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->Country = $request->country;
            $user->Region = $request->state;
            dd($request->all());
        }
        else{
            $user->First = $request->first;
            // $user->image = $Photo->getSecurePath();
            $user->Last = $request->last;
            $user->Num_tele = $request->num;
            $user->Address = $request->address;
            $user->Postcode = $request->post;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->Country = $request->country;
            $user->Region = $request->state;
        }

        $user->update();

        // dd($user);
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateuserRequest  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateuserRequest $request, user $user)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        //
    }
}
