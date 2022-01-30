@extends('layouts.admin')

@section('content')
<div class="section-content section-dashboard-home"data-aos="fade-up">
 <div class="container-fluid">
  <div class="dashboard-heading">
    <h2 class="dashboard-title">Product</h2>
    <p class="dashboard-subtitle">
      Create new product.
    </p>
  </div>
  <div class="dashboard-content">
    <div class="row">
        <div class="col-md-6">
            @if ($errors->any())
                <div class="alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{  $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('product-gallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Product Name</label>
                                    <select name="products_id" class="form-control" required>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Product Image</label>
                                    <input type="file" name="photos" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-right">
                                <button type="submit" class="btn btn-dark">Create Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
 </div>
</div>
@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    <script>
    function thisFileUpload() {
        document.getElementById("file").click();
    }
    </script>
@endpush