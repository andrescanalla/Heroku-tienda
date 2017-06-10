<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Importweb;

class ImportwebController extends Controller
{
    //Upload a blank cookie.txt to the same directory as this file with a CHMOD/Permission to 777




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        echo Importweb::login("https://collector-px0f3091f3.perimeterx.net/api/v1/collector/beacon","dwfrm_login_username_d0lbqlfeumgd=pasquinelli%40a-w-a.com.ar&dwfrm_login_rememberme=true&dwfrm_login_password=Clandestina2&dwfrm_login_login=Sign+in&dwfrm_login_securekey=1878682064");
       echo Importweb::grab_page("https://www.carters.com/on/demandware.store/Sites-Carters-Site/default/OrderHistory-GetOrderList?CustomerId=CAR_14857542&viewAll=true");        
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }




}
