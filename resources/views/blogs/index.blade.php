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
        <div class="col-md-2"></div>
        <div class="col-md-8">

            <table class="table table-sm table-borderless table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Sr.No.</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
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
            {{$blogs->links()}}
        </div>
        <div class="col-md-2"></div>
    </div>

@endsection
