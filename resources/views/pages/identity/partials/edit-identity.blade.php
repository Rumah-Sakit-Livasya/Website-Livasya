<div class="modal fade" id="edit-identity" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form autocomplete="off" novalidate method="post" enctype="multipart/form-data" id="update-identity-form"
                data-id="">
                @method('put')
                @csrf
                <input type="hidden" id="oldImage" name="oldImage" value="">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Identitas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label d-block" for="edit-image">Logo</label>
                        <img class="edit-img-preview img-fluid mb-3 col-sm-5">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="edit-image" name="image"
                                onchange="editPreviewImage()">
                            <label class="custom-file-label" for="edit-image">Pilih gambar</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit-name">Nama Instansi</label>
                        <input type="text" autofocus value="" class="form-control" id="edit-name"
                            name="name" placeholder="Nama Instansi">
                    </div>
                    <div class="form-group">
                        <label for="edit-shortname">Nama Pendek (1 Kata)</label>
                        <input type="text" autofocus value="" class="form-control" id="edit-shortname"
                            name="shortname" placeholder="Nama Pendek (1 Kata)">
                    </div>
                    <div class="form-group">
                        <label for="edit-visi">Visi</label>
                        <input type="text" autofocus value="" class="form-control" id="edit-visi"
                            name="visi" placeholder="Visi">
                    </div>
                    <div class="form-group">
                        <label for="edit-misi" class="form-label">Misi</label>
                        <input id="edit-misi" type="hidden" name="misi" value="{{ old('misi') }}">
                        <trix-editor input="edit-misi" id="edit-misi-text"></trix-editor>
                        @error('misi')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="edit-tujuan" class="form-label">Tujuan</label>
                        <input id="edit-tujuan" type="hidden" name="tujuan" value="{{ old('tujuan') }}">
                        <trix-editor input="edit-tujuan" id="edit-tujuan-text"></trix-editor>
                        @error('misi')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="edit-alamat">Alamat</label>
                        <input type="text" autofocus value="" class="form-control" id="edit-alamat"
                            name="alamat" placeholder="Alamat">
                    </div>
                    <div class="form-group">
                        <label for="edit-facebook">Facebook</label>
                        <input type="text" autofocus value="" class="form-control" id="edit-facebook"
                            name="facebook" placeholder="Facebook">
                    </div>
                    <div class="form-group">
                        <label for="edit-twitter">Twitter</label>
                        <input type="text" autofocus value="" class="form-control" id="edit-twitter"
                            name="twitter" placeholder="Twitter">
                    </div>
                    <div class="form-group">
                        <label for="edit-instagram">Instagram</label>
                        <input type="text" autofocus value="" class="form-control" id="edit-instagram"
                            name="instagram" placeholder="Instagram">
                    </div>
                    <div class="form-group">
                        <label for="edit-youtube">Youtube</label>
                        <input type="text" autofocus value="" class="form-control" id="edit-youtube"
                            name="youtube" placeholder="Youtube">
                    </div>
                    <div class="form-group">
                        <label for="edit-email">Email</label>
                        <input type="text" autofocus value="" class="form-control" id="edit-email"
                            name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="edit-no-hp">No HP</label>
                        <input type="text" autofocus value="" class="form-control" id="edit-no-hp"
                            name="no_hp" placeholder="No HP">
                    </div>
                    <div class="form-group">
                        <label for="edit-no-telp">No Telp</label>
                        <input type="text" autofocus value="" class="form-control" id="edit-no-telp"
                            name="no_telp" placeholder="No Telp">
                    </div>
                    <div class="form-group">
                        <label for="edit-jumlah-pasien-puas">Jumlah Pasien Puas</label>
                        <input type="number" autofocus value="" class="form-control"
                            id="edit-jumlah-pasien-puas" name="jml_pasien_puas" placeholder="Jumlah Pasien Puas">
                    </div>
                    <div class="form-group">
                        <label for="edit-jumlah-fasilitas-kamar">Jumlah Fasilitas Kamar</label>
                        <input type="number" autofocus value="" class="form-control"
                            id="edit-jumlah-fasilitas-kamar" name="jml_fasilitas_kamar"
                            placeholder="Jumlah Fasilitas Kamar">
                    </div>
                    <div class="form-group">
                        <label for="edit-sejarah" class="form-label">Sejarah</label>
                        <input id="edit-sejarah" type="hidden" name="sejarah" value="{{ old('sejarah') }}">
                        <trix-editor input="edit-sejarah" id="edit-sejarah-text"></trix-editor>
                        @error('sejarah')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="fal fa-edit mr-1"></span>
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
