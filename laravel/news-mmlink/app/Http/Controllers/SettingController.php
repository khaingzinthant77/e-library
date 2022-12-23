<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = new Setting();
        $count = $data->get()->count();
        $data = $data->orderBy('created_at','desc')->paginate(10);
        return view('setting_url.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setting_url.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $setting_url = Setting::create([
            'url'=>$request->url,
            'description'=>$request->description,
        ]);

        return redirect()->route('setting_url.index')->with('success','Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $setting_url = Setting::find($id);
        return view('setting_url.edit',compact('setting_url'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $setting_url = Setting::find($id)->update([
            'url'=>$request->url,
            'description'=>$request->description
        ]);

        return redirect()->route('setting_url.index')->with('success','Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        $setting_url = Setting::find($id)->delete();

        return redirect()->route('setting_url.index')->with('success','Success');
    }

    public function change_status_url(Request $request)
    {
        $setting_url = Setting::find($request->url_id);
        $setting_url->status = $request->active;

        $setting_url->save();
        return response()->json(['message1'=>'Status change successfully.']);
    }
}
