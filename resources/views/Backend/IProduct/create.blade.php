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
                      <a href="{{Route('iproduct.index')}}" class="btn btn-primary"><i class="fa-solid fa-list"></i> I-Product List</a>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3> Add I-Product</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{Route('iproduct.store')}}"  class="form" method="POST" enctype="multipart/form-data" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
                            @csrf

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="product_name" class="mb-1 bold text-capitalize">Product Name</label>
                                            <input type="text" name="product_name" id="product_name" placeholder="Enter Product Name" class="form-control" required value="{{old('product_name')}}">
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
                                            <input type="text" name="sub_title" id="sub_title" placeholder="Enter Sub Title" class="form-control" required value="{{old('sub_title')}}">
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
                                            <input type="text" name="sku" id="sku" placeholder="Enter SKU" class="form-control" required value="{{old('sku')}}">
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
                                            <label for="description" class="mb-1 bold text-capitalize">description</label>
                                            <textarea class="form-control" name="description" id="description" rows="5" placeholder="Enter Description" required value="{{old('description')}}"></textarea>
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

                                            <input type="number" name="price" id="price" placeholder="Enter Price in Ruppes INR ₹" class="form-control" required value="{{old('price')}}" min=0 max=99999999.99>
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
                                            <select name="category_id" id="category_id" class="form-select">
                                                <option value="">--Select--</option>
                                                @if($category)
                                                @foreach ($category as $cat)
                                                <option value="{{$cat->id}}" {{ old('category_id') == '{!!$cat->id!!}' ? 'selected' : '' }}>{{$cat->category_name}}</option>
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
                                            <label for="color_id" class="mb-1 bold text-capitalize">Color</label>
                                            <select name="color_id" id="color_id" class="form-select">
                                                <option value="">--Select--</option>
                                                @if($color)
                                                @foreach ($color as $col)
                                                <option value="{{$col->id}}" {{ old('color_id') == '{!!$col->id!!}' ? 'selected' : '' }}>{{$col->color_name}}</option>
                                                @endforeach

                                                @endif
                                                {{-- <option value=""></option>
                                                --}}
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
                                            <label for="size_id" class="mb-1 bold text-capitalize">size</label>
                                            <select name="size_id" id="size_id" class="form-select">
                                                <option value="">--Select--</option>
                                                @if($size)
                                                @foreach ($size as $sz)
                                                <option value="{{$sz->id}}" {{ old('size_id') == '{!!$sz->id!!}' ? 'selected' : '' }}>{{$sz->size_name}}</option>
                                                @endforeach

                                                @endif
                                                {{-- <option value=""></option>
                                                --}}
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
                                                <option value="0" >No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row imageContainer">

                            </div>



                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                       <button type="submit" class="btn btn-success"><i class="fa-solid fa-plus"></i> Add I-Product</button>
                                       <button type="reset"  class="btn btn-dark">Clear</button>
                                    </div>
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
    buttonRow.className = 'row mt-3';
    buttonRow.innerHTML = `
        <div class="col-md-12">
            <button type="button" class="btn btn-primary" id="addImageBtn">
                <i class="fa-solid fa-plus"></i> Add More Images
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
        <div class="col-md-4">
            <div class="mb-3">
                <div class="form-group">
                    <label class="mb-1 bold text-capitalize">Product Image ${imageRowCount + 1}</label>
                    <input type="file" name="product_img[${imageRowCount}]"
                           class="form-control product-image-input"
                           accept="image/png, image/jpeg, image/jpg">
                    <div class="form-text small">
                        <i>Accepts (png, jpeg, jpg) <br> Max size: 5MB, Dimensions: 2920x2080 pixels</i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="mb-3 preview-container" style="display: none;">
                <img src="{{ asset('backend/assets/images/placeholder.png') }}"
                     class="product-preview-image"
                     style="max-height: 150px;">
            </div>
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-danger remove-row">
                <i class="fa-solid fa-trash"></i>
            </button>
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
                previewContainer.style.display = 'block'; // Show preview
            }
            reader.readAsDataURL(file);
        } else {
            previewImage.src = "{{ asset('backend/assets/images/placeholder.png') }}";
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
    border: 2px dashed var(--border-color);
    padding: 5px;
}

.product-preview-image:hover {
    transform: scale(1.02);
    box-shadow: var(--shadow-md);
}

.remove-row {
    margin-top: 32px;
}
</style>
@endpush

