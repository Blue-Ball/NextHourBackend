<?php

namespace App\Http\Controllers;

use App\Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->search != NULL){
            $actors = \DB::table('actors')->where('name','like', '%' . $request->search . '%')->select('id', 'name', 'image', 'biography', 'place_of_birth')->paginate(12);
        }else{
            $actors = \DB::table('actors')->select('id', 'name', 'image', 'biography', 'place_of_birth')->paginate(12);
        }

        return view('admin.actor.index', compact('actors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.actor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

       
        $actor = new Actor();

        if ($file = $request->file('image')) {
            $validator = Validator::make(
                [
                    'image' => $request->image,
                    'extension' => strtolower($request->image->getClientOriginalExtension()),
                ],
                [
                    'image' => 'required',
                    'extension' => 'required|in:jpg,jpeg,png',
                ]
            );
            if ($validator->fails()) {
                return back()->with('deleted','Invalid file format Please use jpg,jpeg and png image format !')->withInput();
            }else{
                $image = "actor_" . time() . $file->getClientOriginalName();
                $file->move('images/actors', $image);
            }
            
        }else{
          $image = NULL;
        }

        
        $this->save($actor,$request,$image);
        return back()->with('added', 'Actor has been created');
    }

    public function ajaxstore(Request $request)
    {
       
        if ($file = $request->file('image')) {
            $name = "actor_" . time() . $file->getClientOriginalName();
            $file->move('images/actors', $name);
           
        }else{
          $name = NULL;
        }

        $result = $this->save($actor,$request,$name);

        if ($result) {
            return response()->json(['msg' => 'Actor created succesfully !']);
        } else {
            return response()->json(['msg' => 'Please try again !']);
        }
    }

    public function listofactor(Request $request)
    {

        if (!isset($request->searchTerm)) {
            $fetchData = Actor::select('id', 'name')->get();
        } else {
            $search = $request->searchTerm;
            $fetchData = Actor::where('name', 'LIKE', '%' . $search . '%')->select('id', 'name')->get();
        }

        $data = array();

        foreach ($fetchData as $row) {
            $data[] = array("id" => $row['id'], "text" => $row['name']);
        }

        return response()->json($data);
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
        $actor = Actor::find($id);
        return view('admin.actor.edit', compact('actor'));
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
        $actor = Actor::find($id);

        $request->validate([
            'name' => 'required'
        ]);

       
        if ($file = $request->file('image')) {
            $validator = Validator::make(
                [
                    'image' => $request->image,
                    'extension' => strtolower($request->image->getClientOriginalExtension()),
                ],
                [
                    'image' => 'required',
                    'extension' => 'required|in:jpg,jpeg,png',
                ]
            );
            if ($validator->fails()) {
                return back()->with('deleted','Invalid file format Please use jpg,jpeg and png image format !')->withInput();
            }else{
                $image = "actor_" . time() . $file->getClientOriginalName();
                if ($actor->image != null) {
                    $content = @file_get_contents(public_path() . '/images/actors/' . $actor->image);
                    if ($content) {
                        unlink(public_path() . "/images/actors/" . $actor->image);
                    }
                }
                $file->move('images/actors', $image);
            }
           
        }else{
          $image = NULL;
        }

        $this->save($actor,$request,$image);
        return redirect('admin/actors')->with('updated', 'Actor has been updated');
    }



    private function save(Actor $actor, Request $request,$image){
      $actor->name = $request->name;
      $actor->biography = $request->biography;
      $actor->image = $image;
      $actor->place_of_birth = $request->place_of_birth ?  $request->place_of_birth : NULL;
      $actor->DOB = $request->DOB ? $request->DOB : NULL;
      $actor->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $actor = Actor::findOrFail($id);

        if ($actor->image != null) {
            $content = @file_get_contents(public_path() . '/images/actors/' . $actor->image);
            if ($content) {
                unlink(public_path() . "/images/actors/" . $actor->image);
            }
        }

        $actor->delete();
        return redirect('admin/actors')->with('deleted', 'Actor has been deleted');
    }

    public function bulk_delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'checked' => 'required',
        ]);

        if ($validator->fails()) {

            return back()->with('deleted', 'Please select one of them to delete');
        }

        foreach ($request->checked as $checked) {

            $actor = Actor::findOrFail($checked);

            if ($actor->image != null) {
                $content = @file_get_contents(public_path() . '/images/actors/' . $actor->image);
                if ($content) {
                    unlink(public_path() . "/images/actors/" . $actor->image);
                }
            }

            Actor::destroy($checked);
        }

        return back()->with('deleted', 'Actors has been deleted');
    }
}
