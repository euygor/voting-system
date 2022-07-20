@extends('template.layout')

@section('title', 'Visualizar Enquete')

@section('container')
<a href="{{route('index')}}" class="btn btn-primary mb-2">Todas as Enquetes</a>
<h4 class="text-center py-3">Status: {{$poll->status}}</h4>
@if (session('success'))
<div class="alert alert-success text-center">
    {{session('success')}}
</div>
@elseif (session('warning'))
<div class="alert alert-warning text-center">
    {{session('warning')}}
</div>
@elseif (session('error'))
<div class="alert alert-danger text-center">
    {{session('error')}}
</div>
@endif
<form action="{{route('updateAction')}}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="poll-title" value="{{$poll->title}}" placeholder=" " disabled />
                <label for="poll-title" class="col-form-label">Título</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input type="datetime-local" class="form-control" id="poll-date-start" value="{{$poll->date_start}}" placeholder=" " disabled />
                <label for="poll-date-start" class="col-form-label">Data Ínicio</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input type="datetime-local" class="form-control" id="poll-date-end" value="{{$poll->date_end}}" placeholder=" " disabled />
                <label for="poll-date-end" class="col-form-label">Data Término</label>
            </div>
        </div>
    </div>
</form>
<div class="row">
    <h4 class="text-center py-5">Opções</h4>
    <hr />
    <div class="col-md-4 text-center pb-2">
        <form action="{{route('viewAction')}}" method="POST">
            @csrf
            <input type="hidden" name="poll-id" value="{{$poll->id}}">
            <input type="hidden" name="poll-op-1" value="1">
            <button type="submit" class="btn btn-secondary">{{$poll->option1}} - Votos: {{$votes->option1}}</button>
        </form>
    </div>
    <div class="col-md-4 text-center pb-2">
        <form action="{{route('viewAction')}}" method="POST">
            @csrf
            <input type="hidden" name="poll-id" value="{{$poll->id}}">
            <input type="hidden" name="poll-op-2" value="2">
            <button type="submit" class="btn btn-secondary">{{$poll->option2}} - Votos: {{$votes->option2}}</button>
        </form>
    </div>
    <div class="col-md-4 text-center pb-2">
        <form action="{{route('viewAction')}}" method="POST">
            @csrf
            <input type="hidden" name="poll-id" value="{{$poll->id}}">
            <input type="hidden" name="poll-op-3" value="3">
            <button type="submit" class="btn btn-secondary">{{$poll->option3}} - Votos: {{$votes->option3}}</button>
        </form>
    </div>
</div>
@endsection