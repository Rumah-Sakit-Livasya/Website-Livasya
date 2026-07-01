<div class="container">
    <div class="row my-4 align-items-center">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <div style="border-radius: 16px; overflow: hidden; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05);">
                <img src="/img/rs.webp" class="w-100 img-fluid" alt="RS Livasya"
                    style="display: block; transition: all 0.3s ease;">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="pl-lg-3">
                <span class="badge bg-primary text-white font-weight-bold px-3 py-1-5 mb-2 text-uppercase" style="border-radius: 20px; font-size: 10px;">Pertanyaan Populer</span>
                <h2 class="font-weight-bold text-dark mb-4" style="font-size: 24px; line-height: 1.3;">Dapatkan Jawaban dari Pertanyaan Anda</h2>
                
                <div class="accordion" id="accordionFaq">
                    @foreach ($faqs as $index => $faq)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $index }}">
                                <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapse{{ $index }}" aria-expanded="false" aria-controls="collapse{{ $index }}">
                                    {!! strip_tags($faq->question) !!}
                                </button>
                            </h2>
                            <div id="collapse{{ $index }}" class="collapse" aria-labelledby="heading{{ $index }}" data-parent="#accordionFaq">
                                <div class="accordion-body text-justify">
                                    {!! $faq->answer !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
