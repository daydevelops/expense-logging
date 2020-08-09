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
                <th>update?</th>
                <th>delete?</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $cat)
            <tr>
                <td>{{$cat->name}}</td>
                <td>{{$cat->contributors[0]->name}}</td>
                <td>
                    <input class="contribution-cat-{{$cat->id}}" 
                    type="number" 
                    data-user="{{$cat->contributors[0]->id}}"
                    min="0" 
                    max="100" 
                    value={{$cat->contributors[0]->pivot->contribution}}>
                </td>
                <td>{{$cat->contributors[1]->name}}</td>
                <td>
                    <input class="contribution-cat-{{$cat->id}}" 
                    type="number" 
                    data-user="{{$cat->contributors[1]->id}}"
                    min="0" 
                    max="100" 
                    value={{$cat->contributors[1]->pivot->contribution}}>
                <td>
                    <button class="btn btn-sm btn-primary" onclick='window.update({{$cat->id}})'>
                        Update
                    </button>
                </td>
                <td>
                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete_modal" onclick='window.cat2delete={{$cat->id}}'>
                        Delete
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-12">
            <a href="/categories/new">
                <button class="btn btn-lg btn-primary m-auto d-block">New Category</button>
            </a>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Are you sure you want to delete this category?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" onclick='window.delete()'>Delete</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src='{{ asset("js/categories.js") }}'></script>
@endsection