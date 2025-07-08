@extends('layouts.site')

@section('title', $post->title)

@section('content')
<h1>{{ $post->title }}</h1>
<p>{!! nl2br(e($post->content)) !!}</p>
<a href="{{ route('posts.list') }}">Back to Posts</a>
@endsection
