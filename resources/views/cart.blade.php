@extends('layout')

@section('title', 'Shopping Cart')

@section('extra-css')

@endsection

@section('content')

    <div class="breadcrumbs">
        <div class="container">
            <a href="#">Home</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span>Shopping Cart</span>
        </div>
    </div> <!-- end breadcrumbs -->

    <div class="cart-section container">
        <div>
            
            
          
          @include('layouts.error_msg');

            @if (Cart::count() > 0)   

            <h2>{{ Cart::count() }} item(s) in Shopping Cart</h2>
           
            <div class="cart-table">
                @foreach (Cart::content() as $product)
                    {{-- expr --}}
                
                <div class="cart-table-row">
                    <div class="cart-table-row-left">
                        <a href="{{route('shop.show',$product->model->slug)}}"><img src="{{asset('img/products/'.$product->model->slug.'.jpg')}}" alt="item" class="cart-table-img"></a>
                        <div class="cart-item-details">
                            <div class="cart-table-item"><a href="{{route('shop.show',$product->model->slug)}}">{{ $product->model->name }}</a></div>
                            <div class="cart-table-description">{{ $product->model->details }}</div>
                        </div>
                    </div>
                    <div class="cart-table-row-right">
                        <div class="cart-table-actions">
                                
                                <form action="{{ route('cart.destroy', $product->rowId) }}" method="POST">
                                    
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                     <button type="submit" class="cart-options">Remove</button>
                                </form>
                                
                               
                           <form action="{{ route('cart.SaveForLater',$product->rowId) }}" method="POST">
                               
                               {{ csrf_field() }}


                                <button type="submit" class="cart-options">Save for Later</button>

                           </form>
                               
                        </div>
                        <div>
                            <select class="quantity" data-id="{{ $product->rowId }}">
                                @for ($i = 1; $i < 5 + 1 ; $i++)
                                    <option {{ $product->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                               
                                {{-- <option {{ $product->qty == 1 ? 'selected' : '' }}>1</option>
                                <option {{ $product->qty == 2 ? 'selected' : '' }}>2</option>
                                <option {{ $product->qty == 3 ? 'selected' : '' }}>3</option>
                                <option {{ $product->qty == 4 ? 'selected' : '' }}>4</option>
                                <option {{ $product->qty == 5 ? 'selected' : '' }}>5</option> --}}
                            </select>
                        </div>
                        <div>{{ $product->model->presetPrice() }}</div>
                    </div>
                </div> <!-- end cart-table-row -->

               @endforeach

            </div> <!-- end cart-table -->

            

            <div class="cart-totals">
                <div class="cart-totals-left">
                    Shipping is free because we’re awesome like that. Also because that’s additional stuff I don’t feel like figuring out :).
                </div>

                <div class="cart-totals-right">
                    <div>
                        Subtotal <br>
                        Tax (5%)<br>
                        <span class="cart-totals-total">Total</span>
                    </div>
                    <div class="cart-totals-subtotal">
                       {{ presetPrice(Cart::subtotal()) }} <br>
                        {{ presetPrice(Cart::tax()) }} <br>
                        <span class="cart-totals-total">{{ presetPrice(Cart::total()) }}</span>
                    </div>
                </div>
            </div> <!-- end cart-totals -->

            <div class="cart-buttons">
                <a href="{{ route('shop.index') }}" class="button">Continue Shopping</a>
                <a href="{{ route('checkout.index') }}" class="button-primary">Proceed to Checkout</a>
            </div>

           @else

                 <h3> No Items in the Cart</h3><br>
                   
                   <a href="{{ route('shop.index') }}" class="button">Continue Shopping</a><br>
                   <div class="spacer"></div>
            @endif
            
            
            @if (Cart::instance('saveforlater')->count() > 0)
                {{-- expr --}}

                <h2>{{ Cart::instance('saveforlater')->count() }} item(s) Saved For Later</h2>

                 @foreach (Cart::content() as $item)
        
                <div class="saved-for-later cart-table">
                   
                    <div class="cart-table-row">
                        <div class="cart-table-row-left">
                            <a href=""><img src="{{asset('img/products/'.$item->model->slug.'.jpg')}}" alt="item" class="cart-table-img"></a>
                            <div class="cart-item-details">
                                <div class="cart-table-item"><a href="">{{ $item->model->name }}</a></div>
                                <div class="cart-table-description">{{ $item->model->details }}</div>
                            </div>
                        </div>
                        <div class="cart-table-row-right">
                            <div class="cart-table-actions">
                                
    
                                    <form action="{{ route('savelater.destroy',$item->rowId) }}" method="POST">
                                        
                                        {{ csrf_field() }}
                                        
                                        {{ method_field('DELETE') }}

                                        <button type="submit" class="cart-options">Remove</button>


                                    </form>

                                    <form action="{{ route('tocart.addToCart',$item->rowId) }}" method="POST">
                               
                                        {{ csrf_field() }}


                                        <button type="submit" class="cart-options">Move to cart</button>

                                     </form>
                                
                            </div>

                            <div>{{ presetPrices($item->model->price) }}</div>
                        </div>
                    </div> <!-- end cart-table-row -->
                   

                </div> <!-- end saved-for-later -->

                @endforeach

             @else
                <div class="spacer"></div>
                <h3>No items for save for later</h3>
             @endif


        </div>

    </div> <!-- end cart-section -->

    @include('partials.might-like')


@endsection

@section('extra-js')
    
 {{--    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <script>
        
        $(function(){

            $('.quantity').on('change',function(){


                var id = $('{{ $product-> }}')
               // $.ajax({
               //  url: '{{ route('cart/') }}',
               //  method: 'PUT',
               //  dataType: 'json',
               //  success: function( data ) {
               //  alert(JSON.stringify(data));
               //  },
               //  error: function( data ) {
               //  alert('error');
               //  }
               //  });


            });

        })

    </script> --}}

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        (function(){
            const classname = document.querySelectorAll('.quantity')

            Array.from(classname).forEach(function(element) {
                element.addEventListener('change', function() {
                    const id = element.getAttribute('data-id')
                    axios.patch(`cart/${id}`, {
                        quantity: this.value
                    })
                    .then(function (response) {
                        // console.log(response);
                        window.location.href = '{{ route('cart.index') }}'
                    })
                    .catch(function (error) {
                         // console.log(error);
                        window.location.href = '{{ route('cart.index') }}'
                    });
                })
            })
        })();
    </script>
@endsection
