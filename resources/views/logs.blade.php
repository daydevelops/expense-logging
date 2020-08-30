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

    @if(!\Request::is('archived'))
    <h3 class="text-center">Logs</h3>
    <button class="btn btn-sm btn-warning m-auto d-block" data-toggle="modal" data-target="#archive_modal">Archive These Logs</button>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="archive_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Archive These Logs?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    Are you sure? This cannot be undone. You should only archive the logs if the refunds have been balanced.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="window.archive()">Archive</button>
                </div>
            </div>
        </div>
    </div>
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