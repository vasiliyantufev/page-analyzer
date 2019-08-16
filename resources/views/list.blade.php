@extends('layouts.app')

@section('content')
    <hr class="my-12">
    <div class="container">
        @foreach ($domains as $domain)
            {{ $domain->name }}
        @endforeach
    </div>

    {{ $domains->links() }}
@endsection
