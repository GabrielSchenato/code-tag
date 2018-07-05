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

                    <h4>Create Tag</h4>
                    {!! Form::open(['route' => 'admin.tags.store', 'method' => 'post']) !!}

                    @include('codetag::_form')

                    <div class="form-group">
                        {!! Form::submit('Create Tag', ['class' => 'btn btn-primary btn-lg btn-block']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
