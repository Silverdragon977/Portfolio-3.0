{{-- resources/views/components/video-card.blade.php --}}
{{-- // Uses App/View/Components/VideoCard.php
// which has a constructor that accepts $videoName and $caption, and assigns them to public properties. --}}


    
    <div class="video-section {{ $side === 'right' ? 'reverse' : '' }}">
        <div class="video-container">
            <p>{{ $heading }}</p>
            <video scroll-video loop muted playsinline>
                <source src="{{ asset('clips/' . $videoName . '.webm') }}" type="video/webm">
                Your browser does not support the video tag.
            </video>
        </div>
        @if($caption)
            <div class="text-container">
                {!! $caption !!}  
                {{-- using {!! !!} to render HTML tags like <br> in the caption --}}
            </div>
        @endif
    </div>
