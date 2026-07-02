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
                                    <th style="white-space: nowrap">Status</th>
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
                                        <td style="white-space: nowrap">
                                            @php
                                                $educationText = '-';
                                                if ($applier->educations && $applier->educations->isNotEmpty()) {
                                                    $latestEdu = $applier->educations->first();
                                                    $parts = [];
                                                    if ($latestEdu->level) {
                                                        $parts[] = $latestEdu->level;
                                                    }
                                                    if ($latestEdu->institution) {
                                                        $parts[] = $latestEdu->institution;
                                                    }
                                                    if (!empty($parts)) {
                                                        $educationText = implode(' - ', $parts);
                                                    }
                                                } elseif (!empty($applier->school_name) && $applier->school_name !== '-') {
                                                    $parts = [];
                                                    if ($applier->school_qual) {
                                                        $parts[] = $applier->school_qual;
                                                    }
                                                    $parts[] = $applier->school_name;
                                                    $educationText = implode(' - ', $parts);
                                                }
                                            @endphp
                                            {{ $educationText }}
                                        </td>
                                        <td style="white-space: nowrap">{{ $applier->birth_day }}</td>
                                        <td style="white-space: nowrap">
                                            @if ($applier->status == 'processed')
                                                <span class="badge badge-warning">Diproses</span>
                                            @elseif($applier->status == 'accepted')
                                                <span class="badge badge-success">Diterima</span>
                                            @elseif($applier->status == 'rejected')
                                                <span class="badge badge-danger">Ditolak</span>
                                            @else
                                                <span class="badge badge-secondary">{{ $applier->status }}</span>
                                            @endif
                                        </td>
                                        <td style="white-space: nowrap">{{ $applier->created_at->diffForHumans() }}</td>

                                        <td style="white-space: nowrap">
                                            @if ($applier->status == 'processed')
                                                {{-- Tombol Terima: buka modal jadwal wawancara --}}
                                                <button type="button"
                                                    class="badge mx-1 badge-success p-2 border-0 text-white btn-terima-pelamar"
                                                    data-id="{{ $applier->id }}"
                                                    data-name="{{ $applier->first_name }} {{ $applier->last_name }}"
                                                    data-career-id="{{ $applier->career->id }}"
                                                    data-action-url="{{ action([\App\Http\Controllers\Pages\CareerController::class, 'updateStatus'], ['career' => $applier->career->id, 'applier' => $applier->id]) }}">
                                                    <span class="fal fa-check"></span> Terima
                                                </button>

                                                {{-- Tombol Tolak --}}
                                                <form
                                                    action="{{ action([\App\Http\Controllers\Pages\CareerController::class, 'updateStatus'], ['career' => $applier->career->id, 'applier' => $applier->id]) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button
                                                        class="badge mx-1 badge-danger p-2 border-0 text-white js-confirm-action"
                                                        data-message="Tolak pelamar ini?">
                                                        <span class="fal fa-times"></span> Tolak
                                                    </button>
                                                </form>
                                            @endif


                                            <!-- Add a new button for opening in a new window -->
                                            <a href="/careers/{{ $applier->career->id }}/{{ $applier->id }}"
                                                class="badge mx-1 badge-info p-2 border-0 text-white open-new-window-button"
                                                data-applier-id="{{ $applier->id }}">
                                                <span class="fal fa-eye"></span> Detail
                                            </a>

                                            <!-- Add a new button for opening in a new window -->
                                            <a href="/careers/{{ $applier->career->id }}/{{ $applier->id }}/download-cv"
                                                class="badge mx-1 badge-warning p-2 border-0 text-white open-new-window-button"
                                                data-applier-id="{{ $applier->id }}">
                                                <span class="fal fa-download"></span> CV
                                            </a>

                                            @php
                                                $waNumber = $applier->whatsapp_number ?? '';
                                                if (substr($waNumber, 0, 1) == '0') {
                                                    $waNumber = '62' . substr($waNumber, 1);
                                                }
                                                $message = "Halo {$applier->first_name}, kami dari HRD RS Livasya terkait lamaran Anda untuk posisi {$applier->career->title}...";
                                            @endphp
                                            @if ($waNumber)
                                                <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode($message) }}"
                                                    target="_blank" class="badge mx-1 badge-success p-2 border-0 text-white"
                                                    title="Hubungi via WhatsApp">
                                                    <span class="fab fa-whatsapp"></span> WA
                                                </a>
                                            @endif
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

{{-- Modal Jadwal Wawancara --}}
<div class="modal fade" id="modalJadwalWawancara" tabindex="-1" role="dialog" aria-labelledby="modalJadwalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalJadwalLabel">📅 Jadwal Wawancara</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formJadwalWawancara" method="POST">
                @csrf @method('PUT')
                <input type="hidden" name="status" value="accepted">
                <div class="modal-body">
                    <p class="text-muted mb-3">Pelamar: <strong id="modalApplierName"></strong></p>

                    <div class="form-group">
                        <label for="interview_date">Tanggal Wawancara <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="interview_date" name="interview_date" required>
                    </div>

                    <div class="form-group">
                        <label for="interview_time">Waktu Wawancara <span class="text-danger">*</span></label>
                        <input type="time" class="form-control" id="interview_time" name="interview_time" required>
                    </div>

                    <div class="form-group">
                        <label for="interview_type">Jenis Wawancara <span class="text-danger">*</span></label>
                        <select class="form-control no-select2" id="interview_type" name="interview_type" required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="online">Online (Video Conference)</option>
                            <option value="offline">Offline / Tatap Muka</option>
                        </select>
                    </div>

                    <div class="form-group" id="locationGroup">
                        <label for="interview_location">Lokasi / Keterangan</label>
                        <input type="text" class="form-control" id="interview_location" name="interview_location"
                            placeholder="Contoh: Gedung A Lt. 3 atau link akan dikirim via email">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
                        <span class="fal fa-check"></span> Kirim Undangan &amp; Terima
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@section('plugin')
    <script nonce="{{ $nonce }}">
        $(document).ready(function() {
            // Handle confirmation buttons (Tolak)
            $(document).on('click', '.js-confirm-action', function(e) {
                var message = $(this).data('message');
                if (!confirm(message)) {
                    e.preventDefault();
                }
            });

            // Tombol Terima -> buka modal jadwal wawancara
            $(document).on('click', '.btn-terima-pelamar', function() {
                var name   = $(this).data('name');
                var action = $(this).data('action-url');

                $('#modalApplierName').text(name);
                $('#formJadwalWawancara').attr('action', action);

                // Reset form fields
                $('#interview_date').val('');
                $('#interview_time').val('');
                $('#interview_type').val('');
                $('#interview_location').val('');
                updateLocationLabel('');

                $('#modalJadwalWawancara').modal('show');
            });

            // Toggle label lokasi berdasarkan jenis interview
            $(document).on('change', '#interview_type', function() {
                updateLocationLabel($(this).val());
            });

            function updateLocationLabel(type) {
                if (type === 'online') {
                    $('#locationGroup label').text('Keterangan Tambahan (opsional)');
                    $('#interview_location').attr('placeholder', 'Mis. silakan test kamera sebelum sesi');
                } else if (type === 'offline') {
                    $('#locationGroup label').text('Lokasi / Alamat Wawancara');
                    $('#interview_location').attr('placeholder', 'Mis. Gedung A Lt. 3, Jl. Sudirman No.1');
                } else {
                    $('#locationGroup label').text('Lokasi / Keterangan');
                    $('#interview_location').attr('placeholder', 'Contoh: Gedung A Lt. 3 atau link akan dikirim via email');
                }
            }
        });
    </script>
@endsection
