@extends('backend.layouts.admin')

@section('title')
Property - Admin Panel
@endsection

@section('admin-content')
<div class="container">
    <h2>Add New Property</h2>

    <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- ROW 1 -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Property Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Property For</label>
                <select name="property_for" class="form-control" required>
                    <option value="">Select</option>
                    <option value="sell">Sell</option>
                    <option value="rent">Rent</option>
                </select>
            </div>
        </div>

        <!-- ROW 2 -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Property Type</label>
                <select name="property_type_id" id="property_type_select" class="form-control" required>
                    @foreach($propertyTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Price</label>
                <input type="number" name="price" class="form-control" required>
            </div>
        </div>

        <!-- ROW 3 -->
        <div class="row">
            <div class="col-md-6 mb-3" id="field_area" style="display: none;">
                <label>Area (Sq Ft)</label>
                <input type="number" name="area_sqft" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Price Negotiable</label>
                <select name="price_negotiable" class="form-control">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>
        </div>

        <!-- ROW 4 -->
        <div class="row">
            <div class="col-md-6 mb-3" id="field_bedrooms" style="display: none;">
                <label>Bedrooms</label>
                <input type="number" name="bedrooms" class="form-control">
            </div>

            <div class="col-md-6 mb-3" id="field_bathrooms" style="display: none;">
                <label>Bathrooms</label>
                <input type="number" name="bathrooms" class="form-control">
            </div>
        </div>

        <!-- ROW 5 -->
        <div class="row">
            <div class="col-md-6 mb-3" id="field_balconies" style="display: none;">
                <label>Balconies</label>
                <input type="number" name="balconies" class="form-control">
            </div>

            <div class="col-md-6 mb-3" id="field_floor" style="display: none;">
                <label>Floor</label>
                <input type="number" name="floor" class="form-control">
            </div>
        </div>

        <!-- ROW 6 -->
        <div class="row">
            <div class="col-md-6 mb-3" id="field_total_floors" style="display: none;">
                <label>Total Floors</label>
                <input type="number" name="total_floors" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Property Age (Years)</label>
                <input type="number" name="property_age" class="form-control">
            </div>
        </div>

        <!-- ROW 7 -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Furnishing Status</label>
                <select name="furnishing_status" class="form-control">
                    <option value="unfurnished">Unfurnished</option>
                    <option value="semi-furnished">Semi Furnished</option>
                    <option value="fully-furnished">Fully Furnished</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Facing</label>
                <select name="facing" class="form-control">
                    <option value="">Select</option>
                    <option value="north">North</option>
                    <option value="south">South</option>
                    <option value="east">East</option>
                    <option value="west">West</option>
                </select>
            </div>
        </div>

        <!-- ROW 8 -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Availability Status</label>
                <select name="availability_status" class="form-control">
                    <option value="available">Available</option>
                    <option value="sold">Sold</option>
                    <option value="rented">Rented</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Status (Admin)</label>
                <select name="status" class="form-control">
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>
        </div>

        <!-- DESCRIPTION -->
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4"></textarea>
        </div>

        <!-- IMAGES -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Main Image</label>
                <input type="file" name="main_image" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Gallery Images</label>
                <input type="file" name="gallery_images[]" class="form-control" multiple>
            </div>
        </div>

        <!-- ACTIVE -->
        <div class="form-check mb-3">
            <input type="checkbox" name="is_active" value="1" class="form-check-input" checked>
            <label class="form-check-label">Active</label>
        </div>

        <button class="btn btn-success">Save Property</button>
    </form>

</div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const propertyTypeSelect = document.getElementById('property_type_select');
    const fields = {
        area: document.getElementById('field_area'),
        bedrooms: document.getElementById('field_bedrooms'),
        bathrooms: document.getElementById('field_bathrooms'),
        balconies: document.getElementById('field_balconies'),
        floor: document.getElementById('field_floor'),
        totalFloors: document.getElementById('field_total_floors')
    };

    function hideAllFields() {
        Object.values(fields).forEach(field => {
            field.style.display = 'none';
        });
    }

    function showFieldsForType(typeName) {
        hideAllFields();
        switch (typeName) {
            case 'Apartment / Flat':
                fields.area.style.display = 'block';
                fields.bedrooms.style.display = 'block';
                fields.bathrooms.style.display = 'block';
                fields.balconies.style.display = 'block';
                fields.floor.style.display = 'block';
                fields.totalFloors.style.display = 'block';
                break;
            case 'Independent House':
                fields.area.style.display = 'block';
                fields.bedrooms.style.display = 'block';
                fields.bathrooms.style.display = 'block';
                fields.totalFloors.style.display = 'block';
                break;
            case 'Villa':
                fields.area.style.display = 'block';
                fields.bedrooms.style.display = 'block';
                fields.bathrooms.style.display = 'block';
                break;
            case 'Plot / Land':
                fields.area.style.display = 'block';
                break;
            case 'Office Space':
                fields.area.style.display = 'block';
                fields.floor.style.display = 'block';
                break;
            case 'Shop':
                fields.area.style.display = 'block';
                break;
            case 'Warehouse':
                fields.area.style.display = 'block';
                fields.totalFloors.style.display = 'block';
                break;
        }
    }

    propertyTypeSelect.addEventListener('change', function() {
        const selectedOption = propertyTypeSelect.options[propertyTypeSelect.selectedIndex];
        const typeName = selectedOption.text;
        showFieldsForType(typeName);
    });

    // Initial hide
    hideAllFields();
});
</script>
@endpush
