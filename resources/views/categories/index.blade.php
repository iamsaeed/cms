@extends('layouts.app')

@section('title')
    All Categories
@endsection

@section('content')

    <h3 class="text-center">
        Categories List
        <small> <a class="text-success" title="Add New Category" href="{{route('categories.create')}}">+</a></small>
    </h3>
    <hr>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form class="form-inline" method="get" action="{{route('categories.index')}}">
                <div class="form-group">
                    <label>Name</label>
                    <input name="name" type="text" class="form-control" value="{{$name}}">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <input name="description" type="text" class="form-control" value="{{$description}}">
                </div>
                <button class="btn btn-primary" type="submit">Search</button>
                <a class="btn btn-danger" href="{{route('categories.index')}}">Reset</a>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">

            <table class="table table-sm table-borderless table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Sr.No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Blogs</th>
                    <th scope="col">Created By</th>
                    <th scope="col">Created</th>
                    <th scope="col">Updated</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <th scope="row">{{$category->id}}</th>
                        <td>{{$category->name}}</td>
                        <td>{{$category->description}}</td>
                        <td>{{$category->blogs->count()}}</td>
                        <td>
                            @if($category->user_id)
                            {{$category->user->name}}
                            @else
                                None
                            @endif
                        </td>
                        <td>{{$category->created_at->diffForHumans()}}</td>
                        <td>{{$category->updated_at->diffForHumans()}}</td>
                        <td width="30%">
                            @permission('read-categories')
                            <a class="btn btn-sm btn-success float-left" href="{{route('categories.show', $category->slug)}}">View</a>
                            @endpermission
                            @permission('updated-categories')
                            <a class="btn btn-sm btn-warning float-left" href="{{route('categories.edit', $category)}}">Edit</a>
                            @endpermission
                            @permission('delete-categories')
                            <form action="{{route('categories.destroy', $category)}}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                            @endpermission
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$categories->links()}}
        </div>
        <div class="col-md-2"></div>
    </div>

@endsection
