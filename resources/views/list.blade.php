@extends('layouts.app')

@section('content')
    <hr class="my-12">
    <div class="container">
        <ul>
            @foreach ($domains as $domain)
                <li><a href="/domains/{{ $domain->id }}" >{{ $domain->name }}</a></li>
            @endforeach
        </ul>
        {{ $domains->links() }}
    </div>

@endsection
