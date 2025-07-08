@extends('layouts.admin')

@section('title', 'Edit Post')

@section('content')
<h1>Edit Post</h1>

@if ($errors->any())
  <div style="color:red;">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form action="{{ route('admin.posts.update', $post->id) }}" method="POST">
  @csrf
  @method('PUT')
  <div>
    <label>Title</label><br>
    <input type="text" name="title" value="{{ old('title', $post->title) }}" required>
  </div>
  <div>
    <label>Slug</label><br>
    <input type="text" name="slug" value="{{ old('slug', $post->slug) }}" required>
  </div>
  <div>
    <label>Content</label><br>
    <textarea name="content" rows="6" required>{{ old('content', $post->content) }}</textarea>
  </div>
  <button type="submit">Update</button>
</form>

<a href="{{ route('admin.posts') }}">Back to Posts</a>
@endsection
