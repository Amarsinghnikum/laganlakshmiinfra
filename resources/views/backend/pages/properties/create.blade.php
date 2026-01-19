@extends('backend.layouts.master')

@section('title')
Property - Admin Panel
@endsection

@section('admin-content')
<div class="container">
    <h2>Add New Property</h2>

    <form action="{{ route('admin.properties.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Property Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>SKU</label>
            <input type="text" name="sku" class="form-control" required>
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

        <!-- Sub Category Dropdown (Multiple) -->
        <div class="mb-3" id="subcategory-container">
            <label>Sub Category</label>
            <select name="subcategory_id[]" id="subcategory-select" class="form-control select2" multiple>
            </select>
        </div>

        <div class="mb-3">
            <label>Short Description</label>
            <textarea name="short_description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Meta Keywords</label>
            <textarea name="keywords" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" value="500">
        </div>

        <div class="mb-3">
            <label>Offer Price</label>
            <input type="number" name="price" class="form-control" step="0.01" value="0.00">
        </div>

        <div class="mb-3">
            <label>Selling Price</label>
            <input type="number" name="offer_price" class="form-control" step="0.01" value="0.00" required>
        </div>

        <div class="row">
              <div class="col-md-6 mb-3">
                <label>Discount Amount</label>
                <input type="number" step="0.01" name="discount_amount" class="form-control">
            </div>
            
            <div class="col-md-6 mb-3">
                <label>Minimum Quantity For Discount</label>
                <input type="number" name="min_qty_for_discount" class="form-control">
            </div>          
        </div>

        <div class="mb-3">
            <label>Catalogue PDF</label>
            <input type="file" name="catalogue_pdf" class="form-control" accept="application/pdf">
        </div>

        <div class="mb-3">
            <label>Main Image</label>
            <input type="file" name="main_image" class="form-control">
        </div>

        <div class="mb-3">
            <label>Gallery Images (optional)</label>
            <input type="file" name="gallery_images[]" class="form-control" multiple>
        </div>

        <div class="mb-3">
            <label>Tags (comma separated)</label>
            <input type="text" name="tags" class="form-control">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_featured" class="form-check-input">
            <label class="form-check-label">Featured</label>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" class="form-check-input" checked>
            <label class="form-check-label">Active</label>
        </div>

        <button class="btn btn-success">Save Property</button>
    </form>
</div>
@endsection
@push('scripts')
<script>
function loadSubcategories(categoryIds, selectedSubcategories = []) {

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
                const selected = selectedSubcategories.includes(String(subcat.id)) ?
                    "selected" :
                    "";

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