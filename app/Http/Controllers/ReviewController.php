<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function add_review()
    {
        return view('add_review');
    }

    public function save_review(Request $request)
    {
        $id=request('id');
        $user_id=request('user_id');
        $username=request('username');
        $phone=request('phone');
        $usertype=request('usertype');
        $rating=request('rating');
        $review=request('review');
        $date_display=request('date_display');

        Review::create([

            'id'=>$id,
            'user_id'=>$user_id,
            'username'=>$username,
            'phone'=>$phone,
            'usertype'=>$usertype,
            'rating'=>$rating,
            'review'=>$review,
            'date_display'=>$date_display
        ]);

        return redirect()->route('home')->with('success', 'Thanks For Review!');
    }

    public function reviews(Request $request)
    {
        $review=Review::all();

        return view('reviews',compact('review'));
    }
    
    public function delete_review($id)
    {
        $review=Review::where('id',$id)->first();

        if($review)
        {
            $review->delete();
            return redirect()->route('review')->with('success', 'Review deleted successfully!');
        }
        else
        {
            echo"Record Not Found!";
        }
    }
}


