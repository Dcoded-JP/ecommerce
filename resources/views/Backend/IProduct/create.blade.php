@extends('Backend.layouts.backend')

@section('title')
Create I-Product
@endsection


@section('content')
<!-- Main Content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{Route('iproduct.index')}}" class="btn btn-primary"><i class="fa-solid fa-list"></i>
                            iProduct List</a>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3> Add <i>iProduct</i></h3>
                    </div>
                    <div class="card-body">
                        <form action="{{Route('iproduct.store')}}" class="form" method="POST"
                            enctype="multipart/form-data"
                            style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
                            @csrf

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="sku" class="mb-1 bold text-capitalize">SKU</label>
                                            <input type="text" name="sku" id="sku" placeholder="Enter SKU"
                                                class="form-control" required value="{{old('sku')}}">
                                            @error('sku')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="product_name" class="mb-1 bold text-capitalize">Product
                                                Name</label>
                                            <input type="text" name="product_name" id="product_name"
                                                placeholder="Enter Product Name" class="form-control" required
                                                value="{{old('product_name')}}">
                                            @error('product_name')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="sub_title" class="mb-1 bold text-capitalize">Sub Title</label>
                                            <input type="text" name="sub_title" id="sub_title"
                                                placeholder="Enter Sub Title" class="form-control" required
                                                value="{{old('sub_title')}}">
                                            @error('sub_title')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="description"
                                                class="mb-1 bold text-capitalize">description</label>
                                            <textarea class="form-control" name="description" id="description" rows="5"
                                                placeholder="Enter Description"
                                                required>{{old('description')}}</textarea>
                                            @error('description')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="price" class="mb-1 bold text-capitalize">price</label>



                                                <input type="text" name="price" id="price" class="form-control" required
                                                    value="{{ old('price') }}">


                                               @error('price')
                                               <div class="text-danger d-block">{{$message}}</div>
                                               @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="category_id" class="mb-1 bold text-capitalize">Category</label>
                                            <select name="category_id" id="category_id" class="form-select" required>
                                                <option value="">--Select--</option>
                                                @if($category)
                                                @foreach ($category as $cat)
                                                <option value="{{$cat->id}}"
                                                    {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                                    {{$cat->category_name}}</option>
                                                @endforeach
                                                @endif
                                                {{-- <option value=""></option>
                                                --}}
                                            </select>
                                            @error('category_id')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="color_id" class="mb-1 bold text-capitalize">Colors</label>
                                            <select name="color_id[]" id="color_id" class="form-select select2"
                                                multiple required>
                                                @if($color)
                                                @foreach ($color as $col)
                                                <option value="{{$col->id}}"
                                                    {{ (collect(old('color_id'))->contains($col->id)) ? 'selected' : '' }}>
                                                    {{$col->color_name}}
                                                </option>
                                                @endforeach
                                                @endif
                                            </select>
                                            @error('color_id')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="size_id" class="mb-1 bold text-capitalize">Sizes</label>
                                            <select name="size_id[]" id="size_id" class="form-select select2" multiple required>
                                                @if($size)
                                                @foreach ($size as $sz)
                                                <option value="{{$sz->id}}"
                                                    {{ (collect(old('size_id'))->contains($sz->id)) ? 'selected' : '' }}>
                                                    {{$sz->size_name}}
                                                </option>
                                                @endforeach
                                                @endif
                                            </select>
                                            @error('size_id')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="have_img" class="mb-1 bold text-capitalize">Images</label>
                                            <select name="have_img" id="have_img" class="form-select">
                                                <option value="">--Select--</option>
                                                <option value="0" {{old('have_img') == "0" ? 'selected' : '' }}>No</option>
                                                <option value="1" {{old('have_img') == "1" ? 'selected' : '' }}>Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="imageContainer card p-4 shadow">

                            </div>




                            <div class="row">

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-plus"></i> Add
                                        I-Product</button>
                                    <button type="reset" class="btn btn-dark">Clear</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection

@push('js')
<script>
const imageContainer = document.querySelector('.imageContainer');
const haveImg = document.getElementById('have_img');
let imageRowCount = 0;

// Hide image container initially
imageContainer.style.display = 'none';

// Listen for select changes
haveImg.addEventListener('change', function() {
    if (this.value === '1') { // Yes selected
        imageContainer.style.display = 'block';
        // Add initial row if container is empty
        if (imageContainer.children.length === 0) {
            addImageRow();
            addAddButton();
        }
    } else {
        imageContainer.style.display = 'none';
        imageContainer.innerHTML = ''; // Clear container
        imageRowCount = 0;
    }
});

function addAddButton() {
    const buttonRow = document.createElement('div');
    buttonRow.className = 'row mt-2';
    buttonRow.innerHTML = `
        <div class="col-md-12">
            <button type="button" class="btn btn-outline-primary" id="addImageBtn">
                <i class="fa-solid fa-plus"></i> Add Image
            </button>
        </div>
    `;
    imageContainer.appendChild(buttonRow);

    // Add click event for the new button
    document.getElementById('addImageBtn').addEventListener('click', addImageRow);
}

function addImageRow() {
    const row = document.createElement('div');
    row.className = 'row mt-3 image-row';

    row.innerHTML = `
        <div class="col-md-6">
            <div class="">
                <div class="form-group  p-2">
                    <label class="mb-1 bold text-capitalize">Product Image</label>
                    <input type="file" name="product_img[${imageRowCount}]"
                           class="form-control product-image-input"
                           accept="image/png, image/jpeg, image/jpg, image/webp">
                           @error('product_img[${imageRowCount}]')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                                            <button type="button" class="btn btn-danger remove-row">
                <i class="fa-solid fa-times"></i>
            </button>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class=" preview-container" style="display: none;">
                <img src="#"
                     class="product-preview-image"
                     style="max-height: 150px;">
            </div>
        </div>

    `;

    // Insert new row before the "Add More" button
    const addButton = document.getElementById('addImageBtn');
    if (addButton) {
        addButton.parentElement.parentElement.before(row);
    } else {
        imageContainer.appendChild(row);
    }

    // Add image preview functionality
    const imageInput = row.querySelector('.product-image-input');
    const previewContainer = row.querySelector('.preview-container');
    const previewImage = row.querySelector('.product-preview-image');

    imageInput.addEventListener('change', function(e) {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = 'inline-block'; // Show preview
            }
            reader.readAsDataURL(file);
        } else {
            previewContainer.style.display = 'none'; // Hide preview
        }
    });

    // Add remove functionality
    row.querySelector('.remove-row').addEventListener('click', function() {
        row.remove();
        if (imageContainer.querySelectorAll('.image-row').length === 0) {
            addImageRow();
        }
    });

    imageRowCount++;
}

// Form Validation
document.addEventListener('DOMContentLoaded', function() {
    const validations = {
        sku: {
            pattern: /^[A-Za-z0-9-_]{3,20}$/,
            message: 'SKU must be 3-20 characters and can contain letters, numbers, - and _'
        },
        product_name: {
            pattern: /^[A-Za-z0-9\s-]{3,100}$/,
            message: 'Product name must be 3-100 characters long'
        },
        sub_title: {
            pattern: /^[A-Za-z0-9\s-]{3,100}$/,
            message: 'Sub title must be 3-100 characters long'
        },
        price: {
            pattern: /^\d+(\.\d{1,2})?$/,
            message: 'Please enter a valid price (e.g., 99.99)'
        },
        description: {
            pattern: /^[\s\S]{10,500}$/,
            message: 'Description must be between 10 and 500 characters'
        }
    };

    // Add validation to each input
    Object.keys(validations).forEach(fieldId => {
        const element = document.getElementById(fieldId);
        if (element) {
            element.addEventListener('blur', function() {
                validateField(this, validations[fieldId]);
            });

            // Remove error on input
            element.addEventListener('input', function() {
                this.classList.remove('error');
                this.classList.remove('is-invalid');
                const errorDiv = this.parentElement.querySelector('.validation-error');
                if (errorDiv) {
                    errorDiv.remove();
                }
            });
        }
    });

    // Select2 validation
    $('.select2').on('change', function() {
        const id = $(this).attr('id');
        if (!$(this).val() || $(this).val().length === 0) {
            $(this).next('.select2-container').find('.select2-selection').addClass('error');
            showError(this, `Please select ${id.replace('_id', '')}`);
        } else {
            $(this).next('.select2-container').find('.select2-selection').removeClass('error');
            removeError(this);
        }
    });

    // Form submit validation
    document.querySelector('form').addEventListener('submit', function(e) {
        let isValid = true;

        // Validate text inputs
        Object.keys(validations).forEach(fieldId => {
            const element = document.getElementById(fieldId);
            if (element && !validateField(element, validations[fieldId])) {
                isValid = false;
            }
        });

        // Validate select2 fields
        ['color_id', 'size_id'].forEach(fieldId => {
            const element = $(`#${fieldId}`);
            if (!element.val() || element.val().length === 0) {
                element.next('.select2-container').find('.select2-selection').addClass('error');
                showError(element[0], `Please select ${fieldId.replace('_id', '')}`);
                isValid = false;
            }
        });

        if (!isValid) {
            e.preventDefault();
            // Scroll to first error
            const firstError = document.querySelector('.error, .is-invalid');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });
});

function validateField(element, validation) {
    const value = element.value.trim();
    if (!validation.pattern.test(value)) {
        showError(element, validation.message);
        return false;
    }
    removeError(element);
    return true;
}

function showError(element, message) {
    element.classList.add('error');
    element.classList.add('is-invalid');

    // Remove existing error message if any
    removeError(element);

    // Add new error message
    const errorDiv = document.createElement('div');
    errorDiv.className = 'validation-error';
    errorDiv.textContent = message;
    element.parentElement.appendChild(errorDiv);

    // Add shake animation
    element.classList.add('shake');
    setTimeout(() => element.classList.remove('shake'), 500);
}

function removeError(element) {
    element.classList.remove('error');
    element.classList.remove('is-invalid');
    const errorDiv = element.parentElement.querySelector('.validation-error');
    if (errorDiv) {
        errorDiv.remove();
    }
}
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Select options",
        allowClear: true,
        width: '100%',
        height: '100%',
    });
});

document.getElementById("price").addEventListener("blur", function() {
    var regex = /^\d+(\.\d{1,2})?$/; // Allows numbers with up to two decimal places
    var value = this.value;

    if (!regex.test(value)) {
            this.classList.add("error"); // Add red border
        } else {
            this.classList.remove("error"); // Remove red border if valid
        }
});

</script>
@endpush

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .error {
        border-color: red;
        outline-color: red;
    }
/* Select2 Container Styling */
.select2-container--default .select2-selection--multiple {
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    padding: 0.25rem 0.5rem;
    min-height: 42px;
    background-color: #fff;
    transition: all 0.2s ease-in-out;
}

/* Focus State */
.select2-container--default.select2-container--focus .select2-selection--multiple {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    outline: 0;
}

/* Selected Items Styling */
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background: #033f9a;
    border: none;
    color: white;
    border-radius: 50px;
    padding: 4px 12px;
    margin: 2px 4px;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    transition: all 0.2s ease;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice:hover {
    background: #010e22;
    color:white;
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
}

/* Remove Button Styling */
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: rgba(255, 255, 255, 0.8);
    margin-right: 6px;
    padding: 0 4px;
    border-right: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.2s ease;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
    background: none;
    color: #fff;
}

/* Dropdown Styling */
.select2-dropdown {
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.select2-container--default .select2-results__option--highlighted[aria-selected] {
    background-color: #0d6efd;
}

/* Search Box Styling */
.select2-search__field {
    border: 1px solid #dee2e6 !important;
    border-radius: 0.25rem !important;
    padding: 0.375rem 0.75rem !important;
}

.select2-search__field:focus {
    border-color: #86b7fe !important;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25) !important;
    outline: 0 !important;
}

/* Placeholder Styling */
.select2-container--default .select2-selection--multiple .select2-selection__placeholder {
    color: #6c757d;
    font-size: 0.875rem;
}

/* Disabled State */
.select2-container--default.select2-container--disabled .select2-selection--multiple {
    background-color: #e9ecef;
    cursor: not-allowed;
}

/* Clear All Button */
.select2-container--default .select2-selection--multiple .select2-selection__clear {
    margin-right: 10px;
    color: #6c757d;
    font-size: 1.2em;
    padding: 0 4px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.select2-container--default .select2-selection--multiple .select2-selection__clear:hover {
    color: #dc3545;
}

.product-preview-image {
    max-width: 100%;
    height: auto;
    border-radius: var(--border-radius-md);
    box-shadow: var(--shadow-sm);
    transition: all 0.3s ease;
    border: 2px solid var(--border-color);
    padding: 1px;
}

.remove-row {
    margin-top: 32px;
}
/* Improved Select2 Multi-Select Styling */
.select2-container--default .select2-selection--multiple {
    border: 1px solid #ced4da;
    border-radius: 4px;
    min-height: 38px;
    padding: 2px 8px;
    background-color: #fff;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.select2-container--default.select2-container--focus .select2-selection--multiple {
    border-color: #80bdff;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #e9ecef;
    border: 1px solid #ced4da;
    border-radius: 3px;
    color: #495057;
    padding: 8px;
    margin: 3px;
    font-size: 0.875rem;
    display: inline-flex;
    align-items: center;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    padding: 2px 0px;
    color: #6c757d;
    margin-right: 5px;
    border-right: none;
    order: -1;
    margin-bottom: 2px;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
    color: #dc3545;
    background: transparent;
}

.select2-container--default .select2-results__option--highlighted[aria-selected] {
    background-color: #091c30;
}

.select2-dropdown {
    border: 1px solid #ced4da;
    border-radius: 4px;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
}

/* Form General Styling */
.form-control, .form-select {
    border-radius: 4px;
    padding: 0.375rem 0.75rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-control:focus, .form-select:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

/* Image Upload Section */
.imageContainer {
    background-color: #f8f9fa;
    border-radius: 4px;
    margin-bottom: 1rem;
    display: none;
}

.image-row {
    padding: 15px;
    background-color: white;
    border-radius: 4px;
    margin-bottom: 10px;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.preview-container {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    border: 1px dashed #dee2e6;
    border-radius: 4px;
    padding: 10px;
}

.product-preview-image {
    max-height: 150px;
    max-width: 100%;
    object-fit: contain;
    border-radius: 4px;
}

.remove-row {
    margin-top: 0.5rem;
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
}

/* Button Styling */
.btn-outline-primary {
    transition: all 0.2s ease;
}

.btn-outline-primary:hover {
    transform: translateY(-1px);
}

/* Error Styling */


.text-danger {
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .image-row {
        flex-direction: column;
    }

    .preview-container {
        margin-top: 10px;
        height: auto;
    }
}




.select2-selection__choice{
    padding: 5px;
}
.select2-selection__choice__display{
    padding: 10px 10px;
}

/* Input Controls & Form Elements */
.form-control,
.form-select,
.select2-container--default .select2-selection--multiple {
    height: auto;
    padding: 0.625rem 1rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1.5;
    color: #2d3748;
    background-color: #fff;
    border: 2px solid #e2e8f0;
    border-radius: 0.5rem;
    transition: all 0.2s ease-in-out;
}

/* Focus States */
.form-control:focus,
.form-select:focus,
.select2-container--default.select2-container--focus .select2-selection--multiple {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
    outline: none;
}

/* Hover States */
.form-control:hover,
.form-select:hover,
.select2-container--default .select2-selection--multiple:hover {
    border-color: #94a3b8;
}

/* Error States */
.form-control.error,
.form-select.error,
.select2-container--default .select2-selection--multiple.error {
    border-color: #ef4444 !important;
    background-color: #fef2f2;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.15);
}

/* Placeholder Styling */
.form-control::placeholder {
    color: #94a3b8;
    opacity: 0.7;
}

/* Label Styling */
.form-group label {
    font-size: 0.875rem;
    font-weight: 500;
    color: #1f2937;
    margin-bottom: 0.5rem;
    display: inline-block;
}

/* Required Field Indicator */
.form-group label .text-red {
    color: #ef4444;
    margin-left: 0.25rem;
}

/* Textarea Specific */
textarea.form-control {
    min-height: 120px;
    resize: vertical;
}

/* Number Input Specific */
input[type="number"].form-control {
    -moz-appearance: textfield;
}

input[type="number"].form-control::-webkit-outer-spin-button,
input[type="number"].form-control::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* File Input Specific */
.form-control[type="file"] {
    padding: 0.375rem;
}

.form-control[type="file"]::-webkit-file-upload-button {
    padding: 0.375rem 0.75rem;
    margin: -0.375rem 0.75rem -0.375rem -0.75rem;
    border: 0;
    border-radius: 0.375rem;
    background-color: #e2e8f0;
    color: #1f2937;
    transition: all 0.2s ease-in-out;
}

.form-control[type="file"]::-webkit-file-upload-button:hover {
    background-color: #cbd5e1;
}

/* Disabled State */
.form-control:disabled,
.form-control[readonly],
.form-select:disabled {
    background-color: #f1f5f9;
    opacity: 0.7;
    cursor: not-allowed;
}

/* Input Groups */
.input-group {
    position: relative;
}

.input-group .form-control {
    position: relative;
    flex: 1 1 auto;
    width: 1%;
    min-width: 0;
}

/* Form Validation Messages */
.validation-error {
    font-size: 0.75rem;
    color: #ef4444;
    margin-top: 0.25rem;
    display: block;
    opacity: 0;
    transform: translateY(-10px);
    animation: slideDown 0.2s ease-out forwards;
}

@keyframes slideDown {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Success State */
.form-control.is-valid,
.form-select.is-valid {
    border-color: #10b981;
    background-color: #f0fdf4;
}

.form-control.is-valid:focus,
.form-select.is-valid:focus {
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.25);
}

/* Loading State */
.form-control.is-loading {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E%3Cpath fill='%23cbd5e1' d='M12,23a9.63,9.63,0,0,1-8-9.5,9.51,9.51,0,0,1,6.79-9.1A1.66,1.66,0,0,0,12,2.81h0a1.67,1.67,0,0,0-1.94-1.64A11,11,0,0,0,12,23Z'%3E%3CanimateTransform attributeName='transform' type='rotate' dur='0.75s' values='0 12 12;360 12 12' repeatCount='indefinite'/%3E%3C/path%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 1.25rem;
}

/* Small Input Variant */
.form-control-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
    border-radius: 0.375rem;
}

/* Large Input Variant */
.form-control-lg {
    padding: 0.75rem 1.25rem;
    font-size: 1rem;
    border-radius: 0.75rem;
}
.error {
    border-color: #dc3545 !important;
}
@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-10px); }
    75% { transform: translateX(10px); }
}

.shake {
    animation: shake 0.5s ease-in-out;
}
</style>
@endpush
