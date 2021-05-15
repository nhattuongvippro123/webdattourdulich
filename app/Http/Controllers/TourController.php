<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Tour;
use App\TourInfo;
use DB;

class TourController extends Controller
{       
    public function tourInfo(Tour $tour){

        return view('tour-info', compact('tour'));
    }
    
    public function find(){
        return view('find-tour');
    }

    public function findTour(Request $request)
    {   
        $search_string = $request->search;
        $result = DB::table('tour')
        ->join('tour_info', 'tour.id', '=', 'tour_info.tour_id')
        ->where('tour_name','like', "%{$search_string}%")
        ->get();
        // ->paginate(3);
        // dd($result);
        return view('find-tour',compact('result'));

    }

    public function tourBooking(Tour $tour)
    {
        dd($tour);
    }
        
}

    


