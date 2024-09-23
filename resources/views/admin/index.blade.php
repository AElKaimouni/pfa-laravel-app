@extends("admin.layouts.app")

@section("title", "Dashboard Page - PFA")

@section('content')
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-xl-4 row-cols-xxl-4">
        <div class="col">
        <div class="card radius-10 border-0 border-start border-primary border-4">
            <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="">
                <p class="mb-1">Month's views</p>
                <h4 class="mb-0 text-primary">{{ $monthViews }}</h4>
                <p style="  margin: 0; color: #198754">+{{ $todayViews }} today</p>
                </div>
                <div class="ms-auto widget-icon bg-primary text-white">
                    <i class="bi bi-basket2-fill"></i>
                </div>
            </div>
            <div class="progress mt-3" style="height: 4.5px;">
                <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            </div>
        </div>
        </div>
        <div class="col">
        <div class="card radius-10 border-0 border-start border-success border-4">
            <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="">
                <p class="mb-1">Month's Revenue</p>
                <h4 class="mb-0 text-success">{{ $monthRevenue }} MAD</h4>
                <p style="  margin: 0; color: #198754">+{{ $todayRevenue }} MAD today</p>
                </div>
                <div class="ms-auto widget-icon bg-success text-white">
                <i class="bi bi-currency-dollar"></i>
                </div>
            </div>
            <div class="progress mt-3" style="height: 4.5px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            </div>
        </div>
        </div>
        <div class="col">
        <div class="card radius-10 border-0 border-start border-danger border-4">
            <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="">
                <p class="mb-1">Month's Subscriptions</p>
                <h4 class="mb-0 text-danger">{{ $monthSubs }}</h4>
                <p style="  margin: 0; color: #198754">+{{ $todaySubs }} today</p>
                </div>
                <div class="ms-auto widget-icon bg-danger text-white">
                <i class="bi bi-graph-down-arrow"></i>
                </div>
            </div>
            <div class="progress mt-3" style="height: 4.5px;">
                <div class="progress-bar bg-danger" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            </div>
        </div>
        </div>
        <div class="col">
        <div class="card radius-10 border-0 border-start border-warning border-4">
            <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="">
                <p class="mb-1">Month's new Users</p>
                <h4 class="mb-0 text-warning">{{ $monthUsers }}</h4>
                <p style="  margin: 0; color: #198754">+{{ $todayUsers }} today</p>
                </div>
                <div class="ms-auto widget-icon bg-warning text-dark">
                <i class="bi bi-people-fill"></i>
                </div>
            </div>
            <div class="progress mt-3" style="height: 4.5px;">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            </div>
        </div>
        </div>
        </div><!--end row-->

        
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                <div class="card-header bg-transparent">
                    <div class="d-flex align-items-center">
                        <div class="p-1">
                            <h6 class="mb-0 fw-bold">Yearly Subscribtions Revenue</h6>
                        </div>
                        {{-- <div class="dropdown ms-auto">
                            <button type="button" class="btn-option dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><i class="bi bi-three-dots fs-4"></i>
                            </button>
                            <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:;">Action</a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Another action</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                            </li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div id="chart1"></div>
                </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                <div class="card-header bg-transparent">
                    <div class="d-flex align-items-center">
                        <div class="p-1">
                            <h6 class="mb-0 fw-bold">Subscriptions types</h6>
                        </div>
                        {{-- <div class="dropdown ms-auto">
                            <button type="button" class="btn-option dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><i class="bi bi-three-dots fs-4"></i>
                            </button>
                            <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:;">Action</a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Another action</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                            </li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div id="chart2"></div>
                </div>
                <ul class="list-group list-group-flush mb-0">
                    @php $sum = array_sum($subsTypesCount); @endphp
                    <li class="list-group-item border-top d-flex justify-content-between align-items-center bg-transparent">
                        FAN<span style="background: #1692bb" class="badge rounded-pill">{{ round(100 * $subsTypesCount[0]/max($sum, 1)) }}%</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                        MEGA FAN<span style="background: #dd003f" class="badge  rounded-pill">{{ round(100 * $subsTypesCount[1]/max($sum, 1)) }}%</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                        MEGA FAN (YEAR)<span style="background: #f5b50a" class="badge  rounded-pill">{{ round(100 * $subsTypesCount[2]/max($sum, 1)) }}%</span>
                    </li>
                </ul>
                </div>
            </div>

        </div><!--end row-->


        <div class="row">
            <div class="col-12 col-lg-6 col-xl-4 d-flex">
            <div class="card w-100">
                <div class="card-header bg-transparent">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h6 class="mb-0 fw-bold p-2">Latest Users</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                <div class="team-list">
                    @foreach ($latestClients as $client)
                        <div class="d-flex align-items-center gap-3">
                            <div class="">
                                <img style="object-fit: cover; object-position: center" src="{{ $base }}/avatars/{{ $client["avatar"] }}" alt="" width="50" height="50" class="rounded-circle">
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1 fw-bold">{{ $client["name"] }}</h6>
                                @if($client->hasValidSubscription())
                                    <span class="badge bg-success bg-success-subtle text-success border border-opacity-25 border-success">Subscribed</span>
                                @else
                                    <span class="badge bg-danger bg-danger-subtle text-danger border border-opacity-25 border-success">Not Subscribed</span>
                                @endif
                            </div>
                            {{-- <div class="">
                                <button class="btn btn-outline-primary rounded-5 btn-sm px-3">Add</button>
                            </div> --}}
                        </div>
                        @if(!$loop->last) <hr> @endif
                    @endforeach
                </div>
                </div>
            </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-4 d-flex">
            <div class="card w-100">
                <div class="card-header bg-transparent">
                <div class="d-flex align-items-center">
                    <div class="">
                        <h6 class="mb-0 fw-bold p-2">Most populare Genres</h6>
                    </div>
                </div>
                </div>
                <div class="card-body">
                    <div class="team-list">
                        @foreach ($topGenres as $genre)
                            <div class="d-flex align-items-center gap-3 border-start border-@switch($loop->index)
                                        @case(0)success @break
                                        @case(1)danger @break
                                        @case(2)primary @break
                                        @case(3)warning @break
                                        @case(4)info @break
                                    @endswitch border-4 border-0 px-2 py-1">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 fw-bold">{{ $genre->name }}</h6>
                                    <span class="">{{ $genre->count }} views</span>
                                    </div>
                                    <div class="form-check form-switch form-check-success border-0">
                                    
                                </div>
                            </div>
                            @if(!$loop->last) <hr> @endif
                        @endforeach
                    </div>
                </div>
            </div>
            </div>
            <div class="col-12 col-lg-12 col-xl-4 d-flex">
            <div class="card w-100">
                <div class="card-header bg-transparent">
                    <div class="d-flex align-items-center">
                        <div class="">
                        <h6 class="mb-0 fw-bold p-2">Most Populare Shows</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="team-list">
                        
                        @foreach ($topShows as $show)
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ $base }}/posters/{{ $show->poster }}" alt="" width="50">
                                <div class="flex-grow-1">
                                    <a href="/admin/shows/edit/{{ $show->id }}" class="fw-bold mb-0">{{ $show->title }}</a>
                                    <p class="mb-2">{{ isset($show->count) ? $show->count : 0 }} views</p>
                                    <div class="progress" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: {{ 100*(isset($show->count) ? $show->count : 0)/$topShows[0]->count }}%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            @if(!$loop->last)<hr> @endif
                        @endforeach
                    </div>
                </div>
            </div>
            </div>
        </div><!--end row-->


        <div class="row">
            <div class="col-12 col-lg-12 col-xl-6">
                <div class="card">
                <div class="card-header bg-transparent">
                    <div class="d-flex align-items-center">
                    <div class="">
                        <h6 class="mb-0 fw-bold p-1">Monthly Views</h6>
                    </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="chart3"></div>
                </div>
                </div>
            </div>
            <div class="col-12 col-lg-12 col-xl-6">
                <div class="card">
                <div class="card-header bg-transparent">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h6 class="mb-0 fw-bold p-1">Monthly Users</h6>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <div id="chart4"></div>
                </div>
                </div>
            </div>
        </div><!--end row-->


        <div class="card">
            <div class="card-body">
            <div class="customer-table">
                <div class="table-responsive white-space-nowrap">
                <table class="table align-middle">
                    <thead class="table-light">
                    <tr>
                        <th>
                        <input class="form-check-input" type="checkbox">
                        </th>
                        <th>ID</th>
                        <th>Price</th>
                        <th>Customer</th>
                        <th>Plan</th>
                        <th>Period</th>
                        <th>Date</th>
                        <th>Expire Date</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($latestSubs as $sub)
                            <tr>
                                <td>
                                    <input class="form-check-input" type="checkbox">
                                </td>
                                <td>
                                    <a href="javascript:;">#{{ $sub["id"] }}</a>
                                </td>
                                <td>{{ $sub["amount"] }} MAD</td>
                                <td>
                                    <a class="d-flex align-items-center gap-3" href="javascript:;">
                                        <div class="customer-pic">
                                            <img style="object-fit: cover; object-position: center" src="{{ $base }}/avatars/{{ $sub->user["avatar"] }}" class="rounded-circle" width="40" height="40" alt="">
                                        </div>
                                        <p class="mb-0 customer-name fw-bold">{{ $sub->user["name"] }}</p>
                                    </a>
                                </td>
                                <td>
                                    @if($sub["type"] === "fan")
                                        <span class="lable-table bg-info-subtle text-info rounded border border-info-subtle font-text2 fw-bold">
                                            fan <i class="bi bi-check2 ms-2"></i>
                                        </span>
                                    @else
                                        <span class="lable-table bg-warning-subtle text-warning rounded border border-warning-subtle font-text2 fw-bold">
                                            mega fan <i class="bi bi-check2-all ms-2"></i>
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($sub["amount"] != "499.99")
                                        <span class="lable-table bg-success-subtle text-success rounded border border-success-subtle font-text2 fw-bold">
                                            Monthly <i class="bi bi-check2 ms-2"></i>
                                        </span>
                                    @else
                                        <span class="lable-table bg-primary-subtle text-primary rounded border border-primary-subtle font-text2 fw-bold">
                                            Yearly <i class="bi bi-check2-all ms-2"></i>
                                        </span>
                                    @endif
                                </td>
                                <td>{{ date("j F Y", strtotime($sub["created_at"])) }}</td>
                                <td>{{ date("j F Y", strtotime($sub["expire_date"])) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>
@endsection

@section("scripts")
    <script src="/plugins/apex/apexcharts.min.js"></script>
    <script>
        // chart 1
        var options = {
            series: [{
                name: 'Month Subscribtions Revenue',
                data: @php echo json_encode($yearRevenue); @endphp
            }],
            chart: {
                foreColor: '#9ba7b2',
                height: 330,
                type: 'bar',
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: false
                },
            },
            stroke: {
                width: 0,
                curve: 'smooth'
            },
            plotOptions: {
                bar: {
                    horizontal: !1,
                    columnWidth: "30%",
                    endingShape: "rounded"
                }
            },
            grid: {
                borderColor: 'rgba(255, 255, 255, 0.15)',
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                shade: 'light',
                type: 'vertical',
                shadeIntensity: 0.5,
                gradientToColors: ['#01e195'],
                inverseColors: true,
                opacityFrom: 1,
                opacityTo: 1,
                }
            },
            colors: ['#0d6efd'],
            dataLabels: {
                enabled: false,
                enabledOnSeries: [1]
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            },
        };
        var chart = new ApexCharts(document.querySelector("#chart1"), options);
        chart.render();
        // chart 2
        var options = {
            series: @php echo json_encode($subsTypesCount) @endphp,
            chart: {
                height: 255,
                type: 'donut',
            },
            legend: {
                position: 'bottom',
                show: false,
            },
            plotOptions: {
                pie: {
                    // customScale: 0.8,
                    donut: {
                        size: '80%'
                    }
                }
            },
            colors: [ "#1692bb", "#dd003f", "#f5b50a"],
            dataLabels: {
                enabled: false
            },
            labels: ['Mobile', 'Desktop', 'Tablet'],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        height: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };
        var chart = new ApexCharts(document.querySelector("#chart2"), options);
        chart.render();
        // chart 3
        var options = {
            series: [{
                name: 'Monthly Views',
                data: @php echo json_encode($monthlyViews); @endphp
            }],
            chart: {
                foreColor: '#9ba7b2',
                height: 250,
                type: 'line',
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: false
                },
            },
            stroke: {
                width: 4,
                curve: 'smooth'
            },
            plotOptions: {
                bar: {
                    horizontal: !1,
                    columnWidth: "30%",
                    endingShape: "rounded"
                }
            },
            grid: {
                borderColor: 'rgba(255, 255, 255, 0.15)',
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                shade: 'light',
                type: 'vertical',
                shadeIntensity: 0.5,
                gradientToColors: ['#01e195'],
                inverseColors: true,
                opacityFrom: 1,
                opacityTo: 1,
                }
            },
            colors: ['#0d6efd'],
            dataLabels: {
                enabled: false,
                enabledOnSeries: [1]
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            },
        };
        var chart = new ApexCharts(document.querySelector("#chart3"), options);
        chart.render();
        // chart 4
        var options = {
            series: [{
                name: 'Monthly Users',
                data: @php echo json_encode($monthlyUsers); @endphp
            }],
            chart: {
                foreColor: '#9ba7b2',
                height: 250,
                type: 'area',
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: false
                },
            },
            stroke: {
                width: 3,
                curve: 'smooth'
            },
            plotOptions: {
                bar: {
                    horizontal: !1,
                    columnWidth: "30%",
                    endingShape: "rounded"
                }
            },
            grid: {
                borderColor: 'rgba(255, 255, 255, 0.15)',
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                shade: 'light',
                type: 'vertical',
                shadeIntensity: 0.5,
                gradientToColors: ['#01e195'],
                inverseColors: false,
                opacityFrom: 0.8,
                opacityTo: 0.2,
                }
            },
            colors: ['#0d6efd'],
            dataLabels: {
                enabled: false,
                enabledOnSeries: [1]
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            },
        };
        var chart = new ApexCharts(document.querySelector("#chart4"), options);
        chart.render();
    </script>
@endsection