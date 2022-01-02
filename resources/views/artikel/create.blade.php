@extends('layouts.v_template')
@section("content")

        <div class="container col-lg-8 mt-4">
        <div class="card">
            <div class="card-header">
            <h2>Create Artikel</h2>
            <form method="POST" action="{{ url('artikels') }}">
            @csrf
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" class="form-control" name="judul" value="">
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    {{-- <input type="text" class="form-control" name="nama" value=""> --}}
                    <div>
                        <select name="nama" class="form-control">
                            @foreach ($categories as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Isi Artikel</label>
                    <textarea class="form-control" rows="4" name="isi"></textarea>
                </div>
                <a href="{{ url('artikels') }}" class="btn btn-secondary">
                    <i class="fa fa-plus"></i>Back
                </a>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
        </div>

@endsection
