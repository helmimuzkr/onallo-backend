@extends('layouts.admin')

@section('content')
<div class="section-content section-dashboard-home"data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Product</h2>
            <p class="dashboard-subtitle">Create new product.</p>
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
                            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Product Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ $item->name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Category</label>
                                            <select name="categories_id" class="form-control" required>
                                                <option value="{{ $item->categories_id }}" selected>{{ $item->category->name }}</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Price</label>
                                            <input type="number" name="price" class="form-control" value="{{ $item->price }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="editor" cols="30" rows="10" {!! $item->description !!}></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-dark">Update Now</button>
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