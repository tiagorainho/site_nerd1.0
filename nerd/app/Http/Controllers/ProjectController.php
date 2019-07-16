<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Project::orderBy('id','desc') -> get();
        return view('pages.projects') -> with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create-project');
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
            $post = new Project;
    
            $post -> name = $request -> input('name');
            $post -> note = $request -> input('notes');
            $post -> img = "project.jpg";
            $post -> user_id = auth()->user()->id;
            $post->save();
            return redirect('projects') -> with('success','Project Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = Project::find($id);
        return view('pages.projects_edit')->with('post', $posts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Project::find($id);

        // check for correct user
        if(auth()->user()->id != $post->user_id){
            return redirect('\projects')->with('error','Unauthorized Page');
        }
        return view('pages.projects') -> with('post', $post);
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
    
            $post = Project::find($id);
            $post -> name = $request -> input('name');
            $post -> note = $request -> input('notes');
            $post ->save();
            return redirect('projects') -> with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Project::find($id);

        if(auth()->user()->id != $post->user_id){
            return redirect('projects')->with('error','Unauthorized Page');
        }
        
        $post ->delete();
        return redirect('projects')-> with('success','post deleted');
    }    
    public function search(Request $request)
    {
        $search = $request->input('search');
        $posts = Project::where('name','like','%'.$search.'%')->get();
        return view('pages.projects') -> with('posts', $posts);
    }

}
