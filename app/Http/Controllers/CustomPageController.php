<?php

namespace App\Http\Controllers;

use App\CustomPage;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customs = \DB::table('custom_pages')->select('id', 'title', 'is_active', 'detail', 'created_at', 'updated_at')->get();

        if ($request->ajax()) {
            return \Datatables::of($customs)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($custom) {
                    $html = '<div class="inline">
                    <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="' . $custom->id . '" id="checkbox' . $custom->id . '">
                    <label for="checkbox' . $custom->id . '" class="material-checkbox"></label>
                  </div>';

                    return $html;
                })
                ->addColumn('detail', function ($custom) {
                    $detail = str_replace("<p>", " ", $custom->detail);;
                    $detail = str_replace("</p>", " ", $detail);
                    $detail = strip_tags(html_entity_decode(str_limit($detail, 50)));
                    return $detail;
                })

                ->addColumn('created_at', function ($custom) {
                    return date('F d, Y',strtotime($custom->created_at));

                })

                ->addColumn('status', function ($custom) {

                    if ($custom->is_active == 1) {
                        return __('adminstaticwords.Active');
                    } else {
                        return __('adminstaticwords.Deactive');
                    }
                })

                ->addColumn('action', function ($custom) {
                    $btn = ' <div class="admin-table-action-block">

                    <a href="' . route('custom_page.edit', $custom->id) . '" data-toggle="tooltip" data-original-title="'.__('adminstaticwords.Edit').'" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a><button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#deleteModal' . $custom->id . '"><i class="material-icons">delete</i> </button></div>';

                    $btn .= '<div id="deleteModal' . $custom->id . '" class="delete-modal modal fade" role="dialog">
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
                      <form method="POST" action="' . route("custom_page.destroy", $custom->id) . '">
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
                ->rawColumns(['checkbox', 'status', 'created_at', 'action', 'image'])
                ->make(true);
        }

        return view('admin.custom_page.index', compact('customs'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.custom_page.create');
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
            'title' => 'required',
            'detail' => 'required',

        ]);

        $input = $request->all();

        if (isset($input['is_active']) && $input['is_active'] == '1') {
            $input['is_active'] = 1;
        } else {
            $input['is_active'] = 0;
        }

        if (isset($input['in_show_menu']) && $input['in_show_menu'] == '1') {
            $input['in_show_menu'] = 1;
        } else {
            $input['in_show_menu'] = 0;
        }

        $slug = str_slug($input['title'], '-');
        $input['slug'] = $slug;

        $data = CustomPage::create($input);

        return back()->with('added', 'Custom Page has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
        $custom = CustomPage::where('slug', $slug)->first();
        if (isset($custom) && $custom->is_active == 1) {
            return view('/page', compact('custom'));
        } else {
            return abort(404);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $custom = CustomPage::findOrFail($id);
        return view('admin.custom_page.edit', compact('custom'));
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

        $request->validate([
            'title' => 'required|min:3|unique:custom_pages,title,' . $id,
            'detail' => 'required|min:3',
        ]);

        $custom = CustomPage::findOrFail($id);

        $input = $request->all();

        if (isset($request->in_show_menu)) {
            $input['in_show_menu'] = 1;
        } else {

            $input['in_show_menu'] = 0;
        }

        if (isset($request->is_active)) {
            $input['is_active'] = 1;
        } else {

            $input['is_active'] = 0;
        }

        $slug = str_slug($input['title'], '-');

        $input['slug'] = $slug;

        $custom->update($input);

        return redirect('admin/custom_page')->with('updated', 'Custom Page has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $custom = CustomPage::findOrFail($id);

        $custom->delete();
        return redirect('admin/custom_page')->with('deleted', 'Custom Page has been deleted');
    }

    public function bulk_delete(Request $request){
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

            $custom = CustomPage::findOrFail($checked);
            $custom->delete();
        }

        return back()->with('deleted', 'Custom Page has been deleted');
    }

}
