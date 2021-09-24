<?php

namespace App\Http\Controllers;

use App\ColorScheme;
use Illuminate\Http\Request;

class ColorSchemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $color_scheme = ColorScheme::first();
       return view('admin.color_scheme.index',compact('color_scheme'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        $color= ColorScheme::first();
         $input = $request->all();
        if($request->reset == "Reset to Default" ){
            $input['color_scheme'] = $request->color_scheme;
            $input['custom_navigation_color'] = NULL;
            $input['custom_text_color'] = NULL;
            $input['custom_text_on_color'] = NULL;
            $input['custom_back_to_top_bgcolor'] = NULL;
            $input['custom_back_to_top_bgcolor_on_hover'] = NULL;
            $input['custom_back_to_top_color'] = NULL;
            $input['custom_back_to_top_color_on_hover'] = NULL;
            $input['custom_footer_background_color'] = NULL;

            $color->update($input);
            return back()->with('updated','Color scheme set to default!');
        }elseif($request->save == 'Save Settings'){
          
            $color->update($input);
            return back()->with('added','Color scheme Updated!');
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ColorScheme  $colorScheme
     * @return \Illuminate\Http\Response
     */
    public function show(ColorScheme $colorScheme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ColorScheme  $colorScheme
     * @return \Illuminate\Http\Response
     */
    public function edit(ColorScheme $colorScheme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ColorScheme  $colorScheme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ColorScheme  $colorScheme
     * @return \Illuminate\Http\Response
     */
    public function destroy(ColorScheme $colorScheme)
    {
        //
    }
}
