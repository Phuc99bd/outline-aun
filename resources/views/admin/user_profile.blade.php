@extends('layouts.admin')

@section('title')
    {{$title}}
@endsection
@section('content')

<div class="app-main__outer">
                    <div class="app-main__inner">
<div class="row">
                            <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                    <div class="card-header"> User Infomation
                                        <div class="btn-actions-pane-right">
                                            <div role="group" class="btn-group-sm btn-group">
                                                <button class="active btn btn-subject-show-create" data-toggle="modal" data-target="#bd-subject-create"> Create </button>
                                                <!-- <button class="btn btn-focus">All Month                                             
                                                </button> -->
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                <form method="POST" novalidate action="{{ route('update-info') }}">
                                    @csrf
                                    <div class="form-group">
                                    <label for="exampleFormControlInput1">Email address</label>
                                        <input type="email" class="form-control" value="{{ $user-> email }}" placeholder="name@emxaple.com" readonly>
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleFormControlInput1">Full name</label>
                                        <input type="text" class="form-control" name="name" value="{{ $user->name }}"  required >
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger" name="submit">  Update </button>
                                    </div>
                                <form>
                            </div>
                        </div>
                        </div>
                        </div>
                    
@endsection