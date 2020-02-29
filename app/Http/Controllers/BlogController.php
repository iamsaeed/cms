<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Blog;
use App\Category;
use App\Mail\BlogCreated;
use App\Mail\BlogUpdated;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image as Photo;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $title = $request->title ? $request->title : '';
        $category = $request->category ? $request->category : '';
        $blogs = Blog::where('title', 'like', '%'.$title.'%')
            ->orWhere('category_id', 'like', '%'.$category.'%')
            ->paginate(5);
        return view('blogs.index')->withBlogs($blogs)->withTitle($title)->withCategory($category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('blogs.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $blog = new Blog;
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->category_id = $request->category_id;

        if($request->file('image'))
        {
            $filename = $this->upoadImage($request->file('image'));

            $blog->image = $filename;
        }

        $blog->save();

        $blog->tags()->sync($request->tag_id);

        //send mail
        Mail::to('test@test.com')->send(new BlogCreated($blog));

        return redirect()->route('blogs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return Response
     */
    public function show(Blog $blog)
    {
        return view('blogs.show')->withBlog($blog);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return Response
     */
    public function edit(Blog $blog)
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('blogs.edit')->withBlog($blog)->withCategories($categories)->withTags($tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return Response
     */
    public function update(Request $request, Blog $blog)
    {
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->category_id = $request->category_id;

        if($request->file('image'))
        {
            if($blog->image !== null){
                $this->deleteImage($blog->image);
            }

            $filename = $this->upoadImage($request->file('image'));

            $blog->image = $filename;
        }

        $blog->save();

        $blog->tags()->sync($request->tag_id);

        Mail::to('info@hellow.in')->send(new BlogUpdated($blog));

        return redirect()->route('blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Blog $blog
     * @return Response
     * @throws \Exception
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        if($blog->image)
        {
            $this->deleteImage($blog->image);
        }

        return redirect()->route('blogs.index');
    }

    public function upoadImage($image){

        //generating random string from current time
        $random_name = time();

        //getting image extension
        $extension = $image->getClientOriginalExtension();

        //generating new image name
        $filename = time() . '.' . $extension;

        //Saving image here
        Photo::make($image)->save(public_path('/' . $filename));

        return $filename;
    }

    public function deleteImage($image)
    {
        $filename = public_path() . '/' . $image;

        unlink($filename);

    }
}
