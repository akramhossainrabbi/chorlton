<?php

namespace App\Http\Controllers;

use App\PromoCode;
use Illuminate\Http\Request;

class PromoCodeController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('PromoCode.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $request)
    {
        $this->validate($request, [
            'code' => 'required',
            'percentage' => 'required',
        ]);

        $isactive=$request->isactive?1:0;
        
        $bran = new PromoCode;
        $bran->code = $request->code;
        $bran->percentage = $request->percentage;
        $bran->isactive = $isactive;
        $bran->save();

        return redirect('admin-ecom/promo-code')->with('status', 'Promo Code Added Successfully!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PromoCode  $PromoCode
     * @return \Illuminate\Http\Response
     */

    public function showjson() {
        $json = PromoCode::all();
        $retarray = array("data" => $json, "total" => count($json));
        return response()->json($retarray);
        //"{\"data\":" . json_encode($json) . ",\"total\":" . count($json) . "}"
    }

    public function show($id)
    {
        $json=PromoCode::find($id);
        return view('PromoCode.edit',['data'=>$json]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PromoCode  $PromoCode
     * @return \Illuminate\Http\Response
     */
    public function edit(PromoCode $PromoCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PromoCode  $PromoCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PromoCode $PromoCode)
    {
        $this->validate($request, [
            'code' => 'required',
            'percentage' => 'required',
        ]);


        $isactive=$request->isactive?1:0;
        
        $bran = PromoCode::find($request->id);
        $bran->code = $request->code;
        $bran->percentage = $request->percentage;
        $bran->isactive = $isactive;
        $bran->update();

        return redirect('admin-ecom/promo-code')->with('status', 'Promo Code Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PromoCode  $PromoCode
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $json=PromoCode::find($id);
        $json->delete();
        return response()->json(1);
    }
}
