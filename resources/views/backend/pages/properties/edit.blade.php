@extends('backend.layouts.admin')

@section('title')
Property - Admin Panel
@endsection

@section('admin-content')
<div class="container">
    <h2>Edit Property</h2>

    <form action="{{ route('properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- ROW 1 -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Property Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $property->title) }}"
                    required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Property For</label>
                <select name="property_for" class="form-control" required>
                    <option value="">Select</option>
                    <option value="sell" {{ $property->property_for == 'sell' ? 'selected' : '' }}>Sell</option>
                    <option value="rent" {{ $property->property_for == 'rent' ? 'selected' : '' }}>Rent</option>
                </select>
            </div>
        </div>

        <!-- ROW 2 -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Property Type</label>
                <select id="property-type-select" name="property_type_id" class="form-control" required>
                    @foreach($propertytypes as $type)
                    <option value="{{ $type->id }}" {{ $property->property_type_id == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Price</label>
                <input type="number" name="price" class="form-control" value="{{ old('price', $property->price) }}"
                    required>
            </div>
        </div>

        <!-- ROW 3 -->
        <div class="row">
            <div id="field-area" class="col-md-6 mb-3">
                <label>Area (Sq Ft)</label>
                <input type="number" name="area_sqft" class="form-control"
                    value="{{ old('area_sqft', $property->area_sqft) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Price Negotiable</label>
                <select name="price_negotiable" class="form-control">
                    <option value="0" {{ $property->price_negotiable == 0 ? 'selected' : '' }}>No</option>
                    <option value="1" {{ $property->price_negotiable == 1 ? 'selected' : '' }}>Yes</option>
                </select>
            </div>
        </div>

        <!-- ROW 4 -->
        <div class="row">
            <div id="field-bedrooms" class="col-md-6 mb-3">
                <label>Bedrooms</label>
                <input type="number" name="bedrooms" class="form-control"
                    value="{{ old('bedrooms', $property->bedrooms) }}">
            </div>

            <div id="field-bathrooms" class="col-md-6 mb-3">
                <label>Bathrooms</label>
                <input type="number" name="bathrooms" class="form-control"
                    value="{{ old('bathrooms', $property->bathrooms) }}">
            </div>
        </div>

        <!-- ROW 5 -->
        <div class="row">
            <div id="field-balconies" class="col-md-6 mb-3">
                <label>Balconies</label>
                <input type="number" name="balconies" class="form-control"
                    value="{{ old('balconies', $property->balconies) }}">
            </div>

            <div id="field-floor" class="col-md-6 mb-3">
                <label>Floor</label>
                <input type="number" name="floor" class="form-control" value="{{ old('floor', $property->floor) }}">
            </div>
        </div>

        <!-- ROW 6 -->
        <div class="row">
            <div id="field-total-floors" class="col-md-6 mb-3">
                <label>Total Floors</label>
                <input type="number" name="total_floors" class="form-control"
                    value="{{ old('total_floors', $property->total_floors) }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Property Age (Years)</label>
                <input type="number" name="property_age" class="form-control"
                    value="{{ old('property_age', $property->property_age) }}">
            </div>
        </div>

        <!-- ROW 7 -->
        <div class="row">
            <div id="field-furnishing-status" class="col-md-6 mb-3">
                <label>Furnishing Status</label>
                <select name="furnishing_status" class="form-control">
                    <option value="unfurnished" {{ $property->furnishing_status == 'unfurnished' ? 'selected' : '' }}>
                        Unfurnished</option>
                    <option value="semi-furnished"
                        {{ $property->furnishing_status == 'semi-furnished' ? 'selected' : '' }}>Semi Furnished</option>
                    <option value="fully-furnished"
                        {{ $property->furnishing_status == 'fully-furnished' ? 'selected' : '' }}>Fully Furnished
                    </option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Facing</label>
                <select name="facing" class="form-control">
                    <option value="">Select</option>
                    <option value="north" {{ $property->facing == 'north' ? 'selected' : '' }}>North</option>
                    <option value="south" {{ $property->facing == 'south' ? 'selected' : '' }}>South</option>
                    <option value="east" {{ $property->facing == 'east' ? 'selected' : '' }}>East</option>
                    <option value="west" {{ $property->facing == 'west' ? 'selected' : '' }}>West</option>
                </select>
            </div>
        </div>

        <!-- ROW 8 -->
        <div class="row">
            <div id="field-availability-status" class="col-md-6 mb-3">
                <label>Availability Status</label>
                <select name="availability_status" class="form-control">
                    <option value="available" {{ $property->availability_status == 'available' ? 'selected' : '' }}>
                        Available</option>
                    <option value="sold" {{ $property->availability_status == 'sold' ? 'selected' : '' }}>Sold</option>
                    <option value="rented" {{ $property->availability_status == 'rented' ? 'selected' : '' }}>Rented
                    </option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Status (Admin)</label>
                <select name="status" class="form-control">
                    <option value="pending" {{ $property->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ $property->status == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ $property->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
        </div>

        <!-- DESCRIPTION -->
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"
                rows="4">{{ old('description', $property->description) }}</textarea>
        </div>

        <!-- IMAGES -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Main Image</label><br>
                @if($property->main_image)
                <img src="{{ asset('storage/'.$property->main_image) }}" width="120" class="mb-2">
                @endif
                <input type="file" name="main_image" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Gallery Images</label>
                <input type="file" name="gallery_images[]" class="form-control" multiple>
            </div>
        </div>

        <!-- ACTIVE -->
        <div class="form-check mb-3">
            <input type="checkbox" name="is_active" value="1" class="form-check-input"
                {{ $property->is_active ? 'checked' : '' }}>
            <label class="form-check-label">Active</label>
        </div>

        <button class="btn btn-success">Update Property</button>
    </form>

</div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const select = document.getElementById('property-type-select');
    const fields = {
        area: document.getElementById('field-area'),
        bedrooms: document.getElementById('field-bedrooms'),
        bathrooms: document.getElementById('field-bathrooms'),
        balconies: document.getElementById('field-balconies'),
        floor: document.getElementById('field-floor'),
        totalFloors: document.getElementById('field-total-floors')
    };

    function toggleFields() {
        const selectedType = select.options[select.selectedIndex].text.trim();
        // Hide all conditional fields
        Object.values(fields).forEach(field => field.style.display = 'none');
        // Show fields based on selected type
        switch(selectedType) {
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

    select.addEventListener('change', toggleFields);
    // Initial toggle on page load
    toggleFields();
});
</script>
@endpush
