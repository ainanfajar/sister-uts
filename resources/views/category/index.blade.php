@extends('layouts.v_template')
@section("content")
        
        <div class="container col-lg-8 mt-3">
        <div class="card">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
            <div class="card-header">
                <div class="float-left">
                    <h2><strong>Data Kategori</strong></h2>
                </div>  
                <div class="float-right">
                <a href="{{ url('categories/create') }}" class="btn btn-success">
                    <i class="fa fa-plus">Add</i>
                </a>
            </div>  
            </div>
            
            
            <div class="card-body table-responsive">
                <table class="table table-hover mt-2">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Kategori</th>
                            <th scope="col">Opsi</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $item)
                        <tr>
                            <td scope="row">{{$loop->iteration}}</td>
                            <td scope="row">{{$item->nama}}</td>
                            <td scope="row">
                                <a href="{{route('categories.edit', $item->id)}}">
                                    <button class="btn btn-link">Edit</button>
                                </a>
                            </td>
                            <td scope="row">
                                <form action="{{url('categories/'.$item->id)}}" method="POST" onsubmit="return confirm('Yakin hapus data?')">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-link">Delete</button>
                                </form>
                            </td>
                        </tr>    
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @endsection
