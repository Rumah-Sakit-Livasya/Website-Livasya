@extends('inc.layout')
@section('title', 'User')
@section('content')
    <main id="js-page-content" role="main" class="page-content">
        <div class="row mb-5">
            <div class="col-xl-12">
                <button type="button" class="btn btn-primary waves-effect waves-themed" data-backdrop="static"
                    data-keyboard="false" data-toggle="modal" data-target="#tambah-user" title="Tambah User">
                    <span class="fal fa-plus-circle mr-1"></span>
                    Tambah User
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Table <span class="fw-300"><i>User</i></span>
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <!-- datatable start -->
                            <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                                <thead>
                                    <tr>
                                        <th style="white-space: nowrap">Nama User</th>
                                        <th style="white-space: nowrap">Username</th>
                                        <th style="white-space: nowrap">Email</th>
                                        <th style="white-space: nowrap">Role</th>
                                        <th style="white-space: nowrap">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td style="white-space: nowrap">{{ $user->name }}</td>
                                            <td style="white-space: nowrap">{{ $user->username }}</td>
                                            <td style="white-space: nowrap">{{ $user->email }}</td>
                                            <td style="white-space: nowrap">
                                                @php $userRole = $user->getRoleNames()->first() ?? '-'; @endphp
                                                @if($userRole == 'super-admin')
                                                    <span class="badge badge-danger">Super Admin</span>
                                                @elseif($userRole == 'hrd')
                                                    <span class="badge badge-info">HRD</span>
                                                @elseif($userRole == 'user')
                                                    <span class="badge badge-primary">User</span>
                                                @elseif($userRole == 'pelamar')
                                                    <span class="badge badge-success">Pelamar</span>
                                                @else
                                                    <span class="badge badge-secondary">{{ $userRole }}</span>
                                                @endif
                                            </td>
                                            <td style="white-space: nowrap">
                                                <button type="button" data-backdrop="static" data-keyboard="false"
                                                    class="badge mx-1 badge-primary p-2 border-0 text-white"
                                                    data-toggle="modal" data-target="#ubah-user{{ $user->id }}"
                                                    title="Ubah">
                                                    <span class="fal fa-pencil"></span>
                                                </button>
                                                <button type="button" data-backdrop="static" data-keyboard="false"
                                                    class="badge mx-1 badge-success p-2 border-0 text-white"
                                                    data-toggle="modal" data-target="#ubah-password{{ $user->id }}"
                                                    title="Ubah Password">
                                                    <span class="fal fa-key"></span>
                                                </button>
                                                <button type="button" data-backdrop="static" data-keyboard="false"
                                                    class="badge mx-1 badge-secondary p-2 border-0 text-white"
                                                    data-toggle="modal" data-target="#ubah-akses{{ $user->id }}"
                                                    title="Ubah Role">
                                                    <span class="fal fa-user-secret"></span>
                                                </button>
                                            </td>
                                        </tr>

                                        @include('pages.user.partials.update-user')
                                        @include('pages.user.partials.update-password')
                                        @include('pages.user.partials.update-role')
                                    @endforeach
                                    @include('pages.user.partials.create-user')
                                </tbody>
                                <tfoot>
                                    <tr>
                                        {{-- <th style="white-space: nowrap">Foto</th> --}}
                                        <th style="white-space: nowrap">Nama User</th>
                                        <th style="white-space: nowrap">Username</th>
                                        <th style="white-space: nowrap">Email</th>
                                        <th style="white-space: nowrap">Unit</th>
                                        <th style="white-space: nowrap">Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- datatable end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('plugin')
    <script src="/js/datagrid/datatables/datatables.bundle.js"></script>
    <script src="/js/formplugins/select2/select2.bundle.js"></script>
    <script>
        /* demo scripts for change table color */
        /* change background */
        $(document).ready(function() {

            @foreach ($users as $u)
                {{-- Select2 tidak digunakan untuk role agar dropdown tidak keluar modal --}}
            @endforeach

            {{-- '#namaUnit' tidak dipakai di form ini, skip --}}

            $('#dt-basic-example').dataTable({
                responsive: true
            });

            $('.js-thead-colors a').on('click', function() {
                var theadColor = $(this).attr("data-bg");
                console.log(theadColor);
                $('#dt-basic-example thead').removeClassPrefix('bg-').addClass(theadColor);
            });

            $('.js-tbody-colors a').on('click', function() {
                var theadColor = $(this).attr("data-bg");
                console.log(theadColor);
                $('#dt-basic-example').removeClassPrefix('bg-').addClass(theadColor);
            });

        });
    </script>
@endsection
