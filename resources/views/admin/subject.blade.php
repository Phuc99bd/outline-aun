@extends('layouts.admin')

@section('title')
    {{$title}}
@endsection

@section('content')
<script src="{{ asset('api/subject.js') }}"> </script>

<div class="app-main__outer">
                    <div class="app-main__inner">
<div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-header"> Subjects
                                        <div class="btn-actions-pane-right">
                                            <div role="group" class="btn-group-sm btn-group">
                                                <button class="active btn btn-subject-show-create" data-toggle="modal" data-target="#bd-subject-create"> Create </button>
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
                                                <th>Tên môn học - VI</th>
                                                <th>Tên môn học - EN</th>
                                                <th>Mã môn học</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody class="subject-body">
                                            @foreach($subjects as $subject)
                                            <tr data-id={{ $subject->id}}>
                                                <td class="text-center text-muted">#{{ $subject->id }}</td>
                                                <td>
                                                    {{ $subject->title }}
                                                </td>
                                                <td>
                                                    {{ $subject->title_en }}
                                                </td>
                                                <td>
                                                    {{ $subject->subject_code }}
                                                </td>
                                                <td class="text-center">
                                                    <div class="badge badge-warning">@if($subject->status == 0)
                                                        INACTIVE
                                                    @elseif($subject->status == 1)
                                                        ACTIVE
                                                    @else
                                                        PENDING
                                                    @endif
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                     <button type="button" data-toggle="modal" data-target="#bd-subject-update" class="btn btn-primary btn-sm btn-subject-detail" data-id={{ $subject-> id }}>Edit</button>
                                                     <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger btn-subject-delete" data-id={{ $subject-> id }}><i class="pe-7s-trash btn-icon-wrapper"> </i></button>
                                                </td>
                                            </tr>
                                            @endforeach
                                            
                                           
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-block text-center card-footer">
                                    {{ $subjects }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>
                        

@endsection