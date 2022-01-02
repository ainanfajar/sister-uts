@extends('layouts.v_template')
@section("content")

        <div class="container col-lg-8 mt-4">
            <h2>Edit Artikel</h2>
            <form method="POST" action="{{ (isset($artikel))?route('artikels.update', $artikel->id):route('artikels.store') }}">
            @csrf
            @method('PUT')
                <input type="hidden" name="id" id="id" value="">
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" class="form-control" name="judul" value="{{old('judul', $artikel->judul)}}">
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    {{-- <input type="text" class="form-control" name="nama" value="{{old('nama', $artikel->category->nama)}}"> --}}
                    <select name="nama" class="form-control">
                        @foreach ($categories as $item)
                            <option value="{{$item->id}}" >{{$item->nama}}</option>
                            {{-- @if(old('item',$artikel->kategori_id)==$category->id) selected="selected" @endif --}}
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Isi Artikel</label>
                    <textarea class="form-control" rows="4" name="isi">{{old('isi', $artikel->isi)}}</textarea>
                </div>
                <a href="{{ url('artikels') }}" class="btn btn-secondary">
                    <i class="fa fa-plus"></i>Back
                </a>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>

@endsection
