<div class="scrolling-banner">
    <div class="scrolling-banner-inner">
        @foreach ($images as $image)
            <div class="scrolling-banner-item">
                <img src="{{ $image }}" alt="Banner Image">
            </div>
        @endforeach
        @foreach ($images as $image)
            <div class="scrolling-banner-item">
                <img src="{{ $image }}" alt="Banner Image">
            </div>
        @endforeach
    </div>
</div>
