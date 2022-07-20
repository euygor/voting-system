@extends('template.layout')

@section('title', 'Home')

@section('container')
<a href="{{route('create')}}" class="btn btn-primary mb-2">Cadastrar Enquete</a>

@if (session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
@elseif (session('error'))
    <div class="alert alert-danger text-center">
        {{ session('error') }}
    </div>
@endif

@if ($polls->count() > 0)
<div class="table-responsive text-center">
  <table class="table table-hover table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Título</th>
          <th scope="col">Data Ínicio</th>
          <th scope="col">Data Término</th>
          <th scope="col">Status</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($polls as $poll)
        <tr>
          <th scope="row">{{$poll->id}}</th>
          <td>{{$poll->title}}</td>
          <td>{{date('d/m/Y H:i:s', strtotime($poll->date_start))}}</td>
          <td>{{date('d/m/Y H:i:s', strtotime($poll->date_end))}}</td>
          <td>{{$poll->status}}</td>
          <td>
            <a class="btn btn-sm btn-warning my-1" href="{{ route('view', ['id' => $poll->id]) }}">Visualizar</a>
            <a class="btn btn-sm btn-success my-1" href="{{ route('update', ['id' => $poll->id]) }}">Editar</a>
            <a onclick="return confirm('Tem certeza que deseja excluir essa enquete?')" href="{{ route('delete', ['id' => $poll->id]) }}" class="btn btn-sm btn-danger my-1">Excluir</a>
          </td>
        </tr>
        @endforeach
      </tbody>
  </table>
</div>
@else
<div class="alert alert-warning text-center">
    Nenhuma enquete cadastrada.
</div>
@endif
<div class="d-flex justify-content-center">
  {{ $polls->links() }}
</div>
@endsection