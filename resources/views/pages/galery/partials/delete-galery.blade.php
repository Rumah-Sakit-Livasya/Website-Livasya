<div class="modal" id="delete-galery" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form autocomplete="off" novalidate method="post" enctype="multipart/form-data" id="delete-galery-form">
                @method('delete')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Gambar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id-gambar">ID Gambar</label>
                        <input type="number" autofocus value="" class="form-control" id="id-gambar"
                            name="galery_id" placeholder="Masukan ID Gambar">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger delete-button">
                        <span class="fal fa-trash mr-1"></span>
                        Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
