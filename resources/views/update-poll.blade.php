@extends('template.layout')

@section('title', 'Atualizar Enquete')

@section('container')
<a href="{{route('index')}}" class="btn btn-primary mb-2">Todas as Enquetes</a>
@if (session('success'))
<div class="alert alert-success text-center">
    {{ session('success') }}
</div>
@endif
<h4 class="text-center py-3">Status: {{$poll->status}}</h4>
<form action="{{route('updateAction')}}" method="POST">
    @csrf
    <div class="modal-body">
        <input type="hidden" name="poll-id" value="{{$poll->id}}">
        <div class="row">
            <div class="col-md-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="poll-title" name="poll-title" value="{{$poll->title}}" placeholder=" " minlength="5" required />
                    @error('poll-title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <label for="poll-title" class="col-form-label">Título</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="datetime-local" class="form-control" id="poll-date-start" name="poll-date-start" value="{{$poll->date_start}}" placeholder=" " required />
                    @error('poll-date-start')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <label for="poll-date-start" class="col-form-label">Data Início</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="datetime-local" class="form-control" id="poll-date-end" name="poll-date-end" value="{{$poll->date_end}}" placeholder=" " required />
                    @error('poll-date-end')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <label for="poll-date-end" class="col-form-label">Data Término</label>
                </div>
            </div>
        </div>
        <h4 class="text-center py-3">Opções</h4>
        <div class="row">
            <div class="col-md-4">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="poll-op-1" name="poll-op-1" value="{{$poll->option1}}" placeholder=" " minlength="1" required />
                    @error('poll-op-1')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <label for="poll-op-1" class="col-form-label">Opção 1</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="poll-op-2" name="poll-op-2" value="{{$poll->option1}}" placeholder=" " minlength="1" required />
                    @error('poll-op-2')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <label for="poll-op-2" class="col-form-label">Opção 2</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="poll-op-3" name="poll-op-3" value="{{$poll->option1}}" placeholder=" " minlength="1" required />
                    @error('poll-op-3')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <label for="poll-op-3" class="col-form-label">Opção 3</label>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </div>
</form>
@endsection