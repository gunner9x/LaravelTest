@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-4 offset-sm-2">
            <h1>Edit an User</h1>

            <form method="post" action="{{ route('users.update', $user->id) }}">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control" name="name" value={{ $user->name }} />
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="text" class="form-control" name="email" value={{ $user->email }} />
                </div>

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br />
                @endif

                <button type="submit" class="btn btn-primary mr-2">Update User</button>
                <a href="{{ route('users.index') }}" class="btn btn-warning">Cancel</a>

            </form>
            <br>
            <form action="{{ route('users.destroy', $user->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Delete User</button>
            </form>


        </div>
    </div>
@endsection
