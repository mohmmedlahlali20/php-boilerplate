@extends('layouts/master')
    @section('main_content')
            <h1 class="text-3xl font-bold text-blue-600">User Management</h1>
                @foreach($users as $user)
                    <p>{{ $user['name'] }}</p>
                @endforeach
    @endsection

    @section('scripts')
    <script>
        console.log("Hada script gha-y-khdem ghir f had l-page!");
    </script>
@endsection