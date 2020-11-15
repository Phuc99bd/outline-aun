@extends('layouts.admin')

@section('title')
    {{$title}}
@endsection
@section('content')
<script src="{{ asset('api/elo.js') }}"> </script>

<div class="app-main__outer">
                    <div class="app-main__inner">
<div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-header"> Elos
                                        <div class="btn-actions-pane-right">
                                            <div role="group" class="btn-group-sm btn-group">
                                                <button class="active btn btn-subject-show-create" data-toggle="modal" data-target="#bd-elo-create"> Create </button>
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
                                                <th>Tên Elo</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody class="elo-body">
                                            @foreach($elos as $elo)
                                            <tr data-id={{ $elo ->id}}>
                                                <td class="text-center text-muted">#{{ $elo->id }}</td>
                                                <td>
                                                    {{ $elo->title }}
                                                </td>
                                                <td class="text-center">
                                                     <button type="button" data-toggle="modal" data-target="#bd-elo-update" class="btn btn-primary btn-sm btn-elo-detail" data-id={{ $elo-> id }}>Edit</button>
                                                     <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger btn-elo-delete" data-id={{ $elo-> id }}><i class="pe-7s-trash btn-icon-wrapper"> </i></button>
                                                </td>
                                            </tr>
                                            @endforeach
                                            
                                           
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-block text-center card-footer">
                                    {{ $elos }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>
                    
@endsection