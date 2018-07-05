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

                    <h4>Tag - {{ $tag->name }}</h4>
                    {!! Form::model($tag) !!}
                    
                    <fieldset disabled>

                    @include('codetag::_form')
                    
                    </fieldset>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
