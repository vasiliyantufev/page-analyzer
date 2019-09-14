@extends('layouts.app')

@section('content')
        <div class="jumbotron">
            <h1 class="display-4">@lang('messages.name')</h1>
            <p class="lead">@lang('messages.info')</p>
            <hr class="my-4">
            <form action="{{route('domains.store')}}" method="post">
                <div class="form-group">
                    <input type="url" class="form-control" id="exampleInput" aria-describedby="help" placeholder=@lang('messages.enter') name="name" required>
                </div>
                <button type="submit" class="btn btn-primary">@lang('messages.submit')</button>
            </form>

        </div>
@endsection
