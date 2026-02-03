@extends('backend.layouts.admin')

@section('title')
Property - Admin Panel
@endsection

@section('admin-content')
<div class="container">
    <h2 class="mb-3">Add New Property</h2>

    <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- ROW 1 -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Property Title <span style="color:red">*</span></label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Property For <span style="color:red">*</span></label>
                <select name="property_for" class="form-control" required>
                    <option value="">Select</option>
                    <option value="sell">Sell</option>
                    <option value="rent">Rent</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>State <span class="text-danger">*</span></label>
                <select name="state_id" id="state_id" class="form-control" required>
                    <option value="">Select State</option>
                    @foreach($states as $state)
                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label>City <span class="text-danger">*</span></label>
                <select name="city_id" id="city_id" class="form-control" required>
                    <option value="">Select City</option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label>Location <span class="text-danger">*</span></label>
                <input type="text" name="location" class="form-control" required>
            </div>
        </div>

        <!-- ROW 2 -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Property Type <span style="color:red">*</span></label>
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
                <label>Availability Status <span style="color:red">*</span></label>
                <select name="availability_status" class="form-control">
                    <option value="available">Available</option>
                    <option value="sold">Sold</option>
                    <option value="rented">Rented</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Status (Admin)</label>
                <select name="status" class="form-control" readonly>
                    <option value="pending">Pending</option>
                </select>
            </div>
        </div>

        <!-- DESCRIPTION -->
        <div class="mb-3">
            <label>Description <span style="color:red">*</span></label>
            <textarea name="description" class="form-control" rows="4"></textarea>
        </div>

        <!-- IMAGES & VIDEO -->
        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Main Image <span style="color:red">*</span></label>
                <input type="file" name="main_image" class="form-control" accept="image/*">
            </div>

            <div class="col-md-4 mb-3">
                <label>Gallery Images <span style="color:red">*</span></label>
                <input type="file" name="gallery_images[]" class="form-control" multiple accept="image/*">
            </div>

            <div class="col-md-4 mb-3">
                <label>Property Video</label>
                <input type="file" name="property_video" class="form-control" accept="video/mp4,video/webm,video/ogg">
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
            if (field) field.style.display = 'none';
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

    function applyDefault() {
        const selectedOption = propertyTypeSelect.options[propertyTypeSelect.selectedIndex];
        showFieldsForType(selectedOption.text);
    }

    propertyTypeSelect.addEventListener('change', applyDefault);
    applyDefault();
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const stateSelect = document.getElementById('state_id');
    const citySelect  = document.getElementById('city_id');

    stateSelect.addEventListener('change', function () {
        const stateId = this.value;

        citySelect.innerHTML = '<option value="">Loading...</option>';

        if (!stateId) {
            citySelect.innerHTML = '<option value="">Select City</option>';
            return;
        }

        fetch("{{ route('get.cities') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ state_id: stateId })
        })
        .then(response => response.json())
        .then(data => {
            citySelect.innerHTML = '<option value="">Select City</option>';

            data.forEach(city => {
                citySelect.innerHTML += `<option value="${city.id}">${city.city}</option>`;
            });
        })
        .catch(() => {
            citySelect.innerHTML = '<option value="">Error loading cities</option>';
        });
    });

});
</script>
@endpush