<?php

namespace App\Http\Controllers;

use App\Blog;
use App\BlogMenu;
use App\Menu;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Image;

class BlogController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->search != NULL){
             $blogs = Blog::where('title','like','%' . $request->search . '%')->select('id', 'title', 'image', 'is_active', 'detail', 'created_at', 'updated_at')->paginate(12);
        }else{
            $blogs = Blog::select('id', 'title', 'image', 'is_active', 'detail', 'created_at', 'updated_at')->paginate(12);
        }
       

       
        return view('admin.blog.index', compact('blogs'));
    }

    public function create()
    {
        $menus = Menu::all();
        return view('admin.blog.create', compact('menus'));
    }

    public function store(Request $request)
    {
       if(env('DEMO_LOCK') == 1){
            return back()->with('deleted','This action is disabled in the demo !');
        }
        $request->validate([
            'title' => 'required',
            'detail' => 'required',
            'menu' => 'required'
        ], [
            'menu.required' => 'Please select atleast one menu',
        ]);

        $input = $request->all();
        $input['detail']= clean($request->detail);

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

                $optimizeImage = Image::make($file);
                $optimizePath = public_path() . '/images/blog/';
                $name = time() . $file->getClientOriginalName();
                $optimizeImage->save($optimizePath . $name, 72);
                $input['image'] = $name;
            }

        }

        if (isset($input['is_active']) && $input['is_active'] == '1') {
            $input['is_active'] = 1;
        } else {
            $input['is_active'] = 0;
        }

        $slug = str_slug($input['title'], '-');
        $input['slug'] = $slug;
        $auth = Auth::user()->id;
        $input['user_id'] = $auth;

        $menus = null;

        try{
            $blog = Blog::create($input);

            if (isset($request->menu) && count($request->menu) > 0) {
                $menus = $request->menu;
                for ($i = 0; $i < sizeof($menus); $i++) {
                    if ($menus[$i] == 100) {
                        unset($menus);
                        $men = Menu::all();
                        foreach ($men as $key => $value) {
                            # code...
                            $menus[] = $value->id;
                        }
                        DB::table('blog_menu')->insert(
                            array(
                                'menu_id' => $menus[$i],
                                'blog_id' => $blog->id,
                                'created_at' => date('Y-m-d h:i:s'),
                                'updated_at' => date('Y-m-d h:i:s'),
                            )
                        );

                    } else {

                        DB::table('blog_menu')->insert(
                            array(
                                'menu_id' => $menus[$i],
                                'blog_id' => $blog->id,
                                'created_at' => date('Y-m-d h:i:s'),
                                'updated_at' => date('Y-m-d h:i:s'),
                            )
                        );
                    }

                }

            }

            return back()->with('added', 'Post has been added');
        }catch(\Exception $e){

            return back()->with('deleted',$e->getMessage())->withInput();
        }

    }

    public function showBlogList()
    {
        $auth = Auth::user();
        $blogs = Blog::orderBy('created_at', 'desc')->where('is_active', '1')->get();
        return view('blog', compact('blogs', 'auth'));
    }

    public function showBlog($slug)
    {
        $blogdetail = Blog::where('slug', $slug)->first();
        $exceptblog = Blog::where('slug','!=',$slug)->get();
        return view('blogdetail', compact('blogdetail','exceptblog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coupon  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $menus = Menu::all();
        return view('admin.blog.edit', compact('blog', 'menus'));

    }

/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\Product  $id
 * @return \Illuminate\Http\Response
 */

    public function update(Request $request, $id)
    {
        if(env('DEMO_LOCK') == 1){
            return back()->with('deleted','This action is disabled in the demo !');
        }

        $request->validate([
            'title' => 'required|min:3|unique:blogs,title,' . $id,
            'detail' => 'required|min:3'
        ]);

        $blog = Blog::findOrFail($id);
        $input = $request->all();
        $input['detail']= clean($request->detail);
        foreach ($blog->blog_m as $key => $bm) {
            # code...
            $bm->delete();
        }

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

                if ($blog->image != null) {

                    $image_file = @file_get_contents(public_path() . '/images/blog/' . $blog->image);

                    if ($image_file) {
                        unlink(public_path() . '/images/blog/' . $blog->image);
                    }

                }

                $optimizeImage = Image::make($file);
                $optimizePath = public_path() . '/images/blog/';
                $name = time() . $file->getClientOriginalName();
                $optimizeImage->save($optimizePath . $name, 72);

                $input['image'] = $name;
            }

        }

        if (isset($request->is_active)) {
            $input['is_active'] = '1';
        } else {

            $input['is_active'] = '0';
        }

        $slug = str_slug($input['title'], '-');

        $input['slug'] = $slug;

       try{
         $blog->update($input);
        if (isset($request->menu) && count($request->menu) > 0) {
            $menus = $request->menu;
            for ($i = 0; $i < sizeof($menus); $i++) {
                if ($menus[$i] == 100) {
                    unset($menus);
                    $men = Menu::all();
                    foreach ($men as $key => $value) {
                        # code...
                        $menus[] = $value->id;
                    }
                    DB::table('blog_menu')->insert(
                        array(
                            'menu_id' => $menus[$i],
                            'blog_id' => $blog->id,
                            'created_at' => date('Y-m-d h:i:s'),
                            'updated_at' => date('Y-m-d h:i:s'),
                        )
                    );

                } else {

                    DB::table('blog_menu')->insert(
                        array(
                            'menu_id' => $menus[$i],
                            'blog_id' => $blog->id,
                            'created_at' => date('Y-m-d h:i:s'),
                            'updated_at' => date('Y-m-d h:i:s'),
                        )
                    );
                }

            }

        }

        return redirect('admin/blog')->with('updated', 'Post has been updated');
       }catch(\Exception $e){
       
        return back()->with('deleted',$e->getMessage())->withInput();
       }
    }

    public function destroy($id)
    {
       if(env('DEMO_LOCK') == 1){
            return back()->with('deleted','This action is disabled in the demo !');
        }
        $blog = Blog::findOrFail($id);
        $blog_menu = BlogMenu::where('blog_id', $id)->delete();
        $blog->delete();

        return back()->with('deleted', 'Post has been deleted');
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
            $blog = Blog::findOrFail($checked);
            $blog_menu = BlogMenu::where('blog_id', $checked)->delete();

            $blog->delete();
        }
        return back()->with('deleted', 'Post has been deleted');
    }

}
