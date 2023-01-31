@extends('layouts.admin')

@section('title')
    | Admin
@endsection

@section('content')
<div class="container mt-3">
    <h1 class="my-3">Gestione Categorie</h1>

    @if (session('message'))
        <div class="alert alert-success" role="alert">
            {{session('message')}}
        </div>
    @endif


    <div class="w-50">
        <form action="{{route('admin.categories.store')}}" method="POST">
            @csrf
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="name" placeholder="Nuova Categoria">
                <button class="btn btn-outline-info" type="submit" id="button-addon2"><i class="fa-solid fa-circle-plus"></i> INVIA</button>

            </div>
        </form>
    </div>

    <table class="table w-50">

        <tr>
            <th scope="col">Categoria</th>
            <th scope="col">Post Count</th>
        </tr>

        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>
                        <form action="{{route('admin.categories.update', $category)}}" method="POST" class="">
                            @csrf
                            @method('patch')
                            <input type="text" value="{{$category->name}}" class="border-0" name="name">
                            <button type="submit" class="btn btn-warning">UPDATE</button>
                            <form
                                onsubmit="return confirm('Confermi l\'eliminazione del post?')"
                                action="{{route('admin.categories.destroy', $category)}}" method="POST" class="">
                                    @csrf
                                    @method('DELETE')
                                    <button href="{{route('admin.categories.destroy', $category)}}" type="submit" class="btn btn-danger">DELETE</button>
                            </form>
                        </form>
                    </td>
                    <td>{{count($category->projects)}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


</div>
@endsection
