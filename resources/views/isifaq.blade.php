<div class="container">
    <div class="row my-5">
        <div class=" col-lg-6">
            <img src="/img/rs.webp" class="img-thumbnail shadow-lg rounded" alt="..."
                style="border: none; vertical-align: middle; height: auto; width: 100%; border-radius: 20px !important">
        </div>

        <div id="faq" class="col-lg-6" style="height: 55vh; overflow: scroll; overflow-x: hidden;">
            <h5 style="color: #e97f0d;">Pertanyaan yang sering diajukan</h5>
            <h1 style="margin: .3em 0;">Dapatkan Jawaban dari Pertanyaan Anda</h1>
            <ul style="padding: 0;list-style: none;">
                @foreach ($faqs as $faq)
                    <li style="border-radius: 20px">
                        <input type="checkbox" checked>
                        <i></i>
                        <h6 style="margin: .3em 0;">{!! $faq->question !!}</h6>
                        <p>{!! str_replace(['<div>', '</div>'], '', $faq->answer) !!}</p>

                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
