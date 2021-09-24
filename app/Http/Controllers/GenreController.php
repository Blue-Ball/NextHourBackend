<?php

namespace App\Http\Controllers;

use App\Genre;
use Avatar;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->search != NULL){
            $genres = Genre::where('name','like', '%' . $request->search . '%')->select('id', 'name', 'image', 'created_at', 'updated_at')->orderBy('position', 'ASC')->paginate(12);
        }else{
            $genres = Genre::select('id', 'name', 'image', 'created_at', 'updated_at')->orderBy('position', 'ASC')->paginate(12);
        }
        
        return view('admin.genre.index', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.genre.create');
    }

    public function sort(Request $request)
    {

        $posts = Genre::all();

        foreach ($posts as $post) {

            foreach ($request->order as $order) {

                if ($order['id'] == $post->id) {

                    \DB::table('genres')->where('id', $post->id)->update(['position' => $order['position']]);

                }
            }
        }

        return response()->json('Update Successfully.', 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if(env('DEMO_LOCK') == 1){
            return back()->with('deleted','This action is disabled in the demo !');
        }
        $request->validate([

            'name' => 'required|unique:genres,name'
        ]);

        try {

            $input = $request->all();
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
                    $name = "genre_" . time() . $file->getClientOriginalName();
                    $file->move('images/genre', $name);
                    $input['image'] = $name;
                }
            }

            $input['position'] = (Genre::count() + 1);
            //return $input;
            Genre::create($input);
            return back()->with('added', 'Genre has been created');

        } catch (\Exception $e) {

            return back()->with('deleted', $e->getMessage())->withInput();
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
        $genre = Genre::findOrFail($id);
        return view('admin.genre.edit', compact('genre'));
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
      if(env('DEMO_LOCK') == 1){
            return back()->with('deleted','This action is disabled in the demo !');
        }
        $genre = Genre::findOrFail($id);
        $request->validate([
            'name' => 'required|unique:genres,name,' . $genre->id,
            'image'=>'nullable|image|mimes:jpg,jpeg,png'
        ]);

        try {

            $input = $request->all();
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
                    $image = "genre_" . time() . $file->getClientOriginalName();
                    if ($genre->image != null) {
                        $content = @file_get_contents(public_path() . '/images/genre/' . $genre->image);
                        if ($content) {
                            unlink(public_path() . "/images/genre/" . $genre->image);
                        }
                       
                          
                    }
                    $file->move('images/genre', $image);
                      
                     $input['image'] = $image;
                 }
              
            }

            $genre->update($input);
            return redirect('admin/genres')->with('updated', 'Genre has been updated');

        } catch (\Exception $e) {

            return back()->with('deleted', $e->getMessage())->withInput();
        }

    }

    public function updateAll()
    {
        if (Session::has('genre_changed')) {
            return back();
        }
        $all = DB::table('genres')->get();
        foreach ($all as $key => $value) {
            $get_genre = Genre::findOrFail($value->id);
            $get_genre->update([
                'name' => $value->name,
            ]);
        }
        Session::put('genre_changed', 'changed');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      if(env('DEMO_LOCK') == 1){
            return back()->with('deleted','This action is disabled in the demo !');
        }
        $genre = Genre::findOrFail($id);
        if ($genre->image != null) {
            $content = @file_get_contents(public_path() . '/images/genre/' . $genre->image);
            if ($content) {
                unlink(public_path() . "/images/genre/" . $genre->image);
            }
        }
        $genre->delete();
        return redirect('admin/genres')->with('deleted', 'Genre has been deleted');
    }

    public function bulk_delete(Request $request)
    {
      if(env('DEMO_LOCK') == 1){
            return back()->with('deleted','This action is disabled in the demo !');
        }
        $validator = Validator::make($request->all(), [
            'checked' => 'required',
        ]);

        if ($validator->fails()) {

            return back()->with('deleted', 'Please select one of them to delete');
        }

        foreach ($request->checked as $checked) {

            $genre = Genre::findOrFail($checked);
            if ($genre->image != null) {
                $content = @file_get_contents(public_path() . '/images/genre/' . $genre->image);
                if ($content) {
                    unlink(public_path() . "/images/genre/" . $genre->image);
                }
            }

            Genre::destroy($checked);
        }

        return back()->with('deleted', 'Genres has been deleted');
    }
}
