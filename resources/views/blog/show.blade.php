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

    @if (session()->has('message'))
        <h4 class="font-weight-bold text-success">{{session()->get('message')}}</h4>
    @endif

    <h3>Kommentare</h3>
    @if (isset($comments))
        @foreach ($comments as $comment)
            <div class="card mb-3 mt-3">
                <div class="card-body">
                    <h2 class="card-title">Von {{$comment->user->name}}</h2>
                    <p class="card-text">{{$comment->comment}}</p>
                    @if (isset(Auth::user()->id) && Auth::user()->id == $comment->user_id)
                        <div class="card-footer">
                            <form action="/comment/{{$comment->id}}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Löschen</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    @endif

    <hr>

    @if (Auth::check())
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-danger">{{$error}}</li>
                @endforeach
            </ul>
        @endif
        <form action="/comment" method="POST">
            @csrf
            <div class="mb-3">
                <input type="hidden" name="post_id" value="{{$post->id}}">
                <label for="comment" class="form-label">Kommentar schreiben:</label>
                <textarea type="text" class="form-control @error('comment') is-invalid @enderror" name="comment" id="comment"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Speichern</button>
        </form>
    @endif

</div>
@endsection