@extends('main')

@section('title', 'Edulevel')

@section('breadcrumbs')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Edulevel</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="#">Edulevel</a></li>
                    <li class="active">Data</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        {{-- @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
             </div>
        @endif --}}
        {{-- <hr class="mb-auto h-25 d-inline-block"> --}}
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <strong>Data Jenjang</strong>
                </div>
                <div class="pull-right">
                    <a href="{{ url('edulevel/add') }}" class="btn btn-success btn-sm">
                        <i class="fa fa-plus"></i>Add
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Aksi</th>
                        </tr>  
                    </thead>
                    <tbody>
                        @foreach ($edulevel as $key => $item)
                            <tr>
                                <td class="text-center">{{ $edulevel-> firstItem() + $key}}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->desc }}</td>
                                <td class="text-center">
                                    <a href="{{ url('edulevel/edit/' .$item->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="{{ url('edulevel/' .$item->id) }}" method=post class="d-inline" onsubmit="return confirm('Yakin mau dihapus?')">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pull-right">
                    {{ $edulevel->links() }}   
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection