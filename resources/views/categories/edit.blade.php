@extends('partials.master')

@section('title')
    Edit Categories
@endsection

@section('content')
    <h3 class="text-center">
        Edit Category
    </h3>
    <hr>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('categories.update', $category)}}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input name="name" type="text" class="form-control" id="name" value="{{$category->name}}">
                            @error('name')
                            <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea rows="7" name="description" type="text" class="form-control" id="description">{{$category->description}}</textarea>
                            @error('description')
                            <small id="emailHelp" class="form-text text-danger">{{description}}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
@endsection
