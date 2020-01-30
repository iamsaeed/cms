@extends('layouts.app')

@section('title')
    Edit Blogs
@endsection

@section('content')
    <h3 class="text-center">
        Edit Blog : {{$blog->title}}
    </h3>
    <hr>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('blogs.update', $blog)}}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="title">Name</label>
                            <input name="title" type="text" class="form-control" id="title" value="{{$blog->title}}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea rows="7" name="description" type="text" class="form-control" id="description">{{$blog->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">Select Tags</label>
                            <select multiple class="form-control" name="tag_id[]">
                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Select Category</label>
                            <select class="form-control" name="category_id">
                                <option selected disabled>Select Category...</option>
                                @foreach($categories as $category)
                                    <option
                                        @if($category->id == $blog->category_id)
                                        selected
                                        @endif
                                        value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
@endsection
