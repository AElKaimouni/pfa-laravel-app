@extends("admin.layouts.app")

@section("title", "Celebrities - PFA")

@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="javascript:;">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Celebrities</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            @include("admin.comps.messages")
        </div>
    </div>
    <div class="product-count d-flex align-items-center gap-3 gap-lg-4 mb-4 fw-bold flex-wrap font-text1">
        <a href="/admin/celebrities?search={{ $search }}">
            <span class="me-1">All</span>
            <span class="text-secondary">({{ $count }})</span>
        </a>
        <a href="/admin/celebrities?target=director&search={{ $search }}">
            <span class="me-1">Directors</span>
            <span class="text-secondary">({{ $directorsCount }})</span>
        </a>
        <a href="/admin/celebrities?target=writer&search={{ $search }}">
            <span class="me-1">Writers</span>
            <span class="text-secondary">({{ $writersCount }})</span>
        </a>
        <a href="/admin/celebrities?target=actor&search={{ $search }}">
            <span class="me-1">Actors</span>
            <span class="text-secondary">({{ $actorsCount }})</span>
        </a>
    </div>
    <div class="row g-3">
        <div class="col-auto">
            <form  type="POST" action="/admin/celebrities">
                <div class="input-group">
                    <div class="position-relative">
                        <input value="{{ $search }}" name="search" style="border-top-right-radius:0;border-bottom-right-radius:0;" class="form-control px-5" type="text" placeholder="Search Celebrity">
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
                <button class="btn btn-primary px-4">
                    <a style="color: inherit;" href="/admin/celebrities/add">
                        <i class="bi bi-plus-lg me-2"></i>Add Celebrity
                    </a>
                </button>
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-body">
            <div class="product-table">
                <div class="table-responsive white-space-nowrap">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>
                                    <input class="form-check-input" type="checkbox">
                                </th>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Role</th>
                                <th>country</th>
                                <th>ketwords</th>
                                <th>Birth Day</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($celebrities as $celebrity)
                                <tr>
                                    <td>
                                        <input class="form-check-input" type="checkbox">
                                    </td>
                                    <td>{{ $celebrity["id"] }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="product-box">
                                                <img style="width: unset;" src="{{ $base }}/cavatars/{{ $celebrity["avatar"] }}" alt="">
                                            </div>
                                            <div class="product-info">
                                                <a href="javascript:;" class="product-title">{{ \Illuminate\Support\Str::limit($celebrity["fullName"], 30, $end='...') }}</a>
                                                <p class="mb-0 product-category">Run Time : {{ $celebrity["role"] }}min</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="text-transform: capitalize;">{{ $celebrity["role"] }}</td>
                                    <td>{{ $celebrity["country"] }}</td>
                                    <td>
                                        <div class="product-tags">
                                            @php
                                                $keywords = explode(",", $celebrity["keywords"]);
                                            @endphp
                                            @foreach ( $keywords as $word)
                                                <a href="javascript:;" class="btn-tags">{{ $word }}</a>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>{{ date("j F Y", strtotime($celebrity["birthDay"])) }}</td>
                                    <td>{{ date("Y-m-d-h:i", strtotime($celebrity["created_at"])); }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light border dropdown-toggle dropdown-toggle-nocaret" type="button" data-bs-toggle="dropdown">
                                                <i class="bi bi-three-dots"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="/admin/celebrities/edit/{{ $celebrity["id"] }}">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item client-delete-btn" data-bs-toggle="modal" data-bs-target="#DeleteModal" data-show-id={{ $celebrity["id"] }} href="javascript:;">Delete</a>
                                                </li>
                                            </ul>
                                        </div>
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
                                <a class="page-link" href="/admin/celebrities?page={{ $p - 1 }}&max={{ $max }}&search={{ $search }}">{{ $p }}</a>
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
                <h5 class="modal-title">Delete Celebrity</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Are you sure you wants to delete this celebrity ?</div>
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
                $("#DeleteModalBtn").attr("href", "/admin/celebrities/delete/" + $(this).data("show-id"));
            })
        })
    </script>
@endsection