@extends('layouts.admin')

@section('title')
    | Nuovo Project
@endsection

@section('content')
<div class="container mt-3">

    <h1 class="my-3">Nuovo Project</h1>

    @if($errors->any())

        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>

    @endif

    <form action="{{route('admin.projects.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}" placeholder="Titolo">
            @error('name')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="client_name" class="form-label">Nome cliente</label>
            <input type="text" class="form-control @error('client_name') is-invalid @enderror" id="client_name" name="client_name" value="{{old('client_name')}}" placeholder="Nome cliente">
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
                    @if ($category->id ==old('category_id'))selected @endif
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
                @if (in_array($technology->id, old('technologies',[])))
                    checked
                @endif>
                <label class="me-2" for="technology{{$loop->iteration}}">{{$technology->name}}</label>
            @endforeach
        </div>



        <div class="mb-3">
            <label for="cover_image" class="form-label">Immagine</label>
            <input
            onchange="showimage(event)"
            type="file" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image" value="{{old('cover_image')}}" placeholder="URL IMMAGINE">
            @error('cover_image')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
            <div>
                <img id="output-image" alt="" width="150">
            </div>
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Descrizione</label>
            <textarea class="form-control @error('summary') is-invalid @enderror" id="summary" rows="3" placeholder="Descrizione" name="summary">{{old('summary')}}</textarea>
            @error('summary')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
        </div>
        <button class="btn btn-success" type="submit">Invio</button>
    </form>


</div>

<script>
    function showImage(event){
        //const tagImage = document.getElementById('output-image');
        //tagImage.src = URL.createObjectURL(event.target.files[0]);
    }
</script>


@endsection


