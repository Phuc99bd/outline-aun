@extends('layouts.admin')


@section('content')
<script src="{{ asset('api/setting.js') }}"> </script>

<div class="app-main__outer">
    <div class="app-main__inner">
    <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                        <i class="pe-7s-car icon-gradient bg-mean-fruit">
                                        </i>
                                    </div>
                                    <div> Cài đặt chung
                                        <div class="page-title-subheading">This is an example dashboard created using build-in elements and components.
                                        </div>
                                    </div>
                                </div>

                                 </div>
                        </div>
        <div class="row">
        @foreach($settings as $setting)
        <div class="col-md-3 col-xl-3 m-1" style="text-align: center;">
            <button class="btn btn-danger form-control btn-setting-detail" data-toggle="modal" data-target="#bd-setting-update" data-id={{ $setting->id }}>
             {{ $setting->title }}

            </button>
                                       
                            </div>
        
        @endforeach
                         

        </div>
    </div>
</div>
                    
@endsection