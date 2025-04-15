@extends('Backend.layouts.backend')

@section('title')
Edit I-Product
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{Route('iproduct.index')}}" class="btn btn-primary">
                            <i class="fa-solid fa-list"></i> iProduct List
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3><i class="fas fa-edit"></i> Edit <i>iProduct</i></h3>
                    </div>
                    <div class="card-body">
                        <form action="{{Route('iproduct.update', $iProduct->id)}}" class="form" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="sku" class="mb-1 bold text-capitalize">SKU</label>
                                            <input type="text" name="sku" id="sku" class="form-control" required
                                                value="{{ old('sku', $iProduct->sku) }}">
                                            @error('sku')
                                                <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="product_name" class="mb-1 bold text-capitalize">Product Name</label>
                                            <input type="text" name="product_name" id="product_name" value="{{ old('product_name', $iProduct->product_name) }}" class="form-control" required>
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
                                            <input type="text" name="sub_title" id="sub_title" value="{{ old('sub_title', $iProduct->sub_title) }}" class="form-control" required>
                                            @error('sub_title')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Description field -->
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="description" class="mb-1 bold text-capitalize">Description</label>
                                            <textarea class="form-control" name="description" id="description" rows="5" required>{{ old('description', $iProduct->description) }}</textarea>
                                            @error('description')
                                                <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Price and Category fields -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="price" class="mb-1 bold text-capitalize">Price</label>
                                            <input type="text" name="price" id="price" class="form-control" required
                                                value="{{ old('price', $iProduct->price) }}">
                                            @error('price')
                                                <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Category Select -->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="category_id" class="mb-1 bold text-capitalize">Category</label>
                                            <select name="category_id" id="category_id" class="form-select">
                                                <option value="">--Select--</option>
                                                @foreach ($category as $cat)
                                                    <option value="{{$cat->id}}"
                                                        {{ (old('category_id', $iProduct->category_id) == $cat->id) ? 'selected' : '' }}>
                                                        {{$cat->category_name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Color Multiple Select -->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="color_id" class="mb-1 bold text-capitalize">Colors</label>
                                            <select name="color_id[]" id="color_id" class="form-select select2" multiple>
                                                @foreach ($color as $col)
                                                    <option value="{{ $col->id }}"
                                                        {{ in_array($col->id, is_array($iProduct->color_id) ? $iProduct->color_id : []) ? 'selected' : '' }}>
                                                        {{ $col->color_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('color_id')
                                                <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Size Multiple Select -->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="size_id" class="mb-1 bold text-capitalize">Sizes</label>
                                            <select name="size_id[]" id="size_id" class="form-select select2" multiple>
                                                @foreach ($size as $sz)
                                                    <option value="{{$sz->id}}"
                                                        {{ (collect(old('size_id', $iProduct->size_id))->contains($sz->id)) ? 'selected' : '' }}>
                                                        {{$sz->size_name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('size_id')
                                                <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Current Images Section -->
                            @if($iProduct->productImages->count() > 0)
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h4>Current Images</h4>
                                    <div class="row">
                                        @foreach($iProduct->productImages as $image)
                                        <div class="col-md-3 mb-3">
                                            <div class="card">
                                                <img src="{{ asset('storage/iproduct_img/' . $image->product_img) }}"
                                                     class="product-preview-image"
                                                     alt="Product Image">
                                                <div class="card-body text-center">
                                                    <div class="form-check">
                                                        <input type="checkbox"
                                                               name="delete_images[]"
                                                               value="{{ $image->id }}"
                                                               class="form-check-input">
                                                        <label class="form-check-label">Delete</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Add New Images Section -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="have_img" class="mb-1 bold text-capitalize">Add New Images</label>
                                            <select name="have_img" id="have_img" class="form-select">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="imageContainer card p-4 shadow"></div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa-solid fa-save"></i> Update Product
                                    </button>
                                    <a href="{{ route('iproduct.index') }}" class="btn btn-dark">
                                        <i class="fa-solid fa-times"></i> Cancel
                                    </a>
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
                           accept="image/png, image/jpeg, image/jpg">
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
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select options",
            allowClear: true,
            width: '100%',
            templateResult: formatOption,
            templateSelection: formatOption
        });

        // Format option with color for color select
        function formatOption(option) {
            if (!option.id) {
                return option.text;
            }

            if ($(option.element).closest('select').attr('id') === 'color_id') {
                var $option = $(`
                    <span class="color-option">
                        <span class="color-swatch" style="background-color: ${$(option.element).data('color-code')}"></span>
                        <span class="color-name">${option.text}</span>
                    </span>
                `);
                return $option;
            }

            return option.text;
        }
    });
</script>
@endpush

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
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
        background: #0d6efd;
        border: none;
        color: white;
        border-radius: 50px;
        padding: 4px 12px;
        margin: 2px 4px;
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        transition: all 0.2s ease;
        gap: 6px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice:hover {
        background: #0b5ed7;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.15);
    }

    /* Remove Button Styling */
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: rgba(255,255,255,0.8);
        margin-right: 6px;
        padding: 0 4px;
        border-right: 1px solid rgba(255,255,255,0.2);
        transition: all 0.2s ease;
        position: relative;
        border: none;
        height: auto;
        width: auto;
        font-size: 1.1em;
        line-height: 1;
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

.color-option {
    display: flex;
    align-items: center;
    gap: 8px;
}

.color-swatch {
    display: inline-block;
    width: 16px;
    height: 16px;
    border-radius: 4px;
    border: 1px solid rgba(0,0,0,0.1);
}

.color-name {
    font-size: 0.875rem;
}
</style>
@endpush

