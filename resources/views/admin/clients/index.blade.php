@extends("admin.layouts.app")

@section("title", "Dashboard Page - PFA")

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Clients</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->


<div class="row g-3">
<div class="col-auto">
<div class="position-relative">
    <input class="form-control px-5" type="search" placeholder="Search Customers">
    <span class="material-symbols-outlined position-absolute ms-3 translate-middle-y start-0 top-50 fs-5">search</span>
</div>
</div>
<div class="col-auto flex-grow-1 overflow-auto">

</div>
<div class="col-auto">
<div class="d-flex align-items-center gap-2 justify-content-lg-end">
    <button class="btn btn-primary px-4"><i class="bi bi-plus-lg me-2"></i>Add Customers</button>
    <button type="button" class="btn btn-light split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">
        Action <span class="visually-hidden">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	
        <a class="dropdown-item" href="javascript:;">Action</a>
        <a class="dropdown-item" href="javascript:;">Another action</a>
        <a class="dropdown-item" href="javascript:;">Something else here</a>
        <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
    </div>
</div>
</div>
</div><!--end row-->

<div class="card mt-4">
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
            <th>Customer</th>
            <th>Email</th>
            <th>Frist Name</th>
            <th>Last Name</th>
            <th>Join Date</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
                <tr>
                    <td>
                        <input class="form-check-input" type="checkbox">
                    </td>
                    <td>{{ $client["id"] }}</td>
                    <td>
                        <a class="d-flex align-items-center gap-3" href="javascript:;">
                            <div class="customer-pic">
                                <img src="/avatars/{{ $client["avatar"] }}" class="rounded-circle" width="40" height="40" alt="">
                            </div>
                            <p class="mb-0 customer-name fw-bold">{{ $client["name"] }}</p>
                        </a>
                    </td>
                    <td>
                        <a href="javascript:;" class="font-text1">{{ $client["email"] }}</a>
                    </td>
                    <td>{{ $client["f_name"] }}</td>
                    <td>{{ $client["l_name"] }}</td>
                    <td>{{ $client["created_at"] }}</td>
                    <td>
                        <span class="btn btn-outline-danger material-symbols-outlined p-1" style="width: 36px" >
                            delete
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</div>
</div>
</div>
@endsection