<section style="margin-top: 4rem;" class="bg-white">
    <h1 class="heading " style="padding-top:8rem;"> <span>Sekilas</span> Tentang <span>Rumah Sakit Livasya</span></h1>
    <ul class="timeline">
        <!-- Item 1 -->
        @foreach ($timelines as $timeline)
            <li>
                <div class="direction-r">
                    <div class="flag-wrapper">
                        <span class="flag">{{ $timeline->flag }}</span> <br>
                        <span class="time-wrapper"><span class="time">{{ $timeline->time }}</span></span>
                    </div>
                    <div class="desc text-justify">
                        {!! $timeline->desc !!}
                    </div>
                    <div class="desc">
                        <img class="img-thumbnail m-auto w-100" src="{{ asset('storage/' . $timeline->image) }}"
                            alt="{{ $timeline->flag }}" style="border-radius:20px;" class="img-thumbnail m-auto">
                    </div>
                </div>
            </li>
        @endforeach
        <!-- Item 1 -->
    </ul>
</section>
{{-- <img src="{{ asset('storage/' . $poliklinik->image) }}" alt="{{ $poliklinik->name }}"
                                style="filter: saturate(0); border-radius:20px;" class="img-thumbnail m-auto"> --}}
