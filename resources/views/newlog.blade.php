@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form-group">
      <label for="category">Category</label>
      <select class="form-control" name="category" id="category">
        @foreach($categories as $cat)
            <option value="{{$cat->id}}">{{$cat->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="payer">Payer</label>
      <select class="form-control" name="payer" id="payer">
        @foreach($users as $u)
            <option value="{{$u->id}}">{{$u->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="">Cost</label>
      <input type="number"
        class="form-control" name="cost" id="cost" aria-describedby="helpId" placeholder="cost">
    </div>
    <div class="form-group">
      <label for="">Date (optional)</label>
      <input type="date"
        class="form-control" name="date" id="date" aria-describedby="helpId">
    </div>
    <button type="submit" class="btn btn-primary" onclick="window.newLog()">Submit</button>
</div>
@endsection

@section('js')
<script src='{{ asset("js/logs.js") }}'></script>
@endsection