@extends('layouts.site')

@section('title', 'Posts')

@section('content')
<h1>Posts</h1>

@if($posts->count())
  <ul>
    @foreach ($posts as $post)
      <li>
        <a href="{{ route('posts.single', $post->slug) }}">{{ $post->title }}</a>
        <p>{{ Str::limit(strip_tags($post->content), 100) }}</p>
      </li>
    @endforeach
  </ul>

  <div style="margin-top:20px;">
    {{ $posts->links() }}
  </div>
@else
  <p>No posts found.</p>
@endif
@endsection
