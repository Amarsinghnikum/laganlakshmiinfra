# TODO: Dynamic Field Visibility for Property Types

## Completed Tasks
- [x] Add id="property-type-select" to the Property Type select element.
- [x] Add IDs to the div containers of conditional fields: id="field-area", id="field-bedrooms", id="field-bathrooms", id="field-balconies", id="field-floor", id="field-total-floors", id="field-property-age", id="field-furnishing-status", id="field-facing", id="field-availability-status".
- [x] Add a JavaScript script in @push('scripts') that listens for changes on the select and toggles display of fields based on the selected property type text.
- [x] The script hides all conditional fields by default, then shows only the relevant ones for each type (Apartment/Flat: Area, Bedrooms, Bathrooms, Balconies, Floor, Total Floors; Independent House: Area, Bedrooms, Bathrooms, Total Floors; Villa: Area, Bedrooms, Bathrooms; Plot/Land: Area; Office Space: Area, Floor; Shop: Area; Warehouse: Area, Total Floors).
- [x] On page load, trigger the toggle based on the current selection.

## Next Steps
- [x] Test the functionality to ensure fields show/hide correctly without page reload for all property types.
- [x] Confirm no issues with the implementation and report back.
