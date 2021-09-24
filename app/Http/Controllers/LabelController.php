<?php

namespace App\Http\Controllers;

use App\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $labels = \DB::table('labels')->select('id','name','created_at','updated_at')->get();
          if ($request->ajax()) {
            return \Datatables::of($labels)
                
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    $html = '<div class="inline">
                    <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="' . $row->id . '" id="checkbox' . $row->id . '">
                    <label for="checkbox' . $row->id . '" class="material-checkbox"></label>
                  </div>';

                    return $html;
                })
               
                ->addColumn('name', function ($row) {

                    return $row->name;

                })
              ->addColumn('created_at', function ($row) {
                // $datetime = Carbon::parse($genre->created_at);
                 return date('F d, Y',strtotime($row->created_at));
                
                })
                ->addColumn('updated_at', function ($row) {
                    // $datetime = Carbon::parse($genre->updated_at);
                  return date('F d, Y',strtotime($row->updated_at));
                    // return $datetime->diffForHumans();
                   // return $datetime;

                })

                ->addColumn('action', function ($row) {
                    $btn = ' <div class="admin-table-action-block">

                    <a href="' . route('label.edit', $row->id) . '" data-toggle="tooltip" data-original-title="'.__('adminstaticwords.Edit').'" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a><button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#deleteModal' . $row->id . '"><i class="material-icons">delete</i> </button></div>';

                    $btn .= '<div id="deleteModal' . $row->id . '" class="delete-modal modal fade" role="dialog">
                    <div class="modal-dialog modal-sm">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <div class="delete-icon"></div>
                        </div>
                        <div class="modal-body text-center">
                          <h4 class="modal-heading">'.__('adminstaticwords.AreYouSure').'</h4>
                          <p>'.__('adminstaticwords.DeleteWarrning').'</p>
                        </div>
                        <div class="modal-footer">
                          <form method="POST" action="' . route("label.destroy", $row->id) . '">
                            ' . method_field("DELETE") . '
                            ' . csrf_field() . '
                              <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">'.__('adminstaticwords.No').'</button>
                              <button type="submit" class="btn btn-danger">'.__('adminstaticwords.Yes').'</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>';

                return $btn;
            })
            ->rawColumns(['checkbox', 'name', 'created_at', 'action', 'updated_at'])
            ->make(true);
        }
       return view('admin.label.index',compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.label.create');
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
            'name'=>'required|unique:labels,name'
        ]);

        $input = $request->all();
        $query = new Label();
        $query->name = $input['name'];

        try{
            $query->save();
            return back()->with('added','Label created successfully !');
        }
        catch(\Exception $e){
            return back()->with('deleted',$e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lable  $lable
     * @return \Illuminate\Http\Response
     */
    public function show(Lable $lable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lable  $lable
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $label = Label::find($id);
        return view('admin.label.edit',compact('label'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lable  $lable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        if(env('DEMO_LOCK') == 1){
            return back()->with('deleted','This action is disabled in the demo !');
        }
        $query = Label::find($id);
        $request->validate([
            'name' => 'required|unique:labels,name,' . $query->id,
        ]);

        $input = $request->all();

        $query->name = $input['name'];
        try{
            $query->save();
            return redirect('admin/label')->with('updated','Label updated Successfully !');
        }catch(\Exception $e){
            return back()->with('deleted',$e->getMessage())->withInput();
        }
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lable  $lable
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(env('DEMO_LOCK') == 1){
            return back()->with('deleted','This action is disabled in the demo !');
        }
        $query = Label::find($id);
         if(isset($query) && $query != NULL){
            $query->delete();
            return back()->with('deleted','Label has been deleted !');
         }else{
            return back()->with('deleted',$e->getMessage());
         }
    }

    public function bulk_delete(Request $request){
         if(env('DEMO_LOCK') == 1){
            return back()->with('deleted','This action is disabled in the demo !');
        }
        $validator = Validator::make($request->all(), ['checked' => 'required']);

        if ($validator->fails()) {

            return back()
                ->with('deleted', 'Please select one of them to delete');
        }

        foreach ($request->checked as $checked) {

            $label = Label::findOrFail($checked);

           $label->delete();
        }

        return back()->with('deleted', 'Label has been deleted');
    }
}
