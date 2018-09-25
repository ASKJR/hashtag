<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tweet;

class TwitterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $tags = Tweet::search('love');
       $tagsText = Tweet::gettext($tags,'love');
    }


    public function showSearchTweetForm()
    {
       return view('research_form');
    }

    public function results(Request $request)
    {
        if (!empty($request->all())) {
          
            $hashTag = str_replace("#", "", $request->input('search'));

            $tweets = Tweet::search($hashTag);
            $tagsText = Tweet::getText($tweets, $hashTag);


            return response()->json(['success'=> $tagsText]);  
        }

        return response()->json(['error'=> 'Parâmetros inválidos.']);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('research_form'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hashTag = $request->input('hashTag');
        if (!empty($hashTag)) {
            $hashTag = trim(str_replace("#", "", $hashTag));
            $tweets = Tweet::search($hashTag);
            $tagsText = Tweet::getText($tweets, $hashTag);

            dd(json_encode($tagsText));
        }
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
