<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostContent;
use Illuminate\Http\Request;
use function Symfony\Component\Translation\getLocale;

class PostController extends FarzadController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postList = Post::with('_content_lang')->latest()->paginate(20);

        return view('post.index',compact('postList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $type           = $request->get('type');
        $title          = $request->get('title');
        $description    = $request->get('description');
        $content        = $request->get('content');
        $image          = $request->file('image');
        $language       = $request->get('language','en');
        $postid         = $request->get('postid',0);

        if($image != null && $image != '')
            $image = $this->ImageUploader($image);
        if($postid == 0) {
            $post = Post::create([
                'type' => $type
            ]);
            $postid = $post->id;
        }

        PostContent::create([
            'post_id'       =>  $postid,
            'language'      =>  $language,
            'image'         =>  $image,
            'title'         =>  $title,
            'description'   =>  $description,
            'content'       =>  $content
        ]);

        return redirect()->route('post.edit',$postid);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($post)
    {
        $post = Post::with('_content_lang')->where('id','=',$post)->first();

        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $post)
    {
        $type           = $request->get('type');
        $title          = $request->get('title');
        $description    = $request->get('description');
        $content        = $request->get('content');
        $image          = $request->file('image');
        $language       = $request->get('language','en');
        $postid         = $post;

        $post = Post::find($post);
        $post->update([
            'type'=>$type
        ]);

        $postContent = PostContent::where('language','=',$language)->
                                    where('post_id','=',$postid)->first();


        if($postContent != null)
        {
            if($image != null && $image != '') {
                $image = $this->ImageUploader($image);
            }else{
                $image = $postContent->image;
            }

            $postContent->update([
                'image'         =>  $image,
                'title'         =>  $title,
                'description'   =>  $description,
                'content'       =>  $content
            ]);
        }else{
            if($image != null && $image != '') {
                $image = $this->ImageUploader($image);
            }

            PostContent::create([
                'post_id'       =>  $postid,
                'language'      =>  $language,
                'image'         =>  $image,
                'title'         =>  $title,
                'description'   =>  $description,
                'content'       =>  $content
            ]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
