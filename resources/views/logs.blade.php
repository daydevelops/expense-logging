@extends('layouts.app')

@section('content')
<div class="container">
    @isset($refunds)
    <div class="row justify-content-center">
        <h3 class="text-center">
            Refunds
        </h3>
        <table class="table table-bordered">
            <tbody>
                @foreach($refunds as $name=>$ref)
                <tr>
                    <td scope="row">{{$name}}</td>
                    <td>{{$ref}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endisset

    <table class="table table-sm">
        <thead>
            <tr>
                <th>Payer</th>
                <th>Category</th>
                <th>Cost</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td scope="row">{{$log->payer->name}}</td>
                <td>{{$log->category->name}}</td>
                <td>{{$log->cost}}</td>
<td><button class="btn btn-danger btn-sm" onclick="window.delete({{$log->id}})">Delete</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('js')
<script src='{{ asset("js/logs.js") }}'></script>
@endsection