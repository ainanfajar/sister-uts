@extends('layouts.v_template')
@section("content")

        <div class="container col-lg-8 mt-4">
        <div class="card">
            <div class="card-header">
            <h2>Create Kategori</h2>
            <form method="POST" action="{{ url('categories') }}">
            @csrf
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" value="">
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
        </div>

@endsection
