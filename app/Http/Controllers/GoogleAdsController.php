<?php

namespace App\Http\Controllers;

use App\GoogleAds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GoogleAdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $googleads = GoogleAds::get();
        return view('googleads.index',compact('googleads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('googleads.create');
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
            'google_ad_client' =>'required',
            'google_ad_slot' =>'required',
            'google_ad_width' => 'required',
            'google_ad_height' => 'required',
            'google_ad_starttime' => 'required',
            'google_ad_endtime' => 'required',

        ]);

        try{
            $googleads = new GoogleAds();
            $googleads->google_ad_client = $request->google_ad_client;
            $googleads->google_ad_slot = $request->google_ad_slot;
            $googleads->google_ad_width = $request->google_ad_width;
            $googleads->google_ad_height = $request->google_ad_height;
            $googleads->google_ad_starttime = $request->google_ad_starttime;
            $googleads->google_ad_endtime = $request->google_ad_endtime;

            $googleads->save();

            return redirect()->route('google.ads')->with('added','Google Ad Created Successfully !');
        }catch(\Exception $e){
            return back()->with('deleted',$e->getMessage());
        }
       

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GoogleAds  $googleAds
     * @return \Illuminate\Http\Response
     */
    public function show(GoogleAds $googleAds)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GoogleAds  $googleAds
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $googleads = GoogleAds::find($id);
        return view('googleads.edit',compact('googleads'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GoogleAds  $googleAds
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $googleads = GoogleAds::find($id);
       
       $request->validate([
            'google_ad_client' =>'required',
            'google_ad_slot' =>'required',
            'google_ad_width' => 'required',
            'google_ad_height' => 'required',
            'google_ad_starttime' => 'required',
            'google_ad_endtime' => 'required',
       ]);

       $input = $request->all();
       try{
            $googleads->update($input);
             return redirect()->route('google.ads')->with('updated','GoogleAds Update Successfully!');
       }catch(\Exception $e){
            return back()->with('deleted',$e->getMessage());

       }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GoogleAds  $googleAds
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $googleads = GoogleAds::find($id);
        $googleads->delete();
        return back()->with('deleted','GoogleAds Deleted Successfully!');
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

            $ads = GoogleAds::find($checked);

            $ads::destroy($checked);

           

        }

        return back()->with('deleted', 'Google Ads has been deleted');
    }
}
