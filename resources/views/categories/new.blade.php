@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-12">
            <input type="text" placeholder="Category Name" id="cat_name" style="min-width:500px">
        </div>
    </div>
    <br>
    <p><b>Contributions</b></p>
    @foreach ($users as $u)
    <div class="row form-inline">
        <div class="col col-12 form-group">
            <label class="col-3">{{$u->name}}</label>
            <div class="col-9">
                <input type="number" class="contribution" data-user="{{$u->id}}" class="form-control" min="0" max="100" value=50 style="max-width:100px">
            </div>
        </div>
    </div>
    @endforeach
    <br>
    <button class="btn btn-lg btn-primary" onclick="window.new()">Save</button>
</div>
@endsection
@section('js')
<script src='{{ asset("js/categories.js") }}'></script>
@endsection