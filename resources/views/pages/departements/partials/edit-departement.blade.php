<div class="modal fade" id="edit-departement" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form autocomplete="off" novalidate method="post" enctype="multipart/form-data" id="update-departement-form">
                @method('put')
                @csrf
                <input type="hidden" name="departement_id" id="edit-departement-id" value="">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Departement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit-name">Nama Departement</label>
                        <input type="text" autofocus value="" class="form-control" id="edit-name"
                            name="name" placeholder="Nama Departement">
                    </div>
                    <div class="form-group">
                        <label for="edit-urutan">Urutan</label>
                        <input type="number" autofocus value="" class="form-control" id="edit-urutan"
                            name="urutan" placeholder="Urutan">
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
