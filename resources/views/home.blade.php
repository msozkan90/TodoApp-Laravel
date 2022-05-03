@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
    <h4>Add Todo</h4>
                        <form action="{{route('add')}}" method="post">
                            {{csrf_field()}}
                            <div>
                                <label for="userid">User</label>
                                <select class="form-control" name="userid" required="" id="id_userid" >
                                    <option value="{{ Auth::user()->id }}" selected="{{ Auth::user()->name }}" readonly>{{ Auth::user()->name }} </option>
                                </select>


                                <label for="work">Work</label>
                                <input class="form-control" name="work" type="text">

                            </div>
                            <button type="submit" class="btn btn-danger mt-3">ADD</button>
                        </form>



                </div>
            </div>
        </div>
    </div>
</div>
<table class="table mt-5">
    <thead class="thead-dark">
    <tr>
        <th scope="col">id</th>
        <th scope="col">Username</th>
        <th scope="col">Work</th>
        <th scope="col">Situation</th>
        <th scope="col">Delete</th>
        <th scope="col">Update</th>
    </tr>
    </thead>
    <tbody>
    @if($at != 0)
    @foreach( $todos as $key => $todo)
    <tr>

        <th scope="row">{{$todo['id']}}</th>
        <td>{{App\Models\User::where('id','=',$todo['userid'])->get()[0]->name}}</td>
        <td>{{$todo['work']}}</td>
        @if($todo['situation'] == 0)
        <td>Not Complete</td>
        @else
            <td>Complete</td>
        @endif
        <td><a href="{{route('delete',['id'=>$todo['id']])}}"><button class="btn btn-danger">DELETE</button> </a> </td>
        <td><a href="{{route('update',['id'=>$todo['id']])}}"><button class="btn btn-danger">UPDATE</button></a>  </td>

    </tr>
    @endforeach
    @else
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td> There is no any record </td>
    </tr>
    @endif
    </tbody>
</table>


@endsection
