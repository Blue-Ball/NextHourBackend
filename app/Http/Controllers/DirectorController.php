<?php

namespace App\Http\Controllers;

use App\Director;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if($request->search != NULL){
            $directors = \DB::table('directors')->where('name','like','%' . $request->search . '%')->select('id', 'name', 'image', 'biography', 'place_of_birth')->paginate(12);
        }else{
            $directors = \DB::table('directors')->select('id', 'name', 'image', 'biography', 'place_of_birth')->paginate(12);
        }
      

        return view('admin.director.index', compact('directors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.director.create');
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
                $name = "director_" . time() . $file->getClientOriginalName();
                $file->move('images/directors', $name);
                $input['image'] = $name;
            }
        }

        Director::create($input);
        return back()->with('added', 'Director has been created');
    }

    public function ajaxstore(Request $request)
    {
        $input = $request->all();

        if ($file = $request->file('image')) {
            $name = "director_" . time() . $file->getClientOriginalName();
            $file->move('images/directors', $name);
            $input['image'] = $name;
        }

        $result = Director::create($input);

        if ($result) {
            return response()->json(['msg' => 'Director created succesfully !']);
        } else {
            return response()->json(['msg' => 'Please try again !']);
        }
    }

    public function listofd(Request $request)
    {

        if (!isset($request->searchTerm)) {
            $fetchData = Director::select('id', 'name')->get();
        } else {
            $search = $request->searchTerm;
            $fetchData = Director::where('name', 'LIKE', '%' . $search . '%')->select('id', 'name')->get();
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
        $director = Director::findOrFail($id);
        return view('admin.director.edit', compact('director'));
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
        $director = Director::findOrFail($id);

        $request->validate([
            'name' => 'required'
        ]);

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
                $name = "director_" . time() . $file->getClientOriginalName();
                if ($director->image != null) {
                    $content = @file_get_contents(public_path() . '/images/directors/' . $director->image);
                    if ($content) {
                        unlink(public_path() . "/images/directors/" . $director->image);
                    }
                }
                $file->move('images/directors', $name);
                $input['image'] = $name;
            }
        }

        $director->update($input);
        return redirect('admin/directors')->with('updated', 'Director has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $director = Director::findOrFail($id);

        if ($director->image != null) {
            $content = @file_get_contents(public_path() . '/images/directors/' . $director->image);
            if ($content) {
                unlink(public_path() . "/images/directors/" . $director->image);
            }
        }
        $director->delete();
        return redirect('admin/directors')->with('deleted', 'Director has been deleted');
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

            $director = Director::findOrFail($checked);

            if ($director->image != null) {
                $content = @file_get_contents(public_path() . '/images/directors/' . $director->image);
                if ($content) {
                    unlink(public_path() . "/images/directors/" . $director->image);
                }
            }

            Director::destroy($checked);
        }

        return back()->with('deleted', 'Directors has been deleted');
    }
}
