@extends('backend.layouts.admin')

@section('title')
Property - Admin Panel
@endsection

@section('admin-content')
<div class="container">
    <h2 class="mb-3">Edit Property</h2>

    <form action="{{ route('user.properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Property Title <span style="color:red">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $property->title) }}"
                    required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Property For <span style="color:red">*</span></label>
                <select name="property_for" class="form-control" required>
                    <option value="">Select</option>
                    <option value="buy" {{ $property->dynamic_data['property_for'] == 'buy' ? 'selected' : '' }}>Buy
                    </option>
                    <option value="sell" {{ $property->dynamic_data['property_for'] == 'sell' ? 'selected' : '' }}>Sell
                    </option>
                    <option value="rent" {{ $property->dynamic_data['property_for'] == 'rent' ? 'selected' : '' }}>Rent
                    </option>
                </select>
            </div>
        </div>

        @php
        $selectedState = old('state_id', $property->dynamic_data['state_id'] ?? '');
        $selectedCity = old('city_id', $property->dynamic_data['city_id'] ?? '');
        @endphp
        <input type="hidden" id="selected_state" value="{{ $selectedState }}">
        <input type="hidden" id="selected_city" value="{{ $selectedCity }}">

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>State <span class="text-danger">*</span></label>
                <select name="state_id" id="state_id" class="form-control select2" required>
                    <option value="">Select State</option>
                    @foreach($states as $state)
                    <option value="{{ $state->id }}" {{ $selectedState == $state->id ? 'selected' : '' }}>
                        {{ $state->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label>City <span class="text-danger">*</span></label>
                <select name="city_id" id="city_id" class="form-control select2" required>
                    @if($selectedCity)
                    <option value="{{ $selectedCity }}" selected>
                        {{ $property->city->city ?? 'Selected City' }}
                    </option>
                    @else
                    <option value="">Select City</option>
                    @endif
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label>Location <span class="text-danger">*</span></label>
                <input type="text" name="location" class="form-control"
                    value="{{ old('location', $property->dynamic_data['location']) }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Property Type <span style="color:red">*</span></label>
                <select name="property_type_id" id="property_type_select" class="form-control" required>
                    @foreach($propertyTypes as $type)
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

        <div class="row">
            <div class="col-md-6 mb-3" id="field_area" style="display: none;">
                <label>Area (Sq Ft)</label>
                <input type="number" name="area_sqft" class="form-control"
                    value="{{ old('area_sqft', $property->dynamic_data['area_sqft']) }}">
            </div>

            @php
            $priceNegotiable = old('price_negotiable', $property->dynamic_data['price_negotiable'] ?? '');
            @endphp
            <div class="col-md-6 mb-3">
                <label>Price Negotiable</label>
                <select name="price_negotiable" class="form-control">
                    <option value="">Select</option>
                    <option value="No" {{ $priceNegotiable === 'No'  ? 'selected' : '' }}>No</option>
                    <option value="Yes" {{ $priceNegotiable === 'Yes' ? 'selected' : '' }}>Yes</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3" id="field_bedrooms" style="display: none;">
                <label>Bedrooms</label>
                <input type="number" name="bedrooms" class="form-control"
                    value="{{ old('bedrooms', $property->dynamic_data['bedrooms']) }}">
            </div>

            <div class="col-md-6 mb-3" id="field_bathrooms" style="display: none;">
                <label>Bathrooms</label>
                <input type="number" name="bathrooms" class="form-control"
                    value="{{ old('bathrooms', $property->dynamic_data['bathrooms']) }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3" id="field_balconies" style="display: none;">
                <label>Balconies</label>
                <input type="number" name="balconies" class="form-control"
                    value="{{ old('bathrooms', $property->dynamic_data['balconies']) }}">
            </div>

            <div class="col-md-6 mb-3" id="field_floor" style="display: none;">
                <label>Floor</label>
                <input type="number" name="floor" class="form-control"
                    value="{{ old('bathrooms', $property->dynamic_data['floor']) }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3" id="field_total_floors" style="display: none;">
                <label>Total Floors</label>
                <input type="number" name="total_floors" class="form-control"
                    value="{{ old('bathrooms', $property->dynamic_data['total_floors']) }}">
            </div>

            <div class="col-md-6 mb-3" id="property_age" style="display: none;">
                <label>Property Age (Years)</label>
                <input type="number" name="property_age" class="form-control"
                    value="{{ old('bathrooms', $property->dynamic_data['property_age'] ?? '') }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3" id="furnishing_status" style="display: none;">
                <label>Furnishing Status</label>
                @php
                $furnishing = old(
                'furnishing_status',
                $property->dynamic_data['furnishing_status'] ?? ''
                );
                @endphp
                <select name="furnishing_status" class="form-control">
                    <option value="">Select Furnishing Status</option>
                    <option value="unfurnished" {{ $furnishing === 'unfurnished' ? 'selected' : '' }}>
                        Unfurnished
                    </option>

                    <option value="semi-furnished" {{ $furnishing === 'semi-furnished' ? 'selected' : '' }}>
                        Semi Furnished
                    </option>

                    <option value="fully-furnished" {{ $furnishing === 'fully-furnished' ? 'selected' : '' }}>
                        Fully Furnished
                    </option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Facing</label>
                @php
                $facing = old(
                'facing',
                $property->dynamic_data['facing'] ?? ''
                );
                @endphp
                <select name="facing" class="form-control">
                    <option value="">Select</option>
                    <option value="north" {{ $facing === 'north' ? 'selected' : '' }}>North</option>
                    <option value="south" {{ $facing === 'south' ? 'selected' : '' }}>South</option>
                    <option value="east" {{ $facing === 'east' ? 'selected' : '' }}>East</option>
                    <option value="west" {{ $facing === 'west' ? 'selected' : '' }}>West</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Availability Status <span style="color:red">*</span></label>
                @php
                $availabilityStatus = old(
                'availability_status',
                $property->dynamic_data['availability_status'] ?? 'available'
                );
                @endphp

                <select name="availability_status" class="form-control">
                    <option value="available" {{ $availabilityStatus === 'available' ? 'selected' : '' }}>
                        Available
                    </option>
                    <option value="sold" {{ $availabilityStatus === 'sold' ? 'selected' : '' }}>
                        Sold
                    </option>
                    <option value="rented" {{ $availabilityStatus === 'rented' ? 'selected' : '' }}>
                        Rented
                    </option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Status (Admin)</label>
                @php
                $status = old('status', $property->dynamic_data['status'] ?? 'pending');
                @endphp

                <select class="form-control" disabled>
                    <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>{{$status}}</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label>Description <span style="color:red">*</span></label>
            <textarea name="description" class="form-control" rows="4">
                {{ old('description', $property->dynamic_data['description'] ?? '') }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Main Image <span style="color:red">*</span></label>
                <input type="file" name="main_image" class="form-control" accept="image/*">

                @if(!empty($property->dynamic_data['main_image']))
                <img src="{{ asset($property->dynamic_data['main_image']) }}" class="img-thumbnail mt-2" width="120">
                @endif
            </div>

            <div class="col-md-4 mb-3">
                <label>Gallery Images</label>
                <input type="file" name="gallery_images[]" class="form-control" multiple accept="image/*">

                @if(!empty($property->dynamic_data['gallery_images']))
                <div class="d-flex flex-wrap gap-2 mt-2">
                    @foreach($property->dynamic_data['gallery_images'] as $img)
                    <img src="{{ asset($img) }}" width="80" class="img-thumbnail">
                    @endforeach
                </div>
                @endif
            </div>

            <div class="col-md-4 mb-3">
                <label>Property Video</label>
                <input type="file" name="property_video" class="form-control" accept="video/mp4,video/webm,video/ogg">

                @if(!empty($property->dynamic_data['property_video']))
                <video width="180" controls class="mt-2">
                    <source src="{{ asset($property->dynamic_data['property_video']) }}">
                </video>
                @endif
            </div>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_active" value="1" class="form-check-input"
                {{ $property->is_active ? 'checked' : '' }}>
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
        totalFloors: document.getElementById('field_total_floors'),
        propertyAge: document.getElementById('property_age'),
        furnishingStatus: document.getElementById('furnishing_status')
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
                fields.propertyAge.style.display = 'block';
                fields.furnishingStatus.style.display = 'block';
                break;

            case 'Independent House':
                fields.area.style.display = 'block';
                fields.bedrooms.style.display = 'block';
                fields.bathrooms.style.display = 'block';
                fields.totalFloors.style.display = 'block';
                fields.propertyAge.style.display = 'block';
                fields.furnishingStatus.style.display = 'block';
                break;

            case 'Villa':
                fields.area.style.display = 'block';
                fields.bedrooms.style.display = 'block';
                fields.bathrooms.style.display = 'block';
                fields.propertyAge.style.display = 'block';
                fields.furnishingStatus.style.display = 'block';
                break;

            case 'Plot / Land':
                fields.area.style.display = 'block';
                break;

            case 'Office Space':
                fields.area.style.display = 'block';
                fields.floor.style.display = 'block';
                fields.propertyAge.style.display = 'block';
                fields.furnishingStatus.style.display = 'block';
                break;

            case 'Shop':
                fields.area.style.display = 'block';
                fields.propertyAge.style.display = 'block';
                fields.furnishingStatus.style.display = 'block';
                break;

            case 'Warehouse':
                fields.area.style.display = 'block';
                fields.totalFloors.style.display = 'block';
                fields.propertyAge.style.display = 'block';
                fields.furnishingStatus.style.display = 'block';
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
$(document).ready(function() {

    $('#state_id, #city_id').select2({
        width: '100%'
    });

    let selectedState = $('#selected_state').val();
    let selectedCity = $('#selected_city').val();

    function loadCities(stateId, selectedCity = null) {
        $('#city_id').html('<option value="">Loading...</option>').trigger('change');

        $.ajax({
            url: "{{ route('get.cities') }}",
            type: "POST",
            data: {
                state_id: stateId,
                _token: "{{ csrf_token() }}"
            },
            success: function(data) {

                let options = '<option value="">Select City</option>';

                data.forEach(function(city) {
                    options += `<option value="${city.id}">${city.city}</option>`;
                });

                $('#city_id').html(options);

                if (selectedCity) {
                    $('#city_id').val(selectedCity).trigger('change');
                }
            }
        });
    }

    // ✅ Edit page: auto-load cities
    if (selectedState) {
        loadCities(selectedState, selectedCity);
    }

    // ✅ On state change
    $('#state_id').on('change', function() {
        let stateId = $(this).val();

        if (!stateId) {
            $('#city_id').html('<option value="">Select City</option>').trigger('change');
            return;
        }

        loadCities(stateId);
    });

});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');

    form.addEventListener('submit', function(e) {
        let valid = true;

        form.querySelectorAll('.error-message').forEach(el => el.remove());
        form.querySelectorAll('.error').forEach(el => el.classList.remove('error'));

        function showError(element, message) {
            element.classList.add('error');
            const error = document.createElement('div');
            error.className = 'error-message';
            error.style.color = 'red';
            error.style.fontSize = '0.875rem';
            error.textContent = message;
            element.parentNode.appendChild(error);
        }

        const title = form.querySelector('input[name="title"]');
        if (!title.value.trim()) {
            valid = false;
            showError(title, 'Property Title is required.');
        }

        const propertyFor = form.querySelector('select[name="property_for"]');
        if (!propertyFor.value) {
            valid = false;
            showError(propertyFor, 'Please select Property For.');
        }

        const propertyType = form.querySelector('select[name="property_type_id"]');
        if (!propertyType.value) {
            valid = false;
            showError(propertyType, 'Please select Property Type.');
        }

        const availability = form.querySelector('select[name="availability_status"]');
        if (!availability.value) {
            valid = false;
            showError(availability, 'Please select Availability Status.');
        }

        const description = form.querySelector('textarea[name="description"]');
        if (!description.value.trim()) {
            valid = false;
            showError(description, 'Description is required.');
        }

        const mainImage = form.querySelector('input[name="main_image"]');
        if (!mainImage.files.length) {
            valid = false;
            showError(mainImage, 'Please upload Main Image.');
        }

        if (!valid) {
            e.preventDefault();
        }
    });
});
</script>
@endpush