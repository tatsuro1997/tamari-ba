@php
    if($type==='road'){
        $path = 'storage/roads/';
    }
    if($type==='board'){
        $path = 'storage/boards/';
    }
@endphp

<div class="w-1/2 text-center">
    <!-- Slider main container -->
    <div class="swiper-container">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            @foreach ($images as $image)
                <div class="swiper-slide">
                    <img src="{{ asset($path . $image->filename) }}">
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
        <img src="{{ asset('images/no_image.jpg') }}">
    @endif
</div>