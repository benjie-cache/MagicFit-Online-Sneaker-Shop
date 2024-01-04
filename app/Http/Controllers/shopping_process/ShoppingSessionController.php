<?php

namespace App\Http\Controllers\shopping_process;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\shopping_process\ShoppingSession;
class ShoppingSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sessions=ShoppingSession::all();
        return response()->json($sessions);
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
        $shopping_session=ShoppingSession::create($request->all());
        return response()->json($shopping_session,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($shopping_session)
    {
        //
        $shopping_session=ShoppingSession::findorFail($shopping_session);
        return response()->json($shopping_session,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $shopping_session)
    {
        //
        $shopping_session->update($request->all());
     
        return response()->json($shopping_session,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($shopping_session)
    {
        //
        $shopping_session->delete();
        return response()->json($shopping_session,200);
    }
}
