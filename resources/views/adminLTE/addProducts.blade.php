@extends('adminLTE.layouts.master')
   @section('title',"dashboard")

    @section('main')

<main class="app-main">
    <!--begin::Form Validation-->
    <div class="card card-info card-outline mb-4 m-5">
        <!--begin::Header-->
        <div class="card-header"><div class="card-title">{{ isset($data) ? 'Edit Product' : 'Add Product' }}</div></div>
        <!--end::Header-->
        <!--begin::Form-->
        <form action="{{ isset($data) ? route('admin.product.update', $data->id) :  route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($data))
                @method('PUT') <!-- Use PUT method for updates -->
            @endif
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Row-->
                <div class="row g-3">
                    <!--begin::Col     product Name--> 
                    <div class="col-md-6">
                        <label for="Pname" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="Pname" name="Pname" value="{{ old('Pname', $data->name ?? '') }}"  required />
                        @error('Pname')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--end::Col-->
                    <!--begin::Col      Category-->
                    <div class="col-md-6">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select" name ="category_id" id="category_id">
                            <option {{ isset($data) ? "" : 'selected' }} disabled value="">Choose a Category</option>
                            @foreach($category as $category)
                                <option 
                                    value="{{ $category->id }}" {{ $category->id == old('category_id', $data->id ?? '') ? 'selected' : '' }}
                                    >   
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>                    
                        @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--end::Col-->
                    <!--begin::Col     product sale price-->
                    <div class="col-md-6">
                        <label for="sale_price" class="form-label">Sale Price</label>
                        <input type="number" class="form-control" id="sale_price" name="sale_price" value="{{ old('sale_price', $data->price ?? '') }}"  required />
                        @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--end::Col-->
                    <!--begin::Col     product bid start price-->
                    <div class="col-md-6">
                        <label for="bid_price" class="form-label">Bid Price</label>
                        <input type="number" class="form-control" id="bid_price" name="bid_price" value="{{ old('bid_price', $data->bid_price ?? '') }}"  required />
                        @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--end::Col-->
                    <!--begin::Col      product start_at   date('Y-m-d H:i:s', strtotime($request->start_at))-->
                    <div class="col-md-6">
                        <label for="start_at" class="form-label">Bid Start At</label>
                        <input type="text" class="form-control" id="start_at" name="start_at" value="{{ old('start_at', $data->auction_start ?? '') }}" placeholder="Select Bid Start Time"  required />
                        @error('start_at')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--end::Col-->
                    <!--begin::Col      product end_at-->
                    <div class="col-md-6">
                        <label for="end_at" class="form-label">Bid End At</label>
                        <input type="text" class="form-control" id="end_at" name="end_at" value="{{ old('end_at', $data->auction_end ?? '') }}" placeholder="Select Bid End Time" required />
                        @error('end_at')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--end::Col-->
                    <!--begin::Col      product Main Image-->
                    <div class="col-md-6">
                        <label for="main_image" class="form-label">Main Image</label>
                        <input type="file" class="form-control" id="main_image" name="main_image" accept="image/*"  {{ isset($data) ? "" : 'required' }} />
                        @error('main_image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--end::Col-->
                    <!--begin::Col      product Optional Images-->
                    <div class="col-md-6">
                        <label for="more_images" class="form-label">Optional Images </label>
                        <input type="file" class="form-control" id="more_images" name="more_images" accept="image/*"/>
                        @error('more_images')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--end::Col-->
                    <!--begin::Col Category-->
                    <!-- <div class="col-md-12">
                        <label for="description" class="form-label">Description  </label>
                        <textarea class="form-control" id="description" name="description" rows="1" cols="50" placeholder="Type your description here..."> {{ old('description', $data->description ?? '') }} </textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div> -->
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Body-->
            <!--begin::Footer-->
            <div class="card-footer">
                <button class="btn btn-info" type="submit">Submit form</button>
            </div>
            <!--end::Footer-->
        </form>
        <!--end::Form-->
</div>
<!--end::Form Validation-->


</main>
@endsection