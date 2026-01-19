@extends('backend.layouts.master')

@section('title')
Property - Admin Panel
@endsection

@section('admin-content')
<div class="container">
    <h2>Edit Property</h2>

    <form action="{{ route('admin.properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Property Name</label>
            <input type="text" name="name" class="form-control" value="{{ $property->name }}" required>
        </div>

        <div class="mb-3">
            <label>SKU</label>
            <input type="text" name="sku" class="form-control" value="{{ $property->sku }}" required>
        </div>

        <!-- Category Dropdown -->
        <div class="mb-3">
            <label>Category</label>
            <select name="category_id[]" id="category-select" class="form-control select2" multiple required>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" @if(in_array($cat->id, $property->category_id)) selected @endif>
                    {{ $cat->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Sub Category Dropdown -->
        <div class="mb-3" id="subcategory-container">
            <label>Sub Category</label>
            <select name="subcategory_id[]" id="subcategory-select" class="form-control select2" multiple></select>
        </div>

        <div class="mb-3">
            <label>Short Description</label>
            <textarea name="short_description" class="form-control">{{ $property->short_description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $property->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Meta Keywords</label>
            <textarea name="keywords" class="form-control">{{ $property->keywords }}</textarea>
        </div>

        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" value="{{ $property->quantity }}">
        </div>

        <div class="mb-3">
            <label>Offer Price</label>
            <input type="number" name="price" class="form-control" value="{{ $property->price }}">
        </div>

        <div class="mb-3">
            <label>Selling Price</label>
            <input type="number" name="offer_price" class="form-control" value="{{ $property->offer_price }}">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Discount Amount</label>
                <input type="number" step="0.01" name="discount_amount" class="form-control"
                    value="{{ $property->discount_amount }}">
                <small class="text-muted">
                    Enter the discount amount that will be applied when minimum quantity is purchased.
                </small>
            </div>

            <div class="col-md-6 mb-3">
                <label>Minimum Quantity For Discount</label>
                <input type="number" step="0.01" name="min_qty_for_discount" class="form-control"
                    value="{{ $property->min_qty_for_discount }}">
                <small class="text-muted">
                    Enter the minimum quantity the customer must buy to receive the above discount.
                </small>
            </div>
        </div>

        <div class="mb-3">
            <label>Catalogue PDF</label>
            <input type="file" name="catalogue_pdf" class="form-control" accept="application/pdf">
            @if ($property->catalogue_pdf)
            <div class="mt-2">
                <p>Current Catalogue PDF:</p>
                <a href="{{ asset('public/'.$property->catalogue_pdf) }}" target="_blank">
                    View Current PDF
                </a>
            </div>
            @endif
        </div>

        <div class="mb-3">
            <label>Change Main Image</label>
            <input type="file" name="main_image" class="form-control">

            @if ($property->main_image)
            <div class="mt-2">
                <p>Current Image:</p>
                <img src="{{ asset($property->main_image) }}" alt="Main Image" width="150">
            </div>
            @endif
        </div>

        <div class="mb-3">
            <label>Gallery Images</label>
            <input type="file" name="gallery_images[]" class="form-control" multiple>

            @if ($property->gallery_images)
            <div class="mt-2">
                <p>Current Gallery Images:</p>
                <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                    @foreach (json_decode($property->gallery_images, true) as $galleryImg)
                    <img src="{{ asset($galleryImg) }}" alt="Gallery Image" width="100">
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <div class="mb-3">
            <label>Tags</label>
            <input type="text" name="tags" class="form-control" value="{{ $property->tags }}">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_featured" class="form-check-input"
                {{ $property->is_featured ? 'checked' : '' }}>
            <label class="form-check-label">Featured</label>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" class="form-check-input" {{ $property->is_active ? 'checked' : '' }}>
            <label class="form-check-label">Active</label>
        </div>

        <button class="btn btn-primary">Update Property</button>
    </form>
</div>
@endsection
@push('scripts')
<script>
function loadSubcategories(categoryIds, selectedSubIds = []) {

    $.ajax({
        url: "{{ url('/admin/get-subcategories') }}",
        type: "POST",
        data: {
            category_ids: categoryIds,
            _token: "{{ csrf_token() }}"
        },
        success: function(response) {
            const subSelect = $("#subcategory-select");
            subSelect.empty();

            response.forEach(function(subcat) {
                const selected = selectedSubIds.includes(String(subcat.id)) ? "selected" : "";
                subSelect.append(
                    `<option value="${subcat.id}" ${selected}>${subcat.name}</option>`
                );
            });
        }
    });
}

$(document).ready(function() {

    $("#category-select").on("change", function() {
        const categoryIds = $(this).val() || [];
        loadSubcategories(categoryIds);
    });

    const selectedCategories = @json($property->category_id);
    const selectedSubcategories = @json($property->subcategory_id);

    loadSubcategories(selectedCategories, selectedSubcategories);
});
</script>
@endpush