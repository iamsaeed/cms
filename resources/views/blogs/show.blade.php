@extends('partials.master')

@section('title')
    {{$blog->title}}
@endsection

@section('content')
    <h3 class="text-center">
        View Blog
    </h3>
    <hr>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3>Title: {{$blog->title}}</h3>
                    <hr>

                    <p class="text-justify">
                        Description: {{$blog->description}}
                    </p>

                    <p class="text-justify">
                        Category: {{$blog->category->name}}
                    </p>
                    @if($blog->tags->count() > 0)
                    Tags:<br>
                    @foreach($blog->tags as $tag)
                    <div class="badge badge-info">{{$tag->name}}</div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
@endsection
