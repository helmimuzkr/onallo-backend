@extends('layouts.admin')

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
     <div class="dashboard-heading">
       <h2 class="dashboard-title">Create New Product</h2>
       <p class="dashboard-subtitle">Create your own product</p>
     </div>
     <div class="dashboard-content">
        <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                  <form action="">
                    <div class="card">
                      <div class="card-body">
                        <div class="row mb-2">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="name">Product Name</label>
                              <input type="text" name="name" class="form-control" required>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="price">Price</label>
                              <input type="number" name="price" class="form-control" required>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Category</label>
                                <select name="categories_id" class="form-control" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            </div>
                            <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="editor" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="thumbnails">Thumbnails</label>
                              <input
                                type="file"
                                multiple
                                class="form-control pt-1"
                                name="photos"
                                id="photos"
                              />
                              <small class="text-muted">
                                Kamu dapat memilih lebih dari satu file
                              </small>
                            </div>
                          </div>
                        </div>
                        <div class="row mt-2">
                          <div class="col text-right">
                            <button
                              type="submit"
                              class="btn btn-dark py-2 px-5"
                            >
                              Add Product
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
        </form>
     </div>
    </div>
   </div>
@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'editor', {
            height: 150,
        });
    </script>
    <script>
    function thisFileUpload() {
        document.getElementById("file").click();
    }
    </script>
@endpush