@extends('inc.layout')

@section('title', $title)

@section('content')
<main id="js-page-content" role="main" class="page-content">
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon bx bxs-file-doc text-primary'></i> Lembar Penilaian Wawancara
            <small>
                Proses wawancara seleksi penerimaan karyawan RS Livasya.
            </small>
        </h1>
        <div class="subheader-block">
            <a href="{{ route('hrd.appliers', $career->id) }}" class="btn btn-sm btn-outline-secondary font-weight-bold">
                <i class="fal fa-arrow-left mr-1"></i> Kembali ke Daftar Pelamar
            </a>
        </div>
    </div>

    @php
        $isStage1 = ($applier->status == 'interview_1');
        $isStage2 = ($applier->status == 'interview_2');
        $isReadOnly = (!$isStage1 && !$isStage2);
    @endphp

    <div class="card p-4 shadow-sm border-light-blue bg-white mb-g">
        {{-- PDF Header style --}}
        <div class="text-center mb-4">
            <h4 class="font-weight-bold text-dark mb-1">LEMBAR PENILAIAN WAWANCARA</h4>
            <div class="border-bottom border-dark mx-auto" style="width: 250px; border-width: 2px !important;"></div>
        </div>

        {{-- Section 1: Data Diri Pelamar --}}
        <div class="bg-light p-3 rounded mb-g border">
            <h6 class="font-weight-bold text-primary mb-3"><i class="fal fa-user-circle mr-2"></i> Identitas Pelamar</h6>
            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-2">
                        <div class="col-5 text-muted font-weight-semibold">Pelamar Nomor</div>
                        <div class="col-7 text-dark font-weight-bold">#{{ $applier->id }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 text-muted font-weight-semibold">Posisi / Jabatan</div>
                        <div class="col-7 text-dark font-weight-bold">{{ $career->title }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 text-muted font-weight-semibold">Nama Lengkap</div>
                        <div class="col-7 text-dark font-weight-bold">{{ $applier->first_name }} {{ $applier->last_name }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 text-muted font-weight-semibold">Tempat, Tgl Lahir</div>
                        <div class="col-7 text-dark font-weight-bold">{{ $applier->birth_place ?? '-' }}, {{ $applier->birth_day ? \Carbon\Carbon::parse($applier->birth_day)->translatedFormat('d M Y') : '-' }}</div>
                    </div>
                </div>
                <div class="col-md-6 pl-md-4">
                    <div class="row mb-2">
                        <div class="col-5 text-muted font-weight-semibold">Pendidikan Terakhir</div>
                        <div class="col-7 text-dark font-weight-bold">{{ $latestEdu->level ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 text-muted font-weight-semibold">Lulusan</div>
                        <div class="col-7 text-dark font-weight-bold">{{ $latestEdu->school_name ?? '-' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 text-muted font-weight-semibold">Tahun Lulus</div>
                        <div class="col-7 text-dark font-weight-bold">{{ $latestEdu->graduation_year ?? '-' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('hrd.interview.store', [$career->id, $applier->id]) }}" method="POST">
            @csrf

            {{-- Section 2: A. Keadaan Fisik --}}
            <div class="mb-g">
                <h5 class="section-title text-primary font-weight-bold mb-3">A. KEADAAN FISIK</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label font-weight-bold">Tinggi Badan (cm)</label>
                        <input type="text" name="tinggi_badan" class="form-control form-control-sm" 
                            value="{{ old('tinggi_badan', $interview->tinggi_badan ?? '') }}" 
                            placeholder="Contoh: 170" {{ $isReadOnly ? 'readonly' : '' }}>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label font-weight-bold">Berat Badan (kg)</label>
                        <input type="text" name="berat_badan" class="form-control form-control-sm" 
                            value="{{ old('berat_badan', $interview->berat_badan ?? '') }}" 
                            placeholder="Contoh: 65" {{ $isReadOnly ? 'readonly' : '' }}>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label font-weight-bold">Kacamata</label>
                        <select name="kacamata" class="form-control form-control-sm" {{ $isReadOnly ? 'disabled' : '' }}>
                            <option value="">Pilih</option>
                            <option value="YA" {{ old('kacamata', $interview->kacamata ?? '') == 'YA' ? 'selected' : '' }}>YA</option>
                            <option value="TIDAK" {{ old('kacamata', $interview->kacamata ?? '') == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label font-weight-bold">Riwayat Penyakit</label>
                        <input type="text" name="riwayat_penyakit" class="form-control form-control-sm" 
                            value="{{ old('riwayat_penyakit', $interview->riwayat_penyakit ?? '') }}" 
                            placeholder="Riwayat penyakit kronis/berat..." {{ $isReadOnly ? 'readonly' : '' }}>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label font-weight-bold">Hobi Kegemaran</label>
                        <input type="text" name="hobi" class="form-control form-control-sm" 
                            value="{{ old('hobi', $interview->hobi ?? '') }}" 
                            placeholder="Membaca, traveling..." {{ $isReadOnly ? 'readonly' : '' }}>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label font-weight-bold">Olahraga</label>
                        <input type="text" name="olahraga" class="form-control form-control-sm" 
                            value="{{ old('olahraga', $interview->olahraga ?? '') }}" 
                            placeholder="Lari, bulutangkis..." {{ $isReadOnly ? 'readonly' : '' }}>
                    </div>
                </div>
            </div>

            {{-- Section 3: B. Faktor Yang Dinilai --}}
            <div class="mb-g">
                <h5 class="section-title text-primary font-weight-bold mb-3">B. FAKTOR YANG DINILAI</h5>
                
                <div class="alert alert-info py-2" style="font-size: 0.825rem;">
                    <strong>Skema Penilaian:</strong> <br>
                    - Kurang (K): 40 - 59 &bull; Cukup (C): 60 - 69 &bull; Baik (B): 70 - 85 &bull; Baik Sekali (BS): 86 - 100
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-sm table-striped m-0 align-middle-table">
                        <thead class="bg-primary text-white text-center">
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>Faktor Yang Dinilai</th>
                                <th style="width: 100px;">K</th>
                                <th style="width: 100px;">C</th>
                                <th style="width: 100px;">B</th>
                                <th style="width: 100px;">BS</th>
                                <th style="width: 180px;">Nilai (40-100)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $factorsList = [
                                    1 => ['title' => 'Penampilan', 'field' => 'f_penampilan'],
                                    2 => ['title' => 'Kematangan Emosi / Pengendalian Emosi', 'field' => 'f_kematangan_emosi'],
                                    3 => ['title' => 'Kemampuan Mengungkap Pikiran', 'field' => 'f_kemampuan_mengungkap_pikiran'],
                                    4 => ['title' => 'Motivasi dan Inisiatif', 'field' => 'f_motivasi_inisiatif'],
                                    5 => ['title' => 'Keterampilan Pemecahan Masalah', 'field' => 'f_keterampilan_pemecahan_masalah'],
                                    6 => ['title' => 'Kemampuan Komunikasi dan Persuasi', 'field' => 'f_kemampuan_komunikasi_persuasi'],
                                    7 => ['title' => 'Rasa Percaya Diri', 'field' => 'f_rasa_percaya_diri'],
                                    8 => ['title' => 'Kesesuaian dengan Persyaratan Jabatan', 'field' => 'f_kesesuaian_persyaratan'],
                                    9 => ['title' => 'Pengetahuan di Bidangnya', 'field' => 'f_pengetahuan_bidang'],
                                    10 => ['title' => 'Kemampuan Kerjasama', 'field' => 'f_kemampuan_kerjasama'],
                                ];
                            @endphp
                            @foreach($factorsList as $idx => $f)
                            <tr>
                                <td class="text-center font-weight-bold">{{ $idx }}</td>
                                <td class="font-weight-bold text-dark">{{ $f['title'] }}</td>
                                <td class="text-center text-muted fs-xs">40 - 59</td>
                                <td class="text-center text-muted fs-xs">60 - 69</td>
                                <td class="text-center text-muted fs-xs">70 - 85</td>
                                <td class="text-center text-muted fs-xs">86 - 100</td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center justify-content-center" style="gap: 10px;">
                                        <input type="number" id="f_{{ $idx }}" name="{{ $f['field'] }}" 
                                            class="form-control form-control-sm text-center font-weight-bold factor-input" 
                                            value="{{ old($f['field'], $interview->{$f['field']} ?? '') }}" 
                                            min="40" max="100" style="width: 80px;" oninput="calculateAverage()"
                                            {{ $isReadOnly ? 'readonly' : '' }}>
                                        <span id="badge_f_{{ $idx }}" class="d-none"></span>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            <tr class="bg-light font-weight-bold">
                                <td colspan="2" class="text-right py-2">RATA-RATA NILAI :</td>
                                <td colspan="4" class="text-center py-2" id="rek_text" style="font-size: 0.9rem;">-</td>
                                <td class="text-center text-primary fs-lg font-weight-bold py-2" id="rata_rata">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Keterangan Rekomendasi --}}
            <div class="row mb-g">
                <div class="col-md-12">
                    <label class="form-label font-weight-bold text-dark">Rekomendasi Seleksi Lebih Lanjut</label>
                    <div class="d-flex" style="gap: 20px;">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="rek1" name="rekomendasi" value="MEMENUHI SYARAT" 
                                class="custom-control-input" {{ old('rekomendasi', $interview->rekomendasi ?? '') == 'MEMENUHI SYARAT' ? 'checked' : '' }} 
                                {{ $isReadOnly ? 'disabled' : '' }}>
                            <label class="custom-control-label text-success font-weight-bold" for="rek1">MEMENUHI SYARAT</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="rek2" name="rekomendasi" value="PERTIMBANGAN" 
                                class="custom-control-input" {{ old('rekomendasi', $interview->rekomendasi ?? '') == 'PERTIMBANGAN' ? 'checked' : '' }} 
                                {{ $isReadOnly ? 'disabled' : '' }}>
                            <label class="custom-control-label text-warning font-weight-bold" for="rek2">PERTIMBANGAN</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="rek3" name="rekomendasi" value="TIDAK DISARANKAN" 
                                class="custom-control-input" {{ old('rekomendasi', $interview->rekomendasi ?? '') == 'TIDAK DISARANKAN' ? 'checked' : '' }} 
                                {{ $isReadOnly ? 'disabled' : '' }}>
                            <label class="custom-control-label text-danger font-weight-bold" for="rek3">TIDAK DISARANKAN</label>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            {{-- Tahapan Interviewer Info --}}
            <div class="row">
                <!-- Tahap 1: Wawancara User -->
                <div class="col-md-6 border-right-md mb-3">
                    <h6 class="font-weight-bold text-primary mb-3"><i class="fal fa-comments mr-1"></i> WAWANCARA TAHAP 1 (USER)</h6>
                    <div class="form-group mb-2">
                        <label class="form-label font-weight-bold">Nama Pewawancara User</label>
                        <input type="text" name="interviewer_name_1" class="form-control form-control-sm"
                            value="{{ old('interviewer_name_1', $interview->interviewer_name_1 ?? ($isStage1 ? Auth::user()->name : '')) }}"
                            {{ ($isStage1) ? 'required' : 'readonly' }}>
                    </div>
                    <div class="form-group">
                        <label class="form-label font-weight-bold">Tanggal Wawancara Tahap 1</label>
                        <input type="date" name="interview_date_1" class="form-control form-control-sm"
                            value="{{ old('interview_date_1', $interview->interview_date_1 ?? ($isStage1 ? date('Y-m-d') : '')) }}"
                            {{ ($isStage1) ? 'required' : 'readonly' }}>
                    </div>
                </div>

                <!-- Tahap 2: Wawancara Direktur -->
                <div class="col-md-6 pl-md-4 mb-3">
                    <h6 class="font-weight-bold text-danger mb-3"><i class="fal fa-user-shield mr-1"></i> WAWANCARA TAHAP 2 (DIREKTUR)</h6>
                    @if($isStage2)
                        <div class="form-group mb-2">
                            <label class="form-label font-weight-bold">Nama Pewawancara (Direktur)</label>
                            <input type="text" name="interviewer_name_2" class="form-control form-control-sm"
                                value="{{ old('interviewer_name_2', $interview->interviewer_name_2 ?? Auth::user()->name) }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label font-weight-bold">Tanggal Wawancara Tahap 2</label>
                            <input type="date" name="interview_date_2" class="form-control form-control-sm"
                                value="{{ old('interview_date_2', $interview->interview_date_2 ?? date('Y-m-d')) }}" required>
                        </div>
                        
                        <div class="card bg-faded p-3 border mb-3">
                            <label class="form-label font-weight-bold text-dark d-block mb-2">KEPUTUSAN AKHIR SELEKSI</label>
                            <div class="d-flex" style="gap: 20px;">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="dec_accept" name="final_decision" value="accepted" class="custom-control-input" required>
                                    <label class="custom-control-label text-success font-weight-bold" for="dec_accept">TERIMA (DITERIMA)</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="dec_reject" name="final_decision" value="rejected" class="custom-control-input" required>
                                    <label class="custom-control-label text-danger font-weight-bold" for="dec_reject">TOLAK (DITOLAK)</label>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="form-group mb-2">
                            <label class="form-label font-weight-bold">Nama Pewawancara (Direktur)</label>
                            <input type="text" class="form-control form-control-sm" 
                                value="{{ $interview->interviewer_name_2 ?? '-' }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-label font-weight-bold">Tanggal Wawancara Tahap 2</label>
                            <input type="text" class="form-control form-control-sm" 
                                value="{{ $interview->interview_date_2 ?? '-' }}" readonly>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Form Submit Buttons --}}
            @if(!$isReadOnly)
                <div class="d-flex justify-content-end mt-4" style="gap: 10px;">
                    <a href="{{ route('hrd.appliers', $career->id) }}" class="btn btn-outline-secondary font-weight-bold">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary font-weight-bold">
                        @if($isStage1)
                            Simpan & Lanjutkan ke Tahap 2
                        @else
                            Simpan & Tentukan Keputusan Akhir
                        @endif
                    </button>
                </div>
            @endif
        </form>
    </div>
</main>
@endsection

@section('scripts')
<script nonce="{{ $nonce }}">
function calculateAverage() {
    let total = 0;
    let count = 0;
    for (let i = 1; i <= 10; i++) {
        let el = document.getElementById('f_' + i);
        if (el) {
            let val = parseInt(el.value);
            if (!isNaN(val) && val >= 40 && val <= 100) {
                total += val;
                count++;
                
                // Show badge indicator
                let badge = document.getElementById('badge_f_' + i);
                badge.className = 'badge px-2 py-1 font-weight-bold';
                if (val >= 86) { 
                    badge.classList.add('badge-success'); 
                    badge.innerText = 'BS'; 
                } else if (val >= 70) { 
                    badge.classList.add('badge-primary'); 
                    badge.innerText = 'B'; 
                } else if (val >= 60) { 
                    badge.classList.add('badge-warning'); 
                    badge.innerText = 'C'; 
                } else { 
                    badge.classList.add('badge-danger'); 
                    badge.innerText = 'K'; 
                }
            } else {
                let badge = document.getElementById('badge_f_' + i);
                if (badge) badge.className = 'd-none';
            }
        }
    }
    let avg = count > 0 ? (total / count).toFixed(2) : '-';
    let rataEl = document.getElementById('rata_rata');
    if (rataEl) rataEl.innerText = avg;
    
    let rekEl = document.getElementById('rek_text');
    if (rekEl) {
        if (avg !== '-') {
            let avgNum = parseFloat(avg);
            if (avgNum >= 70) { 
                rekEl.className = 'text-success font-weight-bold py-2'; 
                rekEl.innerText = 'MEMENUHI SYARAT'; 
                // Auto check recommendation radio on stage1 if user hasn't selected manually yet
                @if(!$isReadOnly)
                    let checkMs = document.getElementById('rek1');
                    if (checkMs && !checkMs.disabled) checkMs.checked = true;
                @endif
            } else if (avgNum >= 60) { 
                rekEl.className = 'text-warning font-weight-bold py-2'; 
                rekEl.innerText = 'PERTIMBANGAN'; 
                @if(!$isReadOnly)
                    let checkP = document.getElementById('rek2');
                    if (checkP && !checkP.disabled) checkP.checked = true;
                @endif
            } else { 
                rekEl.className = 'text-danger font-weight-bold py-2'; 
                rekEl.innerText = 'TIDAK DISARANKAN'; 
                @if(!$isReadOnly)
                    let checkTd = document.getElementById('rek3');
                    if (checkTd && !checkTd.disabled) checkTd.checked = true;
                @endif
            }
        } else {
            rekEl.innerText = '-';
            rekEl.className = 'text-center py-2';
        }
    }
}

// Initial calculation on page load
$(document).ready(function() {
    calculateAverage();
});
</script>
@endsection
