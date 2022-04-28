@extends('web.master')
@section('content')
<div class="content py-md-0 py-3">
   <div class="card">
      <div class="row g-0">
         <div class="col-md-6 border-end">
            <div class="d-flex flex-column justify-content-center p-2">
               <div class="main_image"> 
                  <img class="p-3" src="{{ asset($product->image) ?? '' }}" id="main_product_image" loading="lazy"> 
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="p-3 right-side">
               <div class="d-flex justify-content-between align-items-center">
                  <h3 class="p-3">{{ $product->title }}</h3>
               </div>
               <div class="mt-2 pr-3 content">
                  <p>{{ $product->description }}</p>
               </div>
               <h3>{{ $product->pharmacyProduct->price ?? ''}} L.E</h3>
               <div class="d-flex"> 
                  <a class="btn btn-primary btn-md" href="{{ route('products.edit',$product->id) }}">
                     Edit
                  </a>
                  {!! Form::open(['route' => ['products.destroy', $product->id],'method'=>'DELETE']) !!}
                        {!! Form::submit('Delete', ['class' => ' ml-1 btn btn-danger','onclick' => "return confirm('Are you sure you want to Remove?')"]) !!}
                  {!! Form::close() !!}
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-12 mt-5">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Product price in other pharmacies</h3>
         </div>
         <div class="card-body">
            <table class="table table-bordered">
               <thead>
                  <tr>
                     <th>Product</th>
                     <th>Pharmacy</th>
                     <th>Price</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($pharmacies as $pharmacy)
                     <tr>
                        <td>{{ $pharmacy->product->title ?? ''}}</td>
                        <td>{{ $pharmacy->pharmacy->title ?? ''}}</td>
                        <td>{{ $pharmacy->price}}</td>
                     </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
@endsection