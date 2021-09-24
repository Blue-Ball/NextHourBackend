<?php

namespace App\Http\Controllers;

use App\Movie;
use App\TvSeries;
use App\MovieComment;
use App\MovieSubcomment;

class QuickUpdateController extends Controller
{
    public function change($id)
    {

        $movie = Movie::findorfail($id);

        if ($movie->status == 1) {
            $movie->status = 0;
        } else {
            $movie->status = 1;
        }

        $movie->save();
        return back()->with('updated', 'Movie Status changed !');
    }

    public function changetvstatus($id)
    {

        $tv = TvSeries::findorfail($id);

        if ($tv->status == 1) {
            $tv->status = 0;
        } else {
            $tv->status = 1;
        }

        $tv->save();
        return back()->with('updated', 'TvSeries Status changed !');
    }

    public function commentchange($id){
         $comment = MovieComment::findorfail($id);

        if ($comment->status == 1) {
            $comment->status = 0;
        } else {
            $comment->status = 1;
        }

        $comment->save();
        return back()->with('updated', 'Comment Status changed !');
    }

    public function subcommentchange($id){
         $comment = MovieSubcomment::findorfail($id);

        if ($comment->status == 1) {
            $comment->status = 0;
        } else {
            $comment->status = 1;
        }

        $comment->save();
        return back()->with('updated', 'SubComment Status changed !');
    }

}
