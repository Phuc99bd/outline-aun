@extends('layouts.admin')

@section('title')
    {{$title}}
@endsection
@section('content')
<script src="{{ asset('api/faculty.js') }}"> </script>

<div class="app-main__outer">
                    <div class="app-main__inner">
<div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-header"> Quản lý Khoa
                                        <div class="btn-actions-pane-right">
                                            <div role="group" class="btn-group-sm btn-group">
                                                <button class="active btn btn-faculty-show-create" data-toggle="modal" data-target="#bd-faculty-create"> Create </button>
                                                <!-- <button class="btn btn-focus">All Month                                             
                                                </button> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Tên khoa</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody class="faculty-body">
                                            @foreach($faculties as $faculty)
                                            <tr data-id={{ $faculty ->id}}>
                                                <td class="text-center text-muted">#{{ $faculty->id }}</td>
                                                <td>
                                                    {{ $faculty->title }}
                                                </td>
                                                <td class="text-center">
                                                     <button type="button" data-toggle="modal" data-target="#bd-faculty-update" class="btn btn-primary btn-sm btn-faculty-detail" data-id={{ $faculty-> id }}>Edit</button>
                                                     <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger btn-faculty-delete" data-id={{ $faculty-> id }}><i class="pe-7s-trash btn-icon-wrapper"> </i></button>
                                                </td>
                                            </tr>
                                            @endforeach
                                            
                                           
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-block text-center card-footer">
                                    {{ $faculties }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>
                    
@endsection