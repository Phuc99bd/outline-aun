@extends('layouts.admin')

@section('title')
    {{$title}}
@endsection
@section('content')
<script src="{{ asset('api/outline.js') }}"> </script>

<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header"> Outlines
                        <div class="btn-actions-pane-right">
                            <div role="group" class="btn-group-sm btn-group">
                                <button class="active btn btn-outline-show-create" data-toggle="modal"
                                    data-target="#bd-outline-create"> Create </button>
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
                                           <button
                                            class="mr-2 btn-icon btn-icon-only btn btn-outline-danger btn-outline-detail" data-toggle="modal"
                                             data-target="#bd-outline-edit"
                                            data-id={{ $outline-> id }}>Edit</button>
                                        <button
                                            class="mr-2 btn-icon btn-icon-only btn btn-outline-danger btn-outline-delete"
                                            data-id={{ $outline-> id }}><i class="pe-7s-trash btn-icon-wrapper">
                                            </i></button>
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
                                            data-id={{ $outline-> id }}>Clone up version</button>

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