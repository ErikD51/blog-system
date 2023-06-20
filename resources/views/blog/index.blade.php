@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Blog - Alle Beiträge</h2>
    <hr>

    @if (session()->has('message'))
        <h4 class="font-weight-bold text-success">{{session()->get('message')}}</h4>
    @endif

    @if (Auth::check())
        <div>
            <a href="/blog/create" class="btn btn-success">
                Blog erstellen
            </a>
        </div>
    @endif

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

    <!-- Pagination -->
    {{$posts->links()}}

</div>
@endsection