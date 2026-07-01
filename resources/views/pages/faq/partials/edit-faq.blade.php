<div class="modal fade" id="edit-faq" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form autocomplete="off" novalidate method="post" enctype="multipart/form-data" id="update-faq-form">
                @method('put')
                @csrf
                <input type="hidden" name="faq_id" id="edit-faq-id" value="">
                <input type="hidden" id="oldImage" name="oldImage" value="">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah FAQ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit-question-text" class="form-label">Pertanyaan</label>
                        <input id="edit-question" type="hidden" name="question" value="{{ old('question') }}">
                        <trix-editor input="edit-question" id="edit-question-text"></trix-editor>
                        @error('question')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="edit-answer-text" class="form-label">Jawaban</label>
                        <input id="edit-answer" type="hidden" name="answer" value="{{ old('answer') }}">
                        <trix-editor input="edit-answer" id="edit-answer-text"></trix-editor>
                        @error('answer')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="fal fa-save mr-1"></span>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
