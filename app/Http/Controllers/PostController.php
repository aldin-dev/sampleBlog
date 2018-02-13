<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user_id = Auth::id();
        $posts = Post::orderBy('id', 'desc')->where('user_id', $user_id)->get();
        return view('posts.index')->with('posts', $posts);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'post_name' => 'required',
            'post_description' => 'required',
            'image' => 'required|image',
        ]);


        // Get filename with the extension
        $filenameWithExt = $request->file('image')->getClientOriginalName();
        // Get just the filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just the ext
        $extension = $request->file('image')->getClientOriginalExtension();
        // Filename to store // catatonate  to make filename unique.
        $new_img_name = $filename.'_'.time().'.'.$extension;
            // Upload Image
        $path = $request->file('image')->storeAs('public/images/', $new_img_name);

        $post = new Post();
        $userId = Auth::id();

        $post->post_name = $request->post_name;
        $post->user_id = $userId;
        $post->post_description = $request->post_description;
        $post->image = $new_img_name;
        $post->save();

        return redirect('posts/')->with('success', 'Post&nbsp;'.$request->post_name.'&nbsp;Created!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts/show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit')->with('post', $post);
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

        $this->validate($request, [
            'post_name' => 'required',
            'post_description' => 'required',
            'image' => 'nullable|image',
        ]);

        if($request->hasFile('image')){
           
            $post = Post::find($id);
            
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just the filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just the ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store // catatonate  to make filename unique.
            $new_img_name = $filename.'_'.time().'.'.$extension;

            //get old image first then delete.
            $old_img = $post->image;
            Storage::delete('public/images/'.$old_img);

            // Upload Image
            $path = $request->file('image')->storeAs('public/images/', $new_img_name);

            $post->post_name = $request->post_name;
            $post->post_description = $request->post_description;
            $post->image = $new_img_name;
            $post->save();
        
        }else{

            $post = Post::find($id);
            $post->post_name = $request->post_name;
            $post->post_description = $request->post_description;
            $post->save();
        }

             return redirect('posts/')->with('success', 'Post&nbsp;'.$request->post_name.'&nbsp;Updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post_img = $post->image;
        Storage::delete('public/images/'.$post_img);
        $post->delete();

        return redirect('posts/')->with('success', 'Post&nbsp;'.$post->post_name.'&nbsp;Deleted!');
    }
}
