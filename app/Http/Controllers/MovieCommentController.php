<?php

namespace App\Http\Controllers;

//use App\Movie;
use App\MovieComment;
use App\MovieSubcomment;
use Auth;
use App\Config;
use Illuminate\Http\Request;

class MovieCommentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request, $id)
    {
        $config = Config::first();
        if($config->comments == 1 && $config->comments_approval == 1){
            $status = 0;
        }else{
            $status = 1;
        }
        if (!is_null($request->email)) {
            $email = $request->email;
        } else {
            $email = Auth::user()->email;
        }





        $input = $request->all();
        $input['movie_id'] = $id;
        $input['name'] = Auth::user()->name;
        $input['email'] = $email;
        $input['user_id'] = Auth::user()->id;
        $input['status'] = $status;
        $data = MovieComment::create($input);

        return back()->with('added', 'Your Movie Comment has been added');

    }

    public function reply(Request $request, $id)
    {

        $user_id = Auth::user()->id;
        $input = $request->all();
        $input['comment_id'] = $id;
        $input['user_id'] = $user_id;
        $data = MovieSubcomment::create($input);
        return back()->with('added', 'Your reply has been added');
    }

    public function deletecomment($id)
    {

        $comment_delete = MovieComment::findOrFail($id);
        if (isset($comment_delete->subcomment)) {
            foreach ($comment_delete->subcomment as $sub) {
                $sub->delete();
            }
        }

        $comment_delete->delete();
        return back()->with('deleted', 'Comment has been deleted');
    }

    public function deletesubcomment($cid)
    {
        $subcomment = MovieSubcomment::findOrFail($cid);
        $subcomment->delete();
        return back()->with('SubComment has been deleted');
    }

}
