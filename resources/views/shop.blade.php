@extends('layout')

@section('title', 'Shop')

@section('extra-css')

@endsection

@section('content')

    <div class="breadcrumbs">
        <div class="container">
            <a href="{{ route('landing-page') }}">Home</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span>Shop</span>
        </div>
    </div> <!-- end breadcrumbs -->

    <div class="products-section container">
        <div class="sidebar">
            <h3>By Category</h3>
            <ul>
                
                    <li class=""><a href=""></a></li>
               
            </ul>
        </div> <!-- end sidebar -->
        <div>
            <div class="products-header">
                <h1 class="stylish-heading"></h1>
                <div>
                    <strong>Price: </strong>
                    <a href="">Low to High</a> |
                    <a href="">High to Low</a>

                </div>
            </div>

            <div class="products text-center">
    


                @foreach($products as $product)
                    
                    @if(count($products)>0)
                        <div class="product">
                            <a href="{{route('shop.show',$product->slug)}}"><img src="{{asset('img/products/'.$product->slug.'.jpg')}}" alt="product"></a>
                            <a href="{{route('shop.show',$product->slug)}}"><div class="product-name">{{$product->name}}</div></a>
                            <div class="product-price">{{$product->presetPrice()}}</div>
                        </div>
                    @else

                         <div style="text-align: left">No items found</div>

                    @endif
                 @endforeach
                

            </div> <!-- end products -->

            <div class="spacer text-center"></div>
              <center>{{ $products->links('vendor.pagination.default') }}</center>
        </div>
    </div>


@endsection
