<?php

namespace App\Http\Controllers;

use App\Models\AreaService;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return view('user.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $areas = AreaService::all();

        return view('user.create',['areas'=>$areas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([

            'UserName'=>'required',
            'UserMail'=>'required|email',
            'UserType'=>'required',
            'AreaService'=>'required',

        ]);

        $user = new User();

        $user->name = $request->input('UserName');
        $user->email = $request->input('UserMail');
        $user->type = $request->input('UserType');
        $user->area_service_id = $request->input('AreaService');
        $user->password = '$2y$10$mA5mr8GmVj.32LJVIOF90.dLSRYjzHTxkH2hv4eZj0VjnVw1/IMWm';

        $user->save();

        return redirect()->route('user.index');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $user = User::find($id);
        $areas = AreaService::all();

        return view('user.edit',['user'=>$user,'areas'=>$areas]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $request->validate([

            'UserName'=>'required',
            'UserMail'=>'required|email',
            'UserType'=>'required',
            'AreaService'=>'required',

        ]);

        $user = User::find($id);

        $user->name = $request->input('UserName');
        $user->email = $request->input('UserMail');
        $user->type = $request->input('UserType');
        $user->area_service_id = $request->input('AreaService');

        $user->update();

        return redirect()->route('user.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $user = User::find($id);

        $user->delete();

        return back();

    }
}
