<?php

namespace App\Http\Controllers\Api;

use App\Blog;
use App\Http\Resources\BlogResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function show($id)
    {
        return new BlogResource(Blog::find($id));
    }
}
