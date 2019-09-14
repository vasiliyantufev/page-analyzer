@extends('layouts.app')

@section('content')

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">URL</th>
                <th scope="col">@lang('messages.status')</th>
                <th scope="col">@lang('messages.header')</th>
                <th scope="col">@lang('messages.length')</th>
                <th scope="col">@lang('messages.keywords')</th>
                <th scope="col">@lang('messages.description')</th>
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
