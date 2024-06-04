@php use App\Http\Controllers\ProductController;use Illuminate\Support\Facades\Auth; $role = Auth::user()->role;@endphp

@extends('layout.master')
@section('title')
    Panier
@endsection
@section('content')

<!--breadcrumb -->
<section class="breadcrumb-section set-bg" data-setbg="img/bg-breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>TEchRevive achats</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>panier</span>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>
<!--end breadcrumb -->


<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Produits</th>
                                <th>Prix</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Paniers as $panier)
                            <tr data-product-id="{{ $panier->product_id }}">
                                <td class="shoping__cart__item">
                                    <img src="{{ asset('uploads/images/product/' . $panier->product->product_thumbnail ) }}" alt="{{ asset('uploads/images/product/' . $panier->product->product_thumbnail ) }}" width="100px"/>
                                    <h5>{{$panier->product->product_name}}</h5>
                                </td>
                                <td class="shoping__cart__price">
                                    {{$panier->product->product_price}} DA
                                </td>
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input name="quantity" type="text" value="{{$panier->quantity}}" data-product-id="{{ $panier->product_id }}">
                                        </div>
                                    </div>
                                </td>
                                <td class="shoping__cart__total" id="totalitem">
                                    {{$panier->product->product_price * $panier->quantity}} DA
                                </td>
                                <td class="shoping__cart__item__close">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="{{route('boutique')}}" class="primary-btn cart-btn">continuer vos achats</a>
                    <a href="javascript:void(0);" id="update-cart" class="primary-btn cart-btn cart-btn-right"><i class="fa fa-spinner" aria-hidden="true"></i>
                        Modifier panier</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__continue">
                    <div class="shoping__discount">
                        <h5>Code Promo</h5>
                        <form action="{{ route('apply.promo') }}"  method="post">
                            @csrf
                            <input name="code" type="text" placeholder="Enter votre code de promotion ">
                            <button type="submit" class="site-btn">Appliquer promotion</button>
                            <p id="promo-message"></p>
                            
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Total du panier</h5>
                    <ul>
                        <li>Sous-Total <span id="totalPanier" >{{$total}} DA</span></li>
                        <li>Total <span id="total-price">{{$total}} DA</span></li>
                    </ul>
                    <a href="#" class="primary-btn">procéder au paiement</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shoping Cart Section End -->




@endsection

@section('ajaxsection')
{{-- ------------------------script pour mise à jour le prix aprés changement de quntity ---------------------------- --}}
<script>
    $(document).ready(function() {
        $('#update-cart').on('click', function() {
            // Collect all the quantities
            var quantities = [];
            $('.pro-qty input').each(function() {
                var productId = $(this).data('product-id');
                var quantity = $(this).val();
                quantities.push({ product_id: productId, quantity: quantity });
            });

            // Send the quantities to the server via AJAX
            $.ajax({
                url: '{{ route("cart.updateQuantities") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    quantities: quantities
                },
                success: function(response) {
                    if (response.success) {
                        // Update the total price and quantities on the page
                        response.items.forEach(function(item) {
                            $('input[data-product-id="' + item.product_id + '"]').closest('tr').find('.shoping__cart__total').text(item.new_price + ' DA');
                        });
                        $('#total-price').text(response.new_total + ' DA');
                        $('#totalPanier').text(response.new_total + ' DA');

                    } else {
                        alert('Failed to update quantities. Please try again.');
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>




{{------------- ----------------------script pour mise à jour le prix aprés promotion---------------------------------------}}
<script>
    $(document).ready(function() {
        $('form[action="{{ route('apply.promo') }}"]').on('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting normally
            
            var form = $(this);
            var code = form.find('input[name="code"]').val();
            var token = form.find('input[name="_token"]').val();

            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: {
                    _token: token,
                    code: code
                },
                success: function(response) {
                    // Assuming your response contains the new total with discount
                    
                    // Update the total price in the UI
                    
                    $('#total-price').text(response.total + ' DA').css('color','green');
                    $('#totalitem').text(response.itemTotal + ' DA').css('color','green');
                    $('#promo-message').text('Promotion appliquée avec succès !').css('color', 'green');
                },
                error: function(xhr) {
                    // Handle errors
                    console.log(xhr.responseText);
                    $('#promo-message').text(' code promotion invalide !').css('color', 'red');
                }
            });
        });
    });
</script>

{{---------------------------- script pour mise à jour le prix aprés supprission d'un produit ----------------------- --}}

<script>
    $(document).ready(function() {
        $('.shoping__cart__item__close i').on('click', function(event) {
            event.preventDefault(); // Prevent any default action

            var $row = $(this).closest('tr'); // Get the closest row
            var productId = $row.data('product-id'); // Assume each row has a data attribute for the product ID

            $.ajax({
                url: '{{ route("panier.remove") }}', // Your route to handle the removal
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId
                },
                success: function(response) {
                    if (response.success) {
                        $row.remove(); // Remove the row from the table

                        // Optionally, update the total price
                        $('#totalPanier').text(response.new_total + ' DA');
                        $('#total-price').text(response.new_total + 'DA');
                    }
                },
                error: function(xhr) {
                    // Handle errors
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>
@endsection