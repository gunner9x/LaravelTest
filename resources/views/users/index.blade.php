@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="col-sm-12">
            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
        <h1 class="display-3" style="margin: 10px;">Users</h1>
        <div>
            <a style="margin: 19px;" href="{{ route('users.create')}}" class="btn btn-primary">New User</a>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>@sortablelink('id','ID')</th>
                <th>@sortablelink('name','Full Name')</th>
                <th>@sortablelink('email','Email Address')</th>
                <th>@sortablelink('created_at','Date Added')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)

                <tr style="transform: rotate(0);">
                    <th><a href="{{ route('users.edit',$user->id)}}" class="stretched-link">{{ $user->id }}</a></th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>

                        {{-- <a href="{{ route('users.edit',$user->id)}}" class="btn btn-primary">Edit</a> --}}


                        {{-- <form action="{{ route('users.destroy', $user->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form> --}}

                </tr>
            </a>
            @endforeach
            </tbody>
        </table>
        {{-- {{ $users->links() }} --}}
        {!! $users->appends(\Request::except('page'))->render() !!}

    </div>
</div>

@endsection
