@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-4 offset-sm-2">
            <h1>Add an user</h1>
            <div>
                <form method="post" action="{{ route('users.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control" name="name"/>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="text" class="form-control" name="email"/>
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br/>
                    @endif
                    <button type="submit" class="btn btn-primary-outline" style="background-color: #1f6fb2; color: white;">Create User</button>
                    <a href="{{ route('users.index') }}" class="btn btn-warning">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
