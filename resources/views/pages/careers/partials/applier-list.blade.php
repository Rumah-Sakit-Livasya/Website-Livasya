@extends('inc.layout-blank')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Table <span class="fw-300"><i>Pelamar</i></span>
                    </h2>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <!-- datatable start -->
                        <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                            <thead>
                                <tr>
                                    <th style="white-space: nowrap">No</th>
                                    <th style="white-space: nowrap">Nama</th>
                                    <th style="white-space: nowrap">Jenis Kelamin</th>
                                    <th style="white-space: nowrap">Lulusan</th>
                                    <th style="white-space: nowrap">Tgl. Lahir</th>
                                    <th style="white-space: nowrap">Input</th>
                                    <th style="white-space: nowrap">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appliers as $applier)
                                    <tr>
                                        <td style="white-space: nowrap">{{ $loop->iteration }}</td>
                                        <td style="white-space: nowrap">
                                            {{ $applier->first_name }} {{ $applier->last_name ?? '' }}
                                        </td>
                                        <td style="white-space: nowrap">{{ $applier->sex }}</td>
                                        <td style="white-space: nowrap">{{ $applier->school_name }}</td>
                                        <td style="white-space: nowrap">{{ $applier->birth_day }}</td>
                                        <td style="white-space: nowrap">{{ $applier->created_at->diffForHumans() }}</td>

                                        <td style="white-space: nowrap">
                                            <!-- Add a data-applier-id attribute to the edit button -->
                                            <button type="button" data-backdrop="static" data-keyboard="false"
                                                class="badge mx-1 badge-primary p-2 border-0 text-white edit-button"
                                                data-toggle="modal" data-target="#edit-karir" title="Ubah"
                                                data-applier-id="{{ $applier->id }}">
                                                <span class="fal fa-pencil"></span>
                                            </button>

                                            <!-- Add a new button for opening in a new window -->
                                            <a href="/careers/{{ $applier->career->id }}/{{ $applier->id }}"
                                                class="badge mx-1 badge-success p-2 border-0 text-white open-new-window-button"
                                                data-applier-id="{{ $applier->id }}">
                                                <span class="fal fa-eye"></span>
                                            </a>

                                            <!-- Add a new button for opening in a new window -->
                                            <a href="/careers/{{ $applier->career->id }}/{{ $applier->id }}/download-cv"
                                                class="badge mx-1 badge-warning p-2 border-0 text-white open-new-window-button"
                                                data-applier-id="{{ $applier->id }}">
                                                <span class="fal fa-download"></span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- datatable end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
