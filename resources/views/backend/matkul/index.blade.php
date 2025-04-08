@extends('layouts.admin.admin_layout')

@push('top_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
@endpush

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $pageTitle }}</h1>
</div>
<a href="javascript:void(0)" class="btn btn-success btn-icon-split mb-3" id="btn-add-matkul">
    <span class="icon text-white-50">
        <i class="fas fa-plus"></i>
    </span>
    <span class="text">Add new mata kuliah</span>
</a>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data mata kuliah</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Mata Kuliah</th>
                        <th class="text-center">SKS</th>
                        <th class="text-center">Semester</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Mata Kuliah</th>
                        <th class="text-center">SKS</th>
                        <th class="text-center">Semester</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </tfoot>
                <tbody id="table-category">
                    @foreach ($data as $d => $value)
                        <tr>
                            <td class="text-center">{{ $d+1 }}</td>
                            <td>{{ $value->nama }}</td>
                            <td class="text-center">{{ $value->sks }}</td>
                            <td class="text-center">{{ $value->semester }}</td>
                            <td class="text-center">
                                <a href="javascript:void(0)" id="btn-edit-matkul" data-id="{{ $value->id }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                <a href="javascript:void(0)" id="btn-delete-matkul" data-id="{{ $value->id }}" class="btn btn-danger btn-sm"><i class="fas fa-fw fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('backend.matkul.components.modal-create')
@include('backend.matkul.components.modal-edit')
@include('backend.matkul.components.delete-matkul')
@endsection