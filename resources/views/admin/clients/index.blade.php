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
        <div class="ms-auto">
            @include("admin.comps.messages")
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="product-count d-flex align-items-center gap-3 gap-lg-4 mb-4 fw-bold flex-wrap font-text1">
        <a href="/admin/clients?search={{ $search }}"><span class="me-1">All</span><span class="text-secondary">({{ $count }})</span></a>
        <a href="/admin/clients?target=verified&search={{ $search }}"><span class="me-1">Verified</span><span class="text-secondary">({{ $verifiedCount }})</span></a>
        <a href="/admin/clients?target=subscribed&search={{ $search }}"><span class="me-1">Subscribed</span><span class="text-secondary">({{ $subCount }})</span></a>
    </div>

<div class="row g-3">
<div class="col-auto">
    <form  type="POST" action="/admin/clients">
        <div class="input-group">
            <div class="position-relative">
                <input value="{{ $search }}" name="search" style="border-top-right-radius:0;border-bottom-right-radius:0;" class="form-control px-5" type="text" placeholder="Search Customers">
                <span class="material-symbols-outlined position-absolute ms-3 translate-middle-y start-0 top-50 fs-5">search</span>
            </div>
            <button class="btn btn-primary d-inline-block">Search</button>
        </div>
    </form>

</div>
<div class="col-auto flex-grow-1 overflow-auto">

</div>
<div class="col-auto">
<div class="d-flex align-items-center gap-2 justify-content-lg-end">
    {{-- <button class="btn btn-primary px-4"><i class="bi bi-plus-lg me-2"></i>Add Customers</button> --}}
    {{-- <button type="button" class="btn btn-light split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">
        Action <span class="visually-hidden">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	
        <a class="dropdown-item" href="javascript:;">Action</a>
        <a class="dropdown-item" href="javascript:;">Another action</a>
        <a class="dropdown-item" href="javascript:;">Something else here</a>
        <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
    </div> --}}
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
            <th>Client</th>
            <th>Email</th>
            <th>Verified</th>
            <th>Subscription</th>
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
                                <img src="{{ $base }}/avatars/{{ $client["avatar"] }}" class="rounded-circle profile-avatar" width="40" height="40" alt="">
                            </div>
                            <p class="mb-0 customer-name fw-bold">{{ $client["name"] }}</p>
                        </a>
                    </td>
                    <td>
                        <a href="javascript:;" class="font-text1">{{ $client["email"] }}</a>
                    </td>
                    <td>
                        @if(isset($client["email_verified_at"]))
                            <span class="lable-table bg-success-subtle text-success rounded border border-success-subtle font-text2 fw-bold">
                                Verified<i class="bi bi-check2 ms-2"></i>
                            </span>
                        @else
                            <span class="lable-table bg-danger-subtle text-danger rounded border border-danger-subtle font-text2 fw-bold">
                                Not Verified<i class="bi bi-x-lg ms-2"></i>
                            </span>
                        @endif
                    </td>
                    <td>
                        @php
                            $sub = $client["subscription"];
                            
                        @endphp
                        @if(isset($sub))
                            @php
                                $type = (function($sub) {switch($sub) {
                                    case "mega_fan": return "warning";
                                    case "fan": return "info";
                                }})($sub["type"]);
                            @endphp
                            <span class="lable-table bg-{{ $type }}-subtle text-{{ $type }} rounded border border-{{ $type }}-subtle font-text2 fw-bold">
                                {{ str_replace("_", " ", $sub["type"]) }} @if($type === "info")<i class="bi bi-check2 ms-2"></i>@else<i class="bi bi-check2-all ms-2"></i>@endif
                            </span>
                        @else
                            <span class="lable-table bg-danger-subtle text-danger rounded border border-danger-subtle font-text2 fw-bold">
                                Not Subscribed<i class="bi bi-x-lg ms-2"></i>
                            </span>
                        @endif
                    </td>
                    <td>{{ $client["created_at"] }}</td>
                    <td>
                        <span data-client-id="{{ $client["id"] }}" data-bs-toggle="modal" data-bs-target="#DeleteModal" class="client-delete-btn btn btn-outline-danger material-symbols-outlined p-1" style="width: 36px" >
                            delete
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="javascript:;" aria-label="Previous">	<span aria-hidden="true">«</span>
            </a>
            </li>
            @for ($p = 1; $p < 1 + $count / $max; $p++)
                <li class="page-item @if($page == ($p - 1)) active @endif">
                    <a class="page-link" href="/admin/clients?page={{ $p - 1 }}&max={{ $max }}&search={{ $search }}">{{ $p }}</a>
                </li>
            @endfor
            <li class="page-item">
                <a class="page-link" href="javascript:;" aria-label="Next">	<span aria-hidden="true">»</span>
            </a>
            </li>
        </ul>
    </div>
</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="DeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Delete Client</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">Are you sure you wants to delete this client ?</div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger">
                <a id="DeleteModalBtn" style="color: inherit;">Delete</a>
            </button>
        </div>
        </div>
    </div>
</div>
@endsection

@section("scripts")
    <script>
        $(document).ready(function () {
            $(".client-delete-btn").on("click", function() {
                $("#DeleteModalBtn").attr("href", "/admin/clients/delete/" + $(this).data("client-id"));
            })
        })
    </script>
@endsection