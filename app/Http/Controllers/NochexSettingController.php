<?php

namespace App\Http\Controllers;

use App\NochexSetting;
use Illuminate\Http\Request;

class NochexSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $CheckTab=NochexSetting::orderBy('id','DESC')->count();
        $ret=[];
        if($CheckTab>0)
        {
            $Tab=NochexSetting::orderBy('id','DESC')->first();
            $ret=['edit'=>$Tab];
        }
        
        return view('nochexsettings.index',$ret);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request,[
            'nochex_merchant_id'=>'required',
        ]);

        $tax_status=$request->nochex_status?'Active':'Inactive';

        $tab=new NochexSetting;
        $tab->nochex_merchant_id=$request->nochex_merchant_id;
        $tab->nochex_status=$tax_status;
        $tab->save();

        return redirect('admin-ecom/nochexsetting')->with('status', 'Nochex Settings Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NochexSetting  $nochexSetting
     * @return \Illuminate\Http\Response
     */
    public function show(NochexSetting $nochexSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NochexSetting  $nochexSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(NochexSetting $nochexSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NochexSetting  $nochexSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NochexSetting $nochexSetting)
    {
        
       /* $this->validate($request,[
            'nochex_merchant_id'=>'required',
        ]);*/

        $tax_status=$request->nochex_status?'Active':'Inactive';

        $tab=NochexSetting::orderBy('id','DESC')->first();
        $tab->nochex_merchant_id=$request->nochex_merchant_id;
        $tab->nochex_status=$tax_status;
        $tab->save();
        
        return redirect('admin-ecom/nochexsetting');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NochexSetting  $nochexSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(NochexSetting $nochexSetting)
    {
        //
    }
}
