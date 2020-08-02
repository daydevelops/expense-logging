@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>User 1</th>
                <th>%</th>
                <th>User 2</th>
                <th>%</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $cat)
            <tr>
                <td>{{$cat->name}}</td>
                <td>{{$cat->contributors[0]->name}}</td>
                <td>{{$cat->contributors[0]->pivot->contribution}}</td>
                <td>{{$cat->contributors[1]->name}}</td>
                <td>{{$cat->contributors[1]->pivot->contribution}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
