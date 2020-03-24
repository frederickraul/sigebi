<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Chat;
class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $lastMessage = $data['lastMessage'];
        if($lastMessage == ""){
            $lastMessage = "2020-01-01 00:00:00";
        }
        $userChat = Chat::with('user')
                                    ->where('clase_id', $data['clase_id'])
                                    ->where('created_at','>',$lastMessage)
                                    ->OrderBy('created_at','asc')
                                    ->get();

             return $userChat;
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
        $data = $request->all();
        
        $message = new Chat;
        $message->user_id   = $data['user_id'];        
        $message->clase_id  = $data['clase_id'];        
        $message->mensaje   = $data['message']; 
        $lastMessage = $data['lastMessage'];
        if($lastMessage == ""){
            $lastMessage = "2020-01-01 00:00:00";
        }
        if($message->save()){
            $userChat = Chat::with('user')
                                    ->where('clase_id', $data['clase_id'])
                                    ->where('created_at','>',$lastMessage)
                                    ->OrderBy('created_at','asc')
                                    ->get();

             return $userChat;
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
