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
                    <h2><strong>Detail Artikel</strong></h2>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover mt-2">
                    <tbody>
                        <tr>
                            <th>Judul artikel</th>
                            <td>{{$artikel->judul}}</td>
                        </tr>
                        <tr>
                            <th>Kategori artikel</th>
                            <td>{{$artikel->category->nama}}</td>
                        </tr>
                        <tr>
                            <th>Isi artikel</th>
                            <td>{{$artikel->isi}}</td>
                        </tr>
                        <tr>
                            <th>Created at</th>
                            <td>{{$artikel->created_at}}</td>
                        </tr>
                        <tr>
                            <th>Updated at</th>
                            <td>{{$artikel->updated_at}}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="float-right">
                <a href="{{ url('artikels') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i>Back
                </a>
            </div>  
            </div>
        </div>
        </div>
        </div>

        @endsection