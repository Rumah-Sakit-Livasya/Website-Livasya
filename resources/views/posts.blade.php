@extends('layouts.main')

@section('container')
    <section class="hero-berita"
        style="background: url(img/WorldMap.svg);  background-size: cover; background-position: right; height: 40rem;">
        <section class="title bg-light justify-content-center" style="border-radius: 20em;opacity: 0,5;">
            <h1 class="fw-bold text-center" style="color: var(--primary)" data-aos="fade-right"
                data-aos-anchor-placement="top-bottom">
                Berita Terkini
            </h1>
        </section>
    </section>

    <section class="blogs py-5 bg-white" id="blogs">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-6">
                <form action="/posts">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control fs-4" value="{{ request('search') }}"
                            placeholder="Cari berita" name="search">
                        <button class="btn pe-3" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>

        @if ($posts->count())
            <div class="row g-5 align-content-between justify-content-around">
                @foreach ($posts as $post)
                    <div class="col-lg-4">
                        @if ($post->is_embeded)
                            {!! $post->body !!}
                        @else
                            <a href="/posts/{{ $post->slug }}" class="text-decoration-none">
                                <div class="card img-parent overflow-hidden position-relative shadow"
                                    style=" outline: none; border: none;">
                                    <div class="card-header bg-white m-3"
                                        style="border: none; display: flex; align-items: center;">
                                        <img src="{{ asset('img/ig.jpg') }}" alt="Image"
                                            style="width: 30px; height: 30px; border-radius: 50%; margin-right: 5px; vertical-align: middle;">
                                        <div class="ml-3"
                                            style="display: flex; flex-direction: column; line-height: 1.2; font-size: 12px;">
                                            <strong class="mb-1">rslivasya</strong>
                                            <p class="mb-0">Majalengka</p>
                                        </div>
                                    </div>
                                    @if ($post->image)
                                        <div class="card-img-top overflow-hidden">
                                            <div
                                                style="background-image: url({{ asset('/storage/' . $post->image) }}); background-size: cover; height: 470px; background-position: center;">
                                            </div>
                                        </div>
                                    @else
                                        <div class="card-img-top overflow-hidden">
                                            <div
                                                style="background-image: url(https://source.unsplash.com/random/900×700/?{{ $post->category->slug }}); background-size: cover; height: 470px;">
                                            </div>
                                        </div>
                                    @endif
                                    <div class="card-body text-center" style="background-color: #fff; padding: 1rem;">
                                        <h5 class="card-title" style="font-size: 1.2rem; font-weight: bold;">
                                            {{ $post->title }}
                                        </h5>
                                        <div class="d-flex justify-content-start align-items-center mt-5"
                                            style="gap: 10px;">
                                            <span class="text-muted"><img
                                                    src="https://cdn-icons-png.flaticon.com/128/1077/1077035.png"
                                                    width="24"></span>
                                            <span class="text-muted" style="opacity: 0.7;"><img
                                                    src="https://cdn-icons-png.flaticon.com/128/5948/5948565.png"
                                                    width="24"></span>
                                            <span class="text-muted" style="opacity: 0.7; transform: rotate(-90deg)"><img
                                                    src="https://cdn-icons-png.flaticon.com/128/1286/1286853.png"
                                                    width="24"></span>
                                        </div>
                                        <p class="text-bold mt-2 text-left">99k likes</p>
                                    </div>
                                    <hr>
                                    <div class="add-comment" style="height: 30px; display: flex; align-items: center;">
                                        <h6 class="ml-3 text-muted">Add a comment...</h6>
                                        <img src="https://cdn-icons-png.flaticon.com/128/1384/1384031.png" class="mr-3 mb-3"
                                            alt="Instagram Icon" style="width: 24px; height: 24px; margin-left: auto;">
                                    </div>
                                </div>
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="fs-4 text-center">Tidak ditemukan berita.</p>
        @endif

        <div class="d-flex justify-content-center mt-5" id="pagination-container">
            <div class="pagination">{{ $posts->links() }}</div>
        </div>

    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            attachPaginationLinks();

            function attachPaginationLinks() {
                const paginationLinks = document.querySelectorAll('#pagination-container .pagination a');

                paginationLinks.forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        const url = this.href;

                        fetch(url)
                            .then(response => response.text())
                            .then(data => {
                                const parser = new DOMParser();
                                const doc = parser.parseFromString(data, 'text/html');
                                const newPosts = doc.querySelector('.row.g-5');
                                const newPagination = doc.querySelector(
                                    '#pagination-container');

                                document.querySelector('.row.g-5').innerHTML = newPosts
                                    .innerHTML;
                                document.querySelector('#pagination-container').innerHTML =
                                    newPagination.innerHTML;

                                // Scroll to the top of the page
                                window.scrollTo(0, 0);

                                // Reinitialize Instagram embeds after new content is loaded
                                if (typeof instgrm !== 'undefined') {
                                    instgrm.Embeds.process();
                                }

                                // Reattach pagination links after new content is loaded
                                attachPaginationLinks();
                            });
                    });
                });
            }
        });
    </script>
@endsection
