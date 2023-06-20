@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Blog - {{$post->title}}</h2>
    <hr>
    <div class="card mb-3 mt-3">
        <div class="card-body">
            <h2 class="card-title">{{$post->title}}</h2>
            <h4 class="card-subtitle mb-2 text-muted">von {{$post->user->name}} am {{ date('d.m.Y', strtotime($post->created_at))}}</h4>
            <p class="card-text">{{$post->content}}</p>
            @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
                <div class="card-footer">
                    <a href="/blog/{{$post->slug}}/edit" class="btn btn-success">Bearbeiten</a>
                    <form action="/blog/{{$post->slug}}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Löschen</button>
                    </form>
                </div>
            @endif
        </div>
    </div>

    <!-- The comment function is disabled because it is not fully implemented yet -->
    @if (Auth::check())
        <form action="/comments" method="POST">
            @csrf
            <div class="mb-3">
                <input type="hidden" name="post_id" value="{{$post->id}}">
                <label for="comment" class="form-label">Kommentar (nicht verfügbar)</label>
                <textarea type="text" class="form-control" name="comment" id="comment"></textarea>
            </div>
            <button type="submit" class="btn btn-success disabled">Speichern</button>
        </form>
    @endif
</div>
@endsection