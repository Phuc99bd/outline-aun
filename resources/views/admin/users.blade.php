@extends('layouts.admin')

@section('title')
    {{$title}}
@endsection
@section('content')
<script src="{{ asset('api/user.js') }}"> </script>

<div class="app-main__outer">
                    <div class="app-main__inner">
<div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-header"> Manager User
                                        <div class="btn-actions-pane-right">
                                            <div role="group" class="btn-group-sm btn-group">
                                                <button class="btn btn-focus btn-show-import">
                                                    <input type="file" class="btn-import-user" />
                                                    Import user                                             
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Email </th>
                                                <th class="text-center">Full name</th>
                                                <th class="text-center">Faculty</th>
                                                <th class="text-center">History</th>
                                            </tr>
                                            </thead>
                                            <tbody class="elo-body">
                                            @foreach($users as $userDetail)
                                            <tr data-id={{ $userDetail ->id}}>
                                                <td class="text-center text-muted">#{{ $userDetail->id }}</td>
                                                <td class="text-center text-muted">
                                                    {{ $userDetail->email }}
                                                </td>
                                                <td class="text-center text-muted">
                                                    {{ $userDetail->name }}
                                                </td>
                                                <td class="text-center text-muted">
                                                        {{ $userDetail->faculty->title }}
                                                </td>
                                                <td class="text-center">
                                                     <button type="button" data-toggle="modal" data-target="#bd-user-history" class="btn btn-primary btn-sm btn-user-history" data-id={{ $userDetail-> id }}>History</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                            
                                           
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-block text-center card-footer">
                                    {{ $users }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>
                    
@endsection