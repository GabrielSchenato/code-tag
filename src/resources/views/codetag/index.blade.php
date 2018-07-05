@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif


                    <a href="{{ route('admin.tags.create') }}" class="btn btn-primary">Create Tag</a>

                    <br>
                    <br>
                    <hr>

                    <h4>Tags</h4>


                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tags as $tag)
                            <tr>
                                <td>{{ $tag->id }}</td>
                                <td>{{ $tag->name }}</td>
                                <td>
                                    <a href="{{ route('admin.tags.edit', $tag->id) }}" class="btn btn-outline-primary">Edit tag</a>
                                    {!! Form::model($tag, ['route' => ['admin.tags.destroy', $tag->id], 'method' => 'delete', 'style' => 'display: inline;']) !!}
                                        {!! Form::submit('Delete tag', ['class' => 'btn btn-outline-danger']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
