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
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="sku" class="mb-1 bold text-capitalize">SKU</label>
                                            <input type="text" name="sku" id="sku" value="{{ old('sku', $iProduct->sku) }}" class="form-control" required>
                                            @error('sku')
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
                                            <label for="description" class="mb-1 bold text-capitalize">Description</label>
                                            <textarea class="form-control" name="description" id="description" rows="5" required>{{ old('description', $iProduct->description) }}</textarea>
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
                                            <label for="price" class="mb-1 bold text-capitalize">Price</label>
                                            <input type="number" name="price" id="price" value="{{ old('price', $iProduct->price) }}" class="form-control" required min=0 max=99999999.99>
                                            @error('price')
                                            <div class="text-danger">{{$message}}</div>
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
                                                @foreach ($category as $cat)
                                                    <option value="{{$cat->id}}" {{ old('category_id', $iProduct->category_id) == $cat->id ? 'selected' : '' }}>
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
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="color_id" class="mb-1 bold text-capitalize">Color</label>
                                            <select name="color_id" id="color_id" class="form-select" required>
                                                <option value="">--Select--</option>
                                                @foreach ($color as $col)
                                                    <option value="{{$col->id}}" {{ old('color_id', $iProduct->color_id) == $col->id ? 'selected' : '' }}>
                                                        {{$col->color_name}}
                                                    </option>
                                                @endforeach
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
                                            <label for="size_id" class="mb-1 bold text-capitalize">Size</label>
                                            <select name="size_id" id="size_id" class="form-select" required>
                                                <option value="">--Select--</option>
                                                @foreach ($size as $sz)
                                                    <option value="{{$sz->id}}" {{ old('size_id', $iProduct->size_id) == $sz->id ? 'selected' : '' }}>
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

                            {{-- Current Images Section --}}
                            @if($iProduct->productImages->count() > 0)
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h4>Current Images</h4>
                                    <div class="row">
                                        @foreach($iProduct->productImages as $image)
                                        <div class="col-md-3 mb-3">
                                            <div class="card">
                                                <img src="{{ asset('storage/iproduct_img/' . $image->product_img) }}"
                                                     class="card-img-top product-preview-image"
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

                            {{-- Add New Images Section --}}
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
                                    <a href="{{ route('iproduct.index') }}" class="btn btn-secondary">
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
@endpush

@push('css')
<style>
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
</style>
@endpush
