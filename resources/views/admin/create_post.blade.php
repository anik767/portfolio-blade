@extends('layouts.admin')

@section('title', 'Create Post')

@section('content')
<h1>Create New Post</h1>

@if ($errors->any())
  <div style="color:red;">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form action="{{ route('admin.posts.store') }}" method="POST">
  @csrf
  <div>
    <label>Title</label><br>
    <input type="text" name="title" value="{{ old('title') }}" required>
  </div>
  <div>
    <label>Slug</label><br>
    <input type="text" name="slug" value="{{ old('slug') }}" required>
  </div>
  <div>
    <label>Content</label><br>
    <textarea name="content" rows="6" required>{{ old('content') }}</textarea>
  </div>
  <button type="submit">Create</button>
</form>

<a href="{{ route('admin.posts') }}">Back to Posts</a>
@endsection
