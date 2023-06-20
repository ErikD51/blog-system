@extends('layouts.app')

@section('title', 'Blog | Willkommen')
@section('content')
<div class="container">
    <h2>Blog - Willkommen</h2>
    <div>
        <p class="bg-body-tertiary text-secondary p-2">
            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod 
            tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero 
            eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea 
            takimata sanctus est Lorem ipsum dolor sit amet. At vero eos et accusam et justo duo 
            dolores et ea rebum. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed 
            diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam 
            voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd 
            gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. 

            Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, 
            vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio 
            dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla 
            facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh 
            euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. 
        </p>
    </div>
    <hr>

    <div class="text-center">
        <h4>Die letzten Blog-Beiträge</h4>
    </div>

    @foreach ($posts as $post)
        <div class="card mb-3 mt-3">
            <div class="card-body">
                <h2 class="card-title">{{$post->title}}</h2>
                <h4 class="card-subtitle mb-2 text-muted">von {{$post->user->name}} am {{ date('d.m.Y', strtotime($post->created_at))}}</h4>
                <p class="card-text">{{$post->content}}</p>
                <a href="/blog/{{$post->slug}}" class="btn btn-success">Detailansicht</a>

                @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
                    <a href="/blog/{{$post->slug}}/edit" class="btn btn-success">Bearbeiten</a>
                    <form action="/blog/{{$post->slug}}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Löschen</button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach

</div>
@endsection