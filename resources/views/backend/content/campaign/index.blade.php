@extends('backend.master')

@section('maincontent')
    @section('title')
        {{ env('APP_NAME') }}- Landingpage List
    @endsection

    <div class="mt-4 container-fluid">
        <div class="shadow card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Campaign List</h5>
                <a href="{{ route('admin.campaigns.create') }}" class="btn btn-primary btn-sm">Add Campaign</a>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-striped" id="campaignTable" style="border:1px solid #ddd">
                    <thead class="table-dark" style="border:1px solid #ddd">
                        <tr>
                            <th>SL</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price Title</th>
                            <th>Products</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($campaigns as $key => $campaign)
                            <tr>
                                <td>{{ $key + 1 }}</td>

                                <td>
                                    <img src="{{ asset($campaign->image) }}" width="60" height="60" style="object-fit:cover;">
                                </td>

                                <td style="max-width:250px;">
                                    {{ Str::limit($campaign->name, 60) }}
                                </td>

                                <td>
                                    <small class="text-muted d-block">{{ $campaign->oldprice_title }}</small>
                                    <strong>{{ $campaign->price_title }}</strong>
                                </td>

                                <td>
                                    @php
                                        $products = json_decode($campaign->product_id, true);
                                    @endphp

                                    @if($products)
                                        <span class="badge bg-info">
                                            {{ count($products) }} Products
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    @if($campaign->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('campaign', $campaign->slug) }}"
                                        class="btn btn-sm btn-info">Show</a>

                                    <a href="{{ route('admin.campaigns.edit', $campaign->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.campaigns.destroy', $campaign->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure to delete this campaign?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

@endsection