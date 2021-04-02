@extends('layouts.admin')

@section('title')
    {{$title}}
@endsection
@section('content')
<script src="{{ asset('api/outline.js') }}"> </script>

<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="row">
            @if($user->role == 0)
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header"> Tasks
                       
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Tên đề cương cần làm</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody class="task-body">
                                @foreach($outlineNeedWork as $outline)
                                <tr data-id={{ $outline->id}}>
                                    <td class="text-center text-muted">#{{ $outline->id }}</td>
                                    <td>
                                        {{ $outline->subject->title }}
                                    </td>
                                    <td>
                                        {{ $outline->status === 0 ? "Chờ tiến hành" : ($outline->status === 2 ? "Đang trong tiến trình" : "Hoàn thành")  }}
                                    </td>
                                    <td>
                                    <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger btn-todo-task" data-subjectId="{{ $outline->outline_assign_id }}" data-id="{{ $user->id }}" data-title="{{ $outline->subject->title }}" data-taskid="{{ $outline->id }}" style="display: {{ ($outline->status === 0) ? 'block' : 'none' }}">
                                        -> Processing
                                        </button>
                                    <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger btn-processing-task" data-taskid="{{ $outline->id }}"
                                    style="display: {{ ($outline->status === 2) ? 'block' : 'none' }}">
                                        -> Done
                                        </button>
                                    
                                    <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger btn-done-task" data-taskid="{{ $outline->id }}"
                                    style="display: {{ ($outline->status === 1) ? 'block' : 'none' }}">
                                        -> Processing
                                        </button>
                                    </td>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                    <div class="d-block text-center card-footer">
                        {{ $outlines }}
                    </div>
                </div>
            </div>
            @endif
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header"> Outlines
                        <!-- <div class="btn-actions-pane-right">
                            <div role="group" class="btn-group-sm btn-group">
                                <button class="active btn btn-outline-show-create" data-toggle="modal"
                                    data-target="#bd-outline-create"> Create </button> -->
                                <!-- <button class="btn btn-focus">All Month                                             
                                                </button> -->
                            <!-- </div> -->
                        <!-- </div> -->
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover outline-body">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Tên đề cương</th>
                                    <th>Phiên bản</th>
                                    <th>Môn học</th>
                                    <th>Loại đề cương</th>
                                    <th class="text-center">Actions</th>
                                    <th class="text-center">Export</th>
                                    <th class="text-center">Up version</th>
                                </tr>
                            </thead>
                            <tbody class="outline-body">
                                @if(count($outlines) === 0)
                                    <tr>
                                        <td class="text-center text-muted" colspan="8">
                                            No data
                                        </td>
                                    </tr>
                                @endif
                                @foreach($outlines as $outline)
                                <tr data-id={{ $outline->id}}>
                                    <td class="text-center text-muted">#{{ $outline->id }}</td>
                                    <td>
                                        {{ $outline->title }}
                                    </td>
                                   
                                    <td>
                                        {{ $outline->version }}
                                    </td>
                                    <td>
                                        {{ $outline->subject->title }}
                                    </td>
                                    <td>
                                        {{ ($outline->is_practice == 0) ? "Lý thuyết" : "Thực hành"}}
                                    </td>
                                    <td class="text-center">
                 
                                            <a
                                            class="btn btn-primary btn-sm btn-outline-export"
                                           href="/outline/detail?id={{ $outline->id }}">Detail</a>
                                           @if($user->role === 1)
                                           <button
                                            class="mr-2 btn-icon btn-icon-only btn btn-outline-danger btn-outline-detail" data-toggle="modal"
                                             data-target="#bd-outline-edit"
                                            data-id={{ $outline-> id }}>Edit</button>
                                            @endif
                                            @if($outline->version_outline > 1 || $user->role == 1)
                                                <button
                                                class="mr-2 btn-icon btn-icon-only btn btn-outline-danger btn-outline-delete"
                                                data-id={{ $outline-> id }}><i class="pe-7s-trash btn-icon-wrapper">
                                                </i></button>
                                            @endif
                                    </td>
                                    <td class="text-center">
                                            <a
                                            class="btn btn-primary btn-sm btn-outline-preview"
                                           href="/outline/exportPdf?id={{ $outline->id }}">Export word</a>
                                        <a
                                            class="btn btn-primary btn-sm btn-outline-preview"
                                           href="/preview?id={{ $outline->id }}">Preview</a>
                                        

                                    </td>
                                    <td class="text-center">
                                        <button type="button" data-toggle="modal" data-target="#bd-outline-update"
                                            class="btn btn-primary btn-sm btn-outline-version"
                                            data-id={{ $outline-> id }}>Upgrade version</button>

                                    </td>
                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                    <div class="d-block text-center card-footer">
                        {{ $outlines }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection