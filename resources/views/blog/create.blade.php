@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Blog - Beitrag erstellen</h2>
    <hr>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li class="text-danger">{{$error}}</li>
            @endforeach
        </ul>
    @endif
    
    <form method="POST" action="/blog">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Titel</label>
            <input type="text" value="{{old('title')}}" class="form-control @error('title') is-invalid @enderror" name="title" id="title">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Inhalt</label>
            <textarea type="text" value="{{old('content')}}" class="form-control @error('content') is-invalid @enderror" name="content" id="content"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Speichern</button>
    </form>
</div>
@endsection