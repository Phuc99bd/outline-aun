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
                    <div class="card-header">
                         {{ $outline->title }}
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                @foreach($outline->outlineDetails as $detail)
                    {!! $detail->content !!}
                @endforeach
            </div>
        </div>
    </div>
</div>


@endsection