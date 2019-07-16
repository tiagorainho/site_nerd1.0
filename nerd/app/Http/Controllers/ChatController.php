<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat;

class ChatController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Chat::orderBy('id','desc') -> get();
        return view('pages.chat') -> with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create-message');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this -> validate($request,[
            'messageText' => 'required'
            ]);
    
    
            //create post
            $post = new Chat;
            $post -> message = $request -> input('messageText');
            $post -> user_id = auth()->user()->id;
            $post->save();
            return redirect('chat') -> with('success','Message Sent');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = Chat::find($id);
        return view('pages.message_edit')->with('post', $posts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Chat::find($id);

        // check for correct user
        if(auth()->user()->id != $post->user_id){
            return redirect('\chat')->with('error','Unauthorized Page');
        }
        return view('pages.chat') -> with('post', $post);
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
        $this -> validate($request,[
            'name' => 'required',
            'notes' => 'required'
            ]);
    
            $post = Chat::find($id);
            $post -> name = $request -> input('name');
            $post -> note = $request -> input('notes');
            $post ->save();
            return redirect('chat') -> with('success','Message Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Chat::find($id);

        if(auth()->user()->id != $post->user_id){
            return redirect('Chat')->with('error','Unauthorized Page');
        }
        
        $post ->delete();
        return redirect('Chat')-> with('success','post deleted');
    }    
    public function search(Request $request)
    {
        $search = $request->input('search');
        $posts = Chat::where('name','like','%'.$search.'%')->get();
        return view('pages.Chat') -> with('posts', $posts);
    }
}
