@extends('partials.master')

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

            <table class="table table-sm table-borderless table-striped">
                <thead>
                <tr>
                    <th scope="col">Sr.No.</th>
                    <th scope="col">Name</th>
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
                        <td>{{$category->created_at}}</td>
                        <td>{{$category->updated_at}}</td>
                        <td>
                            <a class="btn btn-sm btn-warning" href="{{route('categories.edit', $category)}}">Edit</a>
                            <a class="btn btn-sm btn-danger" href="#">Delete</a>
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
