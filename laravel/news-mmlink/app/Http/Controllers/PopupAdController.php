<?php

namespace App\Http\Controllers;

use App\Models\PopupAd;
use Illuminate\Http\Request;
use File;

class PopupAdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $popupAds = PopupAd::all();
        return view('popup_ad.index',compact('popupAds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('popup_ad.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([ 
            'popup_photo' => 'required',
            'description' => 'required',
            'half_or_full'=>'required'
        ]);


        $structure= "uploads/popup_photos/";
        $popup_photo="";
       if ($file = $request->file('popup_photo')) {
    
            $popup_photo = $request->file('popup_photo');
            $ext = '.'.$request->popup_photo->getClientOriginalExtension();
            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->popup_photo->getClientOriginalName());
            $file->move($structure, $fileName);
            $popup_photo = $fileName;

        }

        $arr=[
                'status' => 1,
                'popup_img' => $popup_photo,
                'description' => ($request->description)? $request->description : '',
                'path'=>$structure,
                'half_or_full'=>$request->half_or_full
            ];
            // dd($arr);

        $res=PopupAd::create($arr);

        return redirect()->route('popup_ads.index')->with('message1','Post create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PopupAd  $popupAd
     * @return \Illuminate\Http\Response
     */
    public function show(PopupAd $popupAd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PopupAd  $popupAd
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $popupAd = PopupAd::find($id);
        return view('popup_ad.edit',compact('popupAd'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PopupAd  $popupAd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $popupAd = PopupAd::findOrFail($id);
        // dd($popupAd);
        $request->validate([
            'half_or_full'=>'required'
        ]);


        $structure= "uploads/popup_photos/";
        $popup_photo=($request->popup_photo != null) ? $request->popup_photo : $popupAd->popup_img;
        // dd($popup_photo);
        if ($file = $request->file('popup_photo')) {
    
            $popup_photo = $request->file('popup_photo');
            $ext = '.'.$request->popup_photo->getClientOriginalExtension();
            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->popup_photo->getClientOriginalName());
            $file->move($structure, $fileName);
            $popup_photo = $fileName;
          

        }

        $arr=[
                'popup_img' => $popup_photo,
                'description' => $request->description,
                'path'=>$structure,
                'half_or_full'=>$request->half_or_full
               
            ];

        // $input = $request->all();
        $popupAd->fill($arr)->save();

         return redirect()->route('popup_ads.index')->with('message1','Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PopupAd  $popupAd
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $storagePath = public_path() . '/uploads/popup_photos/';

        $popupAd = PopupAd::find($id);
        if (File::exists($storagePath . $popupAd->popup_img)) {
                File::delete($storagePath . $popupAd->popup_img);
            };

        $popupAd = $popupAd->delete();
        return redirect()->route('popup_ads.index')->with('message1','Delete successfully');
    }


    public function changestatus(Request $request)
    {
        // dd($request->all());
        $popup_ad = PopupAd::find($request->popup_id);
        $popup_ad->status = $request->active;

        $popup_ad->save();
        return response()->json(['message1'=>'Status change successfully.']);
    }
}
