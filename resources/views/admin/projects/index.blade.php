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
            <th scope="col"><a href="{{route('admin.projects.orderby', ['id', $direction])}}">ID</a></th>
            <th scope="col"><a href="{{route('admin.projects.orderby', ['name', $direction])}}">Nome Progetto</a></th>
            <th scope="col">Tecnologie</th>
            <th scope="col"><a href="{{route('admin.projects.orderby', ['client_name', $direction])}}">Nome Cliente</a></th>
            <!--<th scope="col"><a href="{{route('admin.projects.orderby', ['summary', $direction])}}">Descrizione</a></th>-->
            <th scope="col">Azioni</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($projects as $project)
          <tr>
            <td>{{$project->id}}</td>
            <td>{{$project->name}} <span class="badge rounded-pill text-bg-info">{{$project->category?->name}}</span>
                </td>
            <td>
                @forelse ($project->technologies as $technology)
                    <span class="badge text-bg-primary">{{$technology->name}}</span>
                @empty
                    - no data -
                @endforelse
            </td>
            <td>{{$project->client_name}}</td>
            <!--<td>{{$project->summary}}</td>-->
            <td class="ft-action-btn">
                <a href="{{route('admin.projects.show', $project)}}" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                <a href="{{route('admin.projects.edit', $project)}}" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></a>
                <form
                onsubmit="return confirm('Confermi l\'eliminazione del post?')"
                action="{{route('admin.projects.destroy', $project)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button href="{{route('admin.projects.edit', $project)}}" type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
      </table>

      <div>
        {{$projects->links()}}
      </div>



</div>
@endsection
