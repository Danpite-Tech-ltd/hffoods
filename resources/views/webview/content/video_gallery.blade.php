@extends('webview.master')

@section('maincontent')
    @section('title')
        {{ env('APP_NAME') }}- Video Gallery
    @endsection

    <!-- Best Selling and all Products -->
    <div class="container p-0 pb-2 ">

        <div class="video-gallery">
            <div class="container">
                <div class="row g-4">
                    @forelse ($video_galleries as $video_gallery)
                        <div class="col-12 col-md-6 col-lg-4">
                            <iframe style="width:100%;height: 100% !important;aspect-ratio:1/1;border-radius: 4px;"
                                src="https://www.youtube.com/embed/{{ $video_gallery->menu_banner }}">
                            </iframe>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>

    </div>


@endsection
