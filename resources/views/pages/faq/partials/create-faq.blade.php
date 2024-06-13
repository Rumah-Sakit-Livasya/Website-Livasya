<div class="modal fade" id="tambah-faq" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form autocomplete="off" novalidate method="post" enctype="multipart/form-data" id="create-faq-form">
                @method('post')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Faq</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="create-question" class="form-label">Pertanyaan</label>
                        <input id="create-question" type="hidden" name="question" value="{{ old('question') }}">
                        <trix-editor input="create-question"></trix-editor>
                        @error('question')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="create-answer" class="form-label">Jawaban</label>
                        <input id="create-answer" type="hidden" name="answer" value="{{ old('answer') }}">
                        <trix-editor input="create-answer"></trix-editor>
                        @error('answer')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="create-button">
                        <span class="fal fa-plus-circle mr-1"></span>
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
