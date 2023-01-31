@extends('layouts.admin')

@section('title')
    | {{$project->name}}
@endsection

@section('content')
<div class="container mt-3">

    <h1 class="my-3">Modifica Progetto {{$project->name}}</h1>

    @if($errors->any())

        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>

    @endif

    <form action="{{route('admin.projects.update',$project)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name', $project->name)}}" placeholder="Titolo">
            @error('name')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="client_name" class="form-label">Nome cliente</label>
            <input type="text" class="form-control @error('client_name') is-invalid @enderror" id="client_name" name="client_name" value="{{old('client_name',$project->client_name)}}" placeholder="Nome cliente">
            @error('client_name')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="client_name" class="form-label">Categoria</label>
            <select class="form-select" name="category_id" >
                <option value="">Selezionare una categoria</option>
                @foreach ($categories as $category)
                <option
                    @if ($category->id ==old('category_id', $project->category?->id))selected @endif
                     value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>


        {{-- TAGS --}}
        <div class="mb-3">
            <p for="client_name" class="form-label">Categoria</p>
            @foreach ($technologies as $technology)
                <input
                type="checkbox"
                id="technology{{$loop->iteration}}"
                name="technologies[]"
                value="{{$technology->id}}"
                @if (!$errors->all() && $project->technologies->contains($technology))
                    checked
                @elseif (!$errors->all() && in_array($technology->id, old('technologies',[])))
                    checked
                @endif>
                <label class="me-2" for="technology{{$loop->iteration}}">{{$technology->name}}</label>
            @endforeach
        </div>


        <div class="mb-3">
            <label for="cover_image" class="form-label">URL Immagine</label>
            <input type="text" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image" value="{{old('cover_image',$project->cover_image)}}" placeholder="URL IMMAGINE">
            @error('cover_image')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Descrizione</label>
            <textarea class="form-control @error('summary') is-invalid @enderror" id="summary" rows="3" placeholder="Descrizione" name="summary">{{old('summary',$project->summary)}}</textarea>
            @error('summary')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
        </div>
        <button class="btn btn-success" type="submit">Invio</button>
    </form>


</div>
@endsection
