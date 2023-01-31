@extends('layouts.admin')

@section('title')
    | Admin
@endsection

@section('content')
<div class="container mt-3">
    <h1 class="my-3">Elenco dei progetti</h1>

    @if (session('deleted'))
        <div class="alert alert-danger" role="alert">
            {{session('deleted')}}
        </div>
    @endif



    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Categoria</th>
            <th scope="col">Progetto</th>
          </tr>
        </thead>
        <tbody>
        @forelse ($categories as $category)
        <tr>
            <td>{{$category->name}}</td>
            <td>
                @foreach ($category->projects as $project)
                    <li class="list-unstyled">
                        <a href="{{route('admin.projects.show', $project)}}">{{$project->name}}</a>
                    </li>
                @endforeach
            </td>
        </tr>
        @empty

        @endforelse

        </tbody>
      </table>



</div>
@endsection
