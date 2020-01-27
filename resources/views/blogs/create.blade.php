@extends('partials.master')

@section('title')
    Create Blogs
@endsection

@section('content')
    <h3 class="text-center">
        Add Blog
    </h3>
    <hr>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('blogs.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Name</label>
                            <input name="title" type="text" class="form-control" id="title">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" type="text" class="form-control" id="description"></textarea>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="description">Select Tags</label>
                                    <select multiple class="form-control" name="tag_id[]">
                                        <option selected disabled>Select Tags...</option>
                                        @foreach($tags as $tag)
                                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="description">Select Category</label>
                                    <select class="form-control" name="category_id">
                                        <option selected disabled>Select Category...</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
@endsection
