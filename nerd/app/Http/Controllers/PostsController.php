<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use DB;
use App\User;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::orderBy('title','asc')->take(1)->get();            USAR TAKE
        //$posts = Post::where('id','1')->get();
        //$posts = Post::all();
        //$posts = Post::orderBy('title','asc')->paginate(1);                 NOT SURE
        //$posts = DB::select('SELECT * FROM posts'); //                    A USAR QUERY
        
        $posts = Item::orderBy('id','desc') -> get();
        return view('pages.inventory') -> with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create');
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
            'name' => 'required',
            'notes' => 'required'
            ]);
    
    
            //create post
            $post = new Item;
    
            $post -> name = $request -> input('name');
            $post -> note = $request -> input('notes');
            $post -> user_id = auth()->user()->id;
            $post->save();
            return redirect('Inventory') -> with('success','Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Item::find($id);
        return view('pages.inventory') -> with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Item::find($id);

        // check for correct user
        if(auth()->user()->id != $post->user_id){
            return redirect('\Inventory')->with('error','Unauthorized Page');
        }
        return view('pages.edit') -> with('post', $post);
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
    
            $post = Item::find($id);
            $post -> name = $request -> input('name');
            $post -> note = $request -> input('notes');
            $post ->save();
            return redirect('Inventory') -> with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Item::find($id);

        if(auth()->user()->id != $post->user_id){
            return redirect('Inventory')->with('error','Unauthorized Page');
        }
        
        $post ->delete();
        return redirect('Inventory')-> with('success','post deleted');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $posts =Item::where('name','like','%'.$search.'%')->orWhere('note','like','%'.$search.'%')->get();
        //return view('Inventory') -> with('posts', $posts);
        //return redirect('Inventory')->with('posts', $posts);
        return view('pages.inventory')->with('posts', $posts);//  funcional mas vai para outra pagina
    }

    public function index_users(Request $request)
    {
        $posts = User::orderBy('id','desc') -> get();
        return view('/users') -> with('posts', $posts);
    }
    //return redirect
}