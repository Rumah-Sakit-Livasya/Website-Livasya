<div class="modal fade" id="ubah-akses{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form autocomplete="off" novalidate action="/user/{{ $user->id }}/akses" method="post"
                enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fal fa-user-shield mr-2"></i>Ubah Role &mdash; {{ $user->name }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    @php $currentRole = $user->getRoleNames()->first() ?? ''; @endphp
                    <div class="form-group mb-0">
                        <label for="aksesUser{{ $user->id }}">Pilih Role</label>
                        <select class="form-control w-100 no-select2 @error('role') is-invalid @enderror"
                            id="aksesUser{{ $user->id }}" name="role" style="height:42px">
                            <option value="super-admin" {{ $currentRole == 'super-admin' ? 'selected' : '' }}>
                                Super Admin
                            </option>
                            <option value="user" {{ $currentRole == 'user' ? 'selected' : '' }}>
                                User (Staff)
                            </option>
                            <option value="hrd" {{ $currentRole == 'hrd' ? 'selected' : '' }}>
                                HRD
                            </option>
                            <option value="pelamar" {{ $currentRole == 'pelamar' ? 'selected' : '' }}>
                                Pelamar
                            </option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted mt-2 d-block">
                            Role saat ini: <strong>{{ $currentRole ?: 'Belum ada role' }}</strong>
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="fal fa-save mr-1"></span> Simpan Role
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
