<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tweet;
use App\Hashtag;

class TwitterController extends Controller
{

    public function showSearchTweetForm()
    {
       return view('research_form');
    }

    public function results(Request $request)
    {
        if (!empty($request->all())) {
          
            $hashTag = trim(str_replace("#", "", $request->input('search')));

            $tweets = Tweet::search($hashTag);
            $tagsText = Tweet::getText($tweets, $hashTag);


            return response()->json(['success'=> $tagsText]);  
        }

        return response()->json(['error'=> 'Parâmetros inválidos.']);
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

            $h = new Hashtag();
            $h->hashtag = "#" . $hashTag;
            $h->messages = json_encode($tagsText);
            
            if ($h->save()) {
                return redirect('/hashtag/search')->with('success', 'Registro salvo no BD com sucesso.');                              
            }
            else {
                return redirect('/hashtag/search')->with('error', 'Não foi possível salvar.');
            }
        }
    }
}
