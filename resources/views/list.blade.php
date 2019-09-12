@extends('layouts.app')

@section('content')

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">URL</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th scope="col">State</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($domains as $domain)
            <tr>
                <td>{{ $domain['id'] }}</td>
                <td><a href="{{route('domains.show', ['id' => $domain->id])}}" >{{ $domain['name'] }}</a></td>
                <td>{{ $domain['created_at'] }}</td>
                <td>{{ $domain['updated_at'] }}</td>
                <td>{{ $domain['state'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $domains->links() }}

@endsection
