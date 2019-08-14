@extends('layouts.app')

@section('content')
    <hr class="my-12">
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">Page analyzer</h1>
            {{--<p class="lead">Это простой пример блока с компонентом в стиле jumbotron для привлечения дополнительного внимания к содержанию или информации.</p>--}}
            <hr class="my-4">
            <form action="domains" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" id="exampleInput" aria-describedby="help" placeholder="Enter name" name="name" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
@endsection
