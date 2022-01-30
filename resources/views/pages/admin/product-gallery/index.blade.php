@extends('layouts.admin')

@section('content')
<div class="section-content section-dashboard-home"data-aos="fade-up">
 <div class="container-fluid">
  <div class="dashboard-heading">
    <h2 class="dashboard-title">Product Gallery</h2>
    <p class="dashboard-subtitle">
      List of Product Galleries.
    </p>
  </div>
  <div class="dashboard-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('product-gallery.create') }}" class="btn btn-dark mb-3">+ Add New Product Image</a>
                    <div class="table-responsive">
                        <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th>Images</th>
                                    <th>Create</th>
                                    <th>Update</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
 </div>
</div>
@endsection

@push('addon-script')
    <script>
        // AJAX DataTablenn
        var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'product.name', name: 'product.name' },
                { data: 'photos', name: 'photos' },
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '15%'
                },
            ]
        });
    </script>
@endpush
