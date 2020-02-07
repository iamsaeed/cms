@extends('test.master')

@section('title')
    Create Tag
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <h3 class="text-center">Create Tags</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col">
            <div class="card">
                <div class="card-panel p-2">
                    <form method="post" action="{{route('tags.store')}}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tag Name</label>
                            <input name="name" type="name" class="form-control" value="{{ old('name') }}">
                            @error('name')
                            <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                            @enderror

                        </div>
                        <button type="submit" class="btn btn-primary">Create Tag</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-2"></div>
    </div>

@endsection
