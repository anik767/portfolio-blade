@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<h1>Admin Dashboard</h1>
<p>Welcome, {{ auth()->user()->name }}!</p>
<a href="{{ route('admin.posts') }}">Manage Posts</a>
@endsection
