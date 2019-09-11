@extends('layouts.app')

@section('content')
        <div class="jumbotron">
            <h1 class="display-4">Page analyzer</h1>
            <p class="lead">A site that analyzes these pages for SEO suitability, similar to https://varvy.com/pagespeed/.</p>
            <hr class="my-4">
            <form action="{{route('domains.store')}}" method="post">
                <div class="form-group">
                    <input type="url" class="form-control" id="exampleInput" aria-describedby="help" placeholder="Enter url" name="name" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
@endsection
