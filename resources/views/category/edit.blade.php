@extends('layouts.v_template')
@section("content")

        <div class="container col-lg-8 mt-4">
            <h2>Edit Kategori</h2>
            <form method="POST" action="{{ (isset($category))?route('categories.update', $category->id):route('categories.store')  }}">
            @csrf
            @method('PUT')
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" value="{{old('nama', $category->nama)}}">
                </div>
                <a href="{{ url('categories') }}" class="btn btn-secondary">
                    <i class="fa fa-plus"></i>Back
                </a>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>

@endsection
