@extends('Backend.layouts.backend')

@section('title')
Edit Product Image
@endsection

@section('content')
 <!-- Main Content -->
 <div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <a href="{{Route('productimage.index')}}" class="btn btn-primary"><i class="fa-solid fa-list"></i> Product Image List</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3><i class="fa-solid fa-image"></i> Edit Product Image</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{Route('productimage.update', ['productimage' => $productimage->id])}}" class="form" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="p_image" class="mb-1 bold text-capitalize">Product Image</label>
                                            <input type="file" name="product_img" id="p_image" class="form-control" accept="image/png, image/jpeg, image/jpg">
                                            <div class="form-text small">
                                                <i>Upload Your Product Image Here accepts (png, jpeg, jpg) <br> Max size: 5MB , Dimensions: 2920x2080 pixels</i>
                                            </div>
                                            @error('product_img')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="card">
                                        <div class="card-header"><h3><i class="fa-solid fa-image"></i> Product Image Preview</h3></div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <img id="product_img_preview"
                                                     src="{{ asset('storage/product_images/' . $productimage->product_img) }}"
                                                     alt="Image Preview"
                                                     class="product-preview-image" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                       <button type="submit" class="btn btn-success"><i class="fa-solid fa-save"></i> Update Image</button>
                                       <button type="reset" class="btn btn-dark">Reset</button>
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

@push('css')
<style>
    .product-preview-image {
        max-width: 400px;
        max-height: 400px;
        width: auto;
        height: auto;
        border-radius: var(--border-radius-md);
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
        border: 2px solid var(--border-color);
        padding: 5px;
    }

    .product-preview-image:hover {
        transform: scale(1.02);
        box-shadow: var(--shadow-md);
    }

    .form-text.small {
        color: var(--text-muted);
        font-size: var(--font-size-sm);
        margin-top: 0.25rem;
    }
</style>
@endpush

@push('js')
<script>
    // Store the original image URL
    const originalImage = "{{ asset('storage/product_images/' . $productimage->product_img) }}";
    const defaultPlaceholder = "{{ asset('backend/assets/images/placeholder.png') }}";
    const preview = document.getElementById('product_img_preview');

    // Image preview functionality
    document.getElementById('p_image').addEventListener('change', function(e) {
        const file = e.target.files[0];

        // If no file is selected, show original image
        if (!file) {
            preview.src = originalImage;
            return;
        }

        // Validate file type
        const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        if (!validTypes.includes(file.type)) {
            alert('Please select a valid image file (JPG, JPEG, PNG)');
            preview.src = originalImage;
            this.value = '';
            return;
        }

        // Validate file size (5MB)
        const maxSize = 5 * 1024 * 1024;
        if (file.size > maxSize) {
            alert('File size must be less than 5MB');
            preview.src = originalImage;
            this.value = '';
            return;
        }

        // Create preview
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;

            // Validate image dimensions
            const img = new Image();
            img.onload = function() {
                if (this.width > 2920 || this.height > 2080) {
                    alert('Image dimensions should not exceed 2920x2080 pixels');
                    preview.src = originalImage;
                    document.getElementById('p_image').value = '';
                }
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    });

    // Reset to original image on form reset
    document.querySelector('button[type="reset"]').addEventListener('click', function() {
        preview.src = originalImage;
        document.getElementById('p_image').value = '';
    });
</script>
@endpush
