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
                    <h2><strong>Detail Kategori</strong></h2>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover mt-2">
                    <tbody>
                        <tr>
                            <th>Nama Kategori</th>
                            <td>{{$category->nama}}</td>
                        <tr>
                            <th>Created at</th>
                            <td>{{$category->created_at}}</td>
                        </tr>
                        <tr>
                            <th>Updated at</th>
                            <td>{{$category->updated_at}}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="float-right">
                <a href="{{ url('categories') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i>Back
                </a>
            </div>  
            </div>
        </div>
        </div>
        </div>

        @endsection