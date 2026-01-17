@extends('layouts/master')

@section('main_content')
    <h1>Lista dyal l-Users</h1>
    @foreach($users as $user)
        <p>{{ $user['name'] }}</p>
    @endforeach
@endsection