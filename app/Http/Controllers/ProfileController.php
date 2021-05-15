<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;

class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function profileUser(User $user){
        // $favoriteTour = DB::table('favorite_tour')
        // ->join('tour', 'favorite_tour.tour_id', '=', 'tour.id')
        // ->join('tour_info', 'favorite_tour.tour_id', '=', 'tour.id')
        // ->where('tour_name','like', "%{$search_string}%")
        // ->get();

        // dd($favoriteTour);

        return view('user.user-profile', compact('user'));
    }

    public function edit(User $user){
        // $this->authorize('update', $user);

        return view('user.user-edit', compact('user'));
    }
    
    public function update(User $user){

        $data = request()->validate([
            'name' => 'required',
            'avatar' => 'required|image',

        ]);
        $imagePath = request('avatar')->store('img/user', 'public');

        $user->update([
            'name' => $data['name'],
            'avatar' => $imagePath,
        ]);
        
        // dd($imagePath);

        return redirect(Route('profile_user', $user->id));
    }
}
