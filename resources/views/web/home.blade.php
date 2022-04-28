@extends('web.master')

@section('content')
  <div class="row">
    <div class="wrapper">
      <div class="d-md-flex align-items-md-center">
         <div class="h3">All Products</div>
         <div class="ml-auto d-flex align-items-center"> 
               {{ $products->links('vendor.pagination.custom') }} 
         </div>
      </div>
      <div class="content py-md-0 py-3">
         <section id="products">
            <div class="container py-3">
               <div class="row">
                  @foreach ($products as $product)
                  <div class="col-lg-3 col-md-6 col-sm-10 mt-4">
                     <a href="{{ route('products.show',$product->id) }}">
                     <div class="card">
                        <img class="card-img-top" src="{{ $product->image ?? '' }}">
                        <div class="card-body">
                           <h6 class="font-weight-bold pt-1">
                             <a href="{{ route('products.show',$product->id) }}">{{ $product->title }}</a>
                           </h6>
                           <div class="text-muted description">{{ $product->description }} </div>
                           <div class="d-flex align-items-center justify-content-between pt-3">
                              <div class="d-flex flex-column">
                                 <div class="h6 font-weight-bold">{{ $product->pharmacyProduct->price ?? ''}} L.E</div>
                              </div>
                              <div class="d-flex">
                                 <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
                                 {{-- button delete --}}
                                 {!! Form::open(['route' => ['products.destroy', $product->id],'method'=>'DELETE']) !!}
                                    {!! Form::submit('Delete', ['class' => ' ml-1 btn btn-danger','onclick' => "return confirm('Are you sure you want to Remove?')"]) !!}
                                 {!! Form::close() !!}
                              </div>
                           </div>
                        </div>
                     </div>
                  </a>
                  </div>
                  @endforeach
               </div>
            </div>
         </section>
      </div>
      <div class="pull-right">
         {{ $products->links('vendor.pagination.custom') }}
      </div>
   </div>
  </div>
@endsection
