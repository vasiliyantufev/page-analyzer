@extends('layouts.app')

@section('content')

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">Header</th>
                <th scope="col">Content-length</th>
                <th scope="col">Keywords</th>
                <th scope="col">Description</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">{{ $domain->id }}</th>
                <td>{{ $domain->name }}</td>
                <td>{{ $domain->status }}</td>
                <td>{{ $domain->header }}</td>
                <td>{{ $domain->content_length }}</td>
                <td>{{ $domain->keywords }}</td>
                <td>{{ $domain->description }}</td>
            </tr>
            </tbody>
        </table>
@endsection
