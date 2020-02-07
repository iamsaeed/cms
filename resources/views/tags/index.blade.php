@extends('test.master')

@section('title')
    Show All Tags
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <h3 class="text-center">Tags
            <a class="btn btn-sm btn-primary" href="{{route('tags.create')}}">Add New Tag</a>
            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col">
            <div class="card">
                <div class="card-panel p-2">

                    <table class="table table-striped table-borderless table-sm">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tags as $index => $tag)
                            <tr>
                                <th scope="row">{{$index + $tags->firstItem()}}</th>
                                <td>{{$tag->name}}</td>
                                <td>{{$tag->created_at}}</td>
                                <td>
                                    <a class="btn btn-sm btn-warning" href="{{route('tags.edit', $tag)}}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{$tags->links()}}
            </div>
        </div>
        <div class="col-2"></div>
    </div>

@endsection
