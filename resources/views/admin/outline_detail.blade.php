@extends('layouts.admin')


@section('content')
<script src="{{ asset('api/outline_detail.js') }}"> </script>

<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header"> Outline Details
                        <div class="btn-actions-pane-right">
                            <div role="group" class="btn-group-sm btn-group">
                                <button class="active btn btn-outline-detail-show-create" data-toggle="modal"
                                    data-target="#bd-outline-detail-create"> Create </button>
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
                                    <th>Tên cấu trúc</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="outline-body">
                                 @foreach($outlineDetails as $outlineoutlineDetail)

                                <tr data-id={{ $outlineoutlineDetail->id}}>
                                    <td class="text-center text-muted">#{{ $outlineoutlineDetail->id }}</td>
                                    <td>
                                        {{ $outlineoutlineDetail->outlineStructure->title }}
                                    </td>
                                    <td class="text-center">
                                        <button
                                                    class="btn btn-primary btn-sm btn-detail-outlineDetail"
                                                    data-id={{ $outlineoutlineDetail-> id }}>Detail</button>

                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-block text-center card-footer">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection