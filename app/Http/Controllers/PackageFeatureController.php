<?php

namespace App\Http\Controllers;

use App\PackageFeature;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackageFeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $p_feature = \DB::table('package_features')->select('id', 'name', 'created_at', 'updated_at')->get();

        if ($request->ajax()) {
            return \Datatables::of($p_feature)
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
                    return date('F d, Y',strtotime($row->created_at));

                })
                ->addColumn('updated_at', function ($row) {
                    return date('F d, Y',strtotime($row->updated_at));

                })

                ->addColumn('action', function ($row) {
                    $btn = ' <div class="admin-table-action-block">

                    <a href="' . route('package_feature.edit', $row->id) . '" data-toggle="tooltip" data-original-title="Edit" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a><button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#deleteModal' . $row->id . '"><i class="material-icons">delete</i> </button></div>';

                    $btn .= '<div id="deleteModal' . $row->id . '" class="delete-modal modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <div class="delete-icon"></div>
                    </div>
                    <div class="modal-body text-center">
                      <h4 class="modal-heading">Are You Sure ?</h4>
                      <p>Do you really want to delete these records? This process cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                      <form method="POST" action="' . route("package_feature.destroy", $row->id) . '">
                        ' . method_field("DELETE") . '
                        ' . csrf_field() . '
                          <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
                          <button type="submit" class="btn btn-danger">Yes</button>
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

        return view('admin.package_feature.index', compact('p_feature'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.package_feature.create');
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
            'name' => 'required',
        ]);
        $input = $request->all();
        PackageFeature::create($input);
        return back()->with('added', 'Package feature has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PackageFeature  $packageFeature
     * @return \Illuminate\Http\Response
     */
    public function show(PackageFeature $packageFeature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PackageFeature  $packageFeature
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $p_feature = PackageFeature::findOrFail($id);
        return view('admin.package_feature.edit', compact('p_feature'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PackageFeature  $packageFeature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $p_feature = PackageFeature::findOrFail($id);
        $input = $request->all();
        $p_feature->update($input);
        return redirect('/admin/package_feature')->with('updated', 'Package feature has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PackageFeature  $packageFeature
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $p_feature = PackageFeature::findOrFail($id);
        $p_feature->delete();
        return back()->with('deleted', 'Package feature has been deleted');
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
            PackageFeature::destroy($checked);
        }

        return back()->with('deleted', 'Package Feature has been deleted');
    }
}
