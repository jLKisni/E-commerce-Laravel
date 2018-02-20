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
            
            @if (session()->has('success_msg'))
                <div class="alert alert-success">
                    {{ session()->get('success_msg') }}
                </div>
            @endif

            @if (count($errors) > 0)
                
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            @endif


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
                           

                                <button type="submit" class="cart-options">Remove</button>
                           
                                <button type="submit" class="cart-options">Save for Later</button>
                        </div>
                        <div>
                            <select class="quantity" data-id="">
                               
                                {{-- <option {{ $item->qty == 1 ? 'selected' : '' }}>1</option>
                                <option {{ $item->qty == 2 ? 'selected' : '' }}>2</option>
                                <option {{ $item->qty == 3 ? 'selected' : '' }}>3</option>
                                <option {{ $item->qty == 4 ? 'selected' : '' }}>4</option>
                                <option {{ $item->qty == 5 ? 'selected' : '' }}>5</option> --}}
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
                        Tax (13%)<br>
                        <span class="cart-totals-total">Total</span>
                    </div>
                    <div class="cart-totals-subtotal">
                       asdsa <br>
                        12321 <br>
                        <span class="cart-totals-total">12321</span>
                    </div>
                </div>
            </div> <!-- end cart-totals -->

            <div class="cart-buttons">
                <a href="" class="button">Continue Shopping</a>
                <a href="" class="button-primary">Proceed to Checkout</a>
            </div>

           @else

                 <h3> No Items in the Cart</h3><br>
            @endif
            

            <h2>1 item(s) Saved For Later</h2>

            <div class="saved-for-later cart-table">
               
                <div class="cart-table-row">
                    <div class="cart-table-row-left">
                        <a href=""><img src="{{asset('img/products/appliance-1.jpg')}}" alt="item" class="cart-table-img"></a>
                        <div class="cart-item-details">
                            <div class="cart-table-item"><a href=""></a></div>
                            <div class="cart-table-description"></div>
                        </div>
                    </div>
                    <div class="cart-table-row-right">
                        <div class="cart-table-actions">
                            

                                <button type="submit" class="cart-options">Remove</button>
                           


                                <button type="submit" class="cart-options">Move to Cart</button>
                            
                        </div>

                        <div>12321</div>
                    </div>
                </div> <!-- end cart-table-row -->
               

            </div> <!-- end saved-for-later -->

           


        </div>

    </div> <!-- end cart-section -->

    @include('partials.might-like')


@endsection

@section('extra-js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        (function(){
            const classname = document.querySelectorAll('.quantity')

            Array.from(classname).forEach(function(element) {
                element.addEventListener('change', function() {
                    const id = element.getAttribute('data-id')
                    axios.patch(`/cart/${id}`, {
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
