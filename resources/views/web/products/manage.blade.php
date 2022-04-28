@extends('web.master')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Products</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active">
                <a href="{{ route('products.index') }}">Products</a>
            </li>
            </ol>
        </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="container">
        {{-- <div class="col-md-2"></div> --}}
        <div class="col-md-12">
            <div class="card card-info">
                <div class="body">
                    <div class="card-header">
                        <h3 class="card-title"> 
                            {{ (isset($product) ?  ' Edit ' . $product->title : 'Add Product') }}
                        </h3>
                    </div>
                    <div class="card-body">
                      <div class="form-horizontal">
                        {{-- @include('web.layouts.message') --}}
                        @if(isset($product))
                            {!! Form::model($product, ['route' => ['products.update', $product->id],'method'=>'PUT','enctype' => 'multipart/form-data']) !!}
                          @else
                            {{ Form::open(['route' => ['products.store'],'enctype' => 'multipart/form-data']) }}
                        @endif
                        @csrf
                        
                        <div class="form-group col-md-12">
                          <div class="row">
                            <div class="col-md-12 label-form">
                              <label for="title">Title</label>
                            </div>
                            <div class="col-md-12 form-input">
                              {!! Form::text('title', old('title'), [ 'class' => 'form-control'.( $errors->has('title') ? ' is-invalid' : '' )]) !!}
                              <small class="text-danger">{{ $errors->first('title') }}</small>
                            </div>
                          </div>
                        </div>

                        <div class="form-group col-md-12">
                          <div class="row">
                            <div class="col-md-12 label-form">
                              <label for="description">Description</label>
                            </div>
                            <div class="col-md-12 form-input">
                              {!! Form::textarea('description', old('description'), [ 'class' => 'form-control'.( $errors->has('description') ? ' is-invalid' : '' )]) !!}
                              <small class="text-danger">{{ $errors->first('description') }}</small>
                            </div>
                          </div>
                        </div>

                          <div class="form-group col-md-12">
                            <div class="row">
                              <div class="col-md-12 label-form">
                                <label for="status">Price</label>
                              </div>
                              <div class="col-md-12 form-input">
                                {!! Form::number('price', isset($product->pharmacyProduct->price) ? $product->pharmacyProduct->price : old('price'), [ 'class' => 'form-control'.( $errors->has('price') ? ' is-invalid' : '' )]) !!}
                                <small class="text-danger">{{ $errors->first('price') }}</small>
                              </div>
                            </div>
                          </div>

                          <div class="form-group col-md-12">
                            <div class="row">
                              <div class="col-md-12 label-form">
                                <label for="status">Pharmacies</label>
                              </div>
                              <div class="col-md-12 form-input">
                                  {!! Form::select('pharmacies[]', $pharmacies,  null, ['class' => 'form-control select2', 'multiple']) !!}

                                <small class="text-danger">{{ $errors->first('is_active') }}</small>
                              </div>
                            </div>
                          </div>

                        <img height="100" src="{{ isset($product) ? asset($product->image) : ""}}" alt="">
                        <hr>

                        <div class="form-group col-md-12">
                          <div class="row">
                            <div class="col-md-12 label-form">
                              <label for="image">Image</label>
                            </div>
                            <div class="col-md-12 form-input">
                                {!! Form::file('image', [ 'class' => 'form-control'.( $errors->has('image') ? ' is-invalid' : ''),'accept'=>'image/*','id'=>'product-image' ]) !!}
                              <small class="text-danger">{{ $errors->first('image') }}</small>
                            </div>
                          </div>
                        </div>
                         
                        <div class="col-md-12">
                            {!! Form::submit('Save',['class'=>'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        </div>

                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection