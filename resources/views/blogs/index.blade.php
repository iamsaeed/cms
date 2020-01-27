@extends('partials.master')

@section('title')
    All Blogs
@endsection

@section('content')

    <h3 class="text-center">
        Blogs List
        <small> <a class="text-success" title="Add New Blog" href="{{route('blogs.create')}}">+</a></small>
    </h3>
    <hr>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <form class="form-inline">
                <div class="form-group mb-2">
                    <label for="title" class="sr-only">Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Title..." value="{{$title}}">
                </div>
                <div class="form-group mb-2">
                    <label for="category" class="sr-only">Category</label>
                    <input type="text" name="category" class="form-control" id="category" placeholder="Category..." value="{{$category}}">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Search</button>
            </form>
        </div>
        <div class="col-md-1"></div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">

            <table class="table table-sm table-borderless table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Sr.No.</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Created</th>
                    <th scope="col">Updated</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($blogs as $index => $blog)
                    <tr>
                        <th scope="row">{{$index + $blogs->firstItem()}}</th>
                        <td>{{$blog->title}}</td>
                        <td>{{$blog->category->name}}</td>
                        <td>
                            @foreach($blog->tags as $tag)
                                <div class="badge badge-dark">{{$tag->name}}</div>
                            @endforeach
                        </td>
                        <td>{{$blog->created_at->diffForHumans()}}</td>
                        <td>{{$blog->updated_at->diffForHumans()}}</td>
                        <td width="30%">
                            <a class="btn btn-sm btn-success float-left" href="{{route('blogs.show', $blog)}}">View</a>
                            <a class="btn btn-sm btn-warning float-left" href="{{route('blogs.edit', $blog)}}">Edit</a>
                            <form action="{{route('blogs.destroy', $blog)}}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$blogs->appends($_GET)->links()}}
        </div>
        <div class="col-md-1"></div>
    </div>

@endsection
