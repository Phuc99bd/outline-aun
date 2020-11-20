@extends('layouts.admin')

@section('title')
    {{$title}}
@endsection
@section('content')
<div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                        <i class="pe-7s-car icon-gradient bg-mean-fruit">
                                        </i>
                                    </div>
                                    <div>Analytics Dashboard
                                        <div class="page-title-subheading">This is an example dashboard created using build-in elements and components.
                                        </div>
                                    </div>
                                </div>
                                <div class="page-title-actions">
                                   
                                    
                                </div>    </div>
                        </div>       
                        <!-- Start report total -->
                             <div class="row">
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-midnight-bloom">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Tổng số đề cương</div>
                                            <div class="widget-subheading">Total outline</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span>{{ $countOutline }}</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-arielle-smile">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Số lượng người dùng</div>
                                            <div class="widget-subheading">quantity</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span>{{ $countUser}}</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-grow-early">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Số lượng phiên bản đề cương</div>
                                            <div class="widget-subheading">Total outline version</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span>{{$countVersion}}</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-premium-dark">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Products Sold</div>
                                            <div class="widget-subheading">Revenue streams</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-warning"><span>$14M</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            <div style="width:100%;">
                        <canvas id="line-chart" ></canvas>
                            </div>
                            </div>
                      

                            <div class="col-md-6">
                                <div class="main-card mb-3 card">
                                    <div class="card-header">Active Users
                                        <div class="btn-actions-pane-right">
                                            <div role="group" class="btn-group-sm btn-group">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Name</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($users as $us)
                                            <tr>
                                                <td class="text-center text-muted">#{{ $us->id }}</td>
                                                <td>
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <div class="widget-content-left">
                                                                    <img width="40" class="rounded-circle" src="/admin/tdmu-icon-ldpi.png" alt="">
                                                                </div>
                                                            </div>
                                                            <div class="widget-content-left flex2">
                                                                <div class="widget-heading">#{{ $us->name }}</div>
                                                                <div class="widget-subheading opacity-7">Etiam sit amet orci eget</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="badge badge-success">Completed</div>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"> </script>
<script src="https://momentjs.com/downloads/moment.js"> </script>


                <script>
                     $.ajax({
            url: `/api/v1/outline/chart`,
            type: "GET",
            success: ({data})=>{

                const dataChart = { users: [] , outlines: [] };
                let now = moment()

                let dataLabels = [];
                for(let i=0 ;i < 5 ;i++){
                    dataLabels = [now.format("DD/MM/YY"),...dataLabels];
                    now.set("date",now.date() - 5);

                    let countUser = 0;
                    let countO = 0;
                    data.users.map(e=>{
                        if(now.diff(e.created_at, 'days') >= -5 && now.diff(e.created_at, 'days') < 0){
                            countUser+= 1;
                        }
                    })
                    data.outlines.map(e=>{
                        console.log(e ,now.diff(e.created_at, 'days') >= -5  && now.diff(e.created_at, 'days') < 0);

                        if(now.diff(e.created_at, 'days') >= -5 && now.diff(e.created_at, 'days') < 0){
                            countO += 1;
                        }
                    })
                    dataChart.users = [countUser, ...dataChart.users]
                    dataChart.outlines = [countO, ...dataChart.outlines]
                }
                                new Chart(document.getElementById("line-chart"), {
                type: 'line',
                data: {
                    labels: dataLabels,
                    datasets: [{ 
                        data: dataChart.users,
                        label: "Amount User",
                        borderColor: "#3e95cd",
                        fill: false
                    }, { 
                        data: dataChart.outlines,
                        label: "Amonut Outline",
                        borderColor: "#8e5ea2",
                        fill: false
                    }
                    ]
                },
                options: {
                    title: {
                    display: true,
                    text: 'World population per region (in millions)'
                    }
                }
                });
            },
            error: (err)=>{
                console.log(err);
            }
        })
        

</script>
@endsection
