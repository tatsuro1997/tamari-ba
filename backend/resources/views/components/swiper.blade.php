@php
    if($type==='bike'){
        $path = '/bikes/';
    }
    if($type==='road'){
        $path = '/roads/';
    }
    if($type==='board'){
        $path = '/boards/';
    }
@endphp

<div class="lg:w-1/2 sm:w-full text-center border-b-4">
    <!-- Slider main container -->
    <div class="swiper-container">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            @foreach ($images as $image)
                <div class="swiper-slide">
                    <img class="lazyload w-full sm:max-h-80 max-h-52 mx-auto bg-cover" loading="lazy" src="{{ asset('images/test.webp') }}" data-src="{{ Storage::disk('s3')->url($path . $image->filename) }}">
                </div>
            @endforeach
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

        <!-- If we need scrollbar -->
        <div class="swiper-scrollbar"></div>
    </div>
    @if (empty($images->first()->filename))
        <img class="lazyload" loading="lazy" src="{{ asset('images/test.webp') }}" data-src="{{ asset('images/no_image.webp') }}">
    @endif
</div>
