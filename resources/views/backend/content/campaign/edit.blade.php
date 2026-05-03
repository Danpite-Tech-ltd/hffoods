@extends('backend.master')

@section('maincontent')
    @section('title')
        {{ env('APP_NAME') }}- Edit Landingpage
    @endsection
    <style>
        .card {
            border-radius: 12px;
        }

        .form-label {
            font-weight: 600;
        }

        .select2-container .select2-dropdown {
            max-height: 300px;
            overflow: hidden;
        }

        .select2-results {
            max-height: 250px;
            overflow-y: auto;
        }

        .select2-search--dropdown {
            position: sticky;
            top: 0;
            background: white;
            z-index: 10;
            padding: 5px;
            border-bottom: 1px solid #ddd;
        }

        .select2-results__option {
            padding: 10px;
            font-size: 14px;
        }

        .select2-results__option--highlighted {
            background-color: #0d6efd !important;
            color: #fff;
        }

        .select2-container--default .select2-selection--multiple {
            min-height: 45px;
            padding: 5px;
        }

        input {
            border: 1px solid #ddd !important;
        }
    </style>
    <div class="container mt-5">
        <div class="p-4 shadow card">
            <h4 class="mb-4">Edit Landing Page</h4>

            <form action="{{ route('admin.campaigns.update', $campaign->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @php
                    $selectedProducts = json_decode($campaign->product_id, true);
                @endphp

                <div class="row">

                    <div class="mb-3 col-md-12">
                        <label class="form-label">Landingpage Title</label>
                        <input type="text" class="form-control" name="name" value="{{ $campaign->name }}">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label class="form-label">Subtitle</label>
                        <input type="text" class="form-control" name="title" value="{{ $campaign->title }}">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label class="form-label">Subtitle Two</label>
                        <input type="text" class="form-control" name="subtitle" value="{{ $campaign->subtitle }}">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label class="form-label">Description Image</label><br>

                        <!-- Old Image -->
                        @if($campaign->image)
                            <img src="{{ asset($campaign->image) }}" width="80" class="mb-2">
                        @endif

                        <input type="file" class="form-control" name="image">
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label">Why Choose Us Image</label><br>

                        <!-- Old Image -->
                        @if($campaign->image2)
                            <img src="{{ asset($campaign->image2) }}" width="80" class="mb-2">
                        @endif

                        <input type="file" class="form-control" name="image2">
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label">Review Images</label><br>

                        @if($campaign->review_images)
                            @php
                                $reviewImages = is_array($campaign->review_images)
                                    ? $campaign->review_images
                                    : json_decode($campaign->review_images, true);
                            @endphp

                            @if(is_array($reviewImages))
                                @foreach($reviewImages as $reviewImage)
                                    @if($reviewImage)
                                        <img src="{{ asset($reviewImage) }}" width="80" class="mb-2 me-2">
                                    @endif
                                @endforeach
                            @endif
                        @endif

                        <input type="file" class="form-control" name="review_images[]" multiple>
                        <small class="text-muted">Upload new review images to replace the existing ones.</small>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label class="form-label">Middle Title</label>
                        <input type="text" class="form-control" name="oldprice_title"
                            value="{{ $campaign->oldprice_title }}">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label class="form-label">Youtube Video</label>
                        <input type="text" class="form-control" name="price_title" value="{{ $campaign->price_title }}">
                        <small class="text-muted">Only Youtube Video Id</small>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label class="form-label">Select Products</label>
                        <select class="form-control select2" multiple name="product_id[]">
                            @foreach ($products as $value)
                                <option value="{{ $value->id }}" {{ in_array($value->id, $selectedProducts ?? []) ? 'selected' : '' }}>
                                    {{ $value->ProductName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label class="form-label">Description</label>
                        <textarea id="description" name="description">{!! $campaign->description !!}</textarea>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label">Why choose Us</label>
                        <textarea id="why_choose" name="why_choose">{!! $campaign->why_choose !!}</textarea>
                    </div>

                </div>

                <button class="btn btn-primary" type="submit">Update</button>
            </form>
        </div>
    </div>

    <!-- Summernote CSS -->
    <!-- JS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.select2').select2({
                placeholder: "Select Products",
                allowClear: true,
                width: '100%',
                closeOnSelect: false
            });
        });
    </script>
    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function () {

            // Summernote init
            $('#description').summernote({
                placeholder: 'Write description here...',
                tabsize: 2,
                height: 200
            });
            $('#why_choose').summernote({
                placeholder: 'Write description here...',
                tabsize: 2,
                height: 200
            });

        });
    </script>

@endsection
