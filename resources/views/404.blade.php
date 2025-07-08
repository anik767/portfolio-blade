@extends('layouts.site')

@section('title', 'Page Not Found')

@section('content')
  <h1>404 - Page Not Found</h1>
  <p>Sorry, the page you are looking for does not exist.</p>
  <a href="{{ route('posts.list') }}">Back to Posts</a>
@endsection
