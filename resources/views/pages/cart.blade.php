@extends('layouts.app')

@section('title')
    EASYTOPUP Cart Page
@endsection

@section('content')
    <!-- Page Content-->
    <div class="page-content page-cart">
      <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <nav>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Cart</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </section>

      <section class="store-cart">
        <div class="container">
        <form id="form" name="form" enctype="multipart/form-data" method="POST">
            @csrf
          @php $totalCost = 0 @endphp
          @foreach ($carts as $cart)
          <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-12 table-responsive">
              <table class="table table-borderless table-cart">
                <thead>
                  <tr>
                    <td>Image</td>
                    <td>Name</td>
                    <td>Price</td>
                    <td>Menu</td>
                  </tr>
                </thead>
                <tbody>
                      <tr>
                    <td style="width: 20%">@if ($cart->product->galleries)
                      <img src="{{ Storage::url($cart->product->galleries->first()->photo) }}" alt="" class="cart-image"/>
                    @endif</td>
                    <td style="width: 35%">
                      <div class="product-title">{{ $cart->product->name }}</div>
                    </td>
                    <td style="width: 35%"><div class="product-price">Rp. {{ number_format($cart->product->price) }}</div>
                    <div class="product-subtitle">IDR</div>
                    </td>
                    <td style="width: 20%">
                      <button onclick="removeCart(this)" data-idcart="{{ $cart->id }}" class="btn btn-remove-cart"> Remove </button>
                    </td>
                  </tr>
                   @php
                    $totalCost += $cart->product->price
                  @endphp
                </tbody>
              </table>
            </div>
          </div>
          <div class="row" data-aos="fade-up" data-aos-delay="150">
            <div class="col-12">  
            </div>
            <div class="col-12">
              <h2 class="mb-4">Shipping Details</h2>
            </div>
          </div>
          <input type="hidden" name="total_cost" value="{{ $totalCost }}">
            <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
            <div class="col-md-3">
              <div class="form-group">
                <label for="nickname">Nickname</label>
                <input type="text" class="form-control" id="nickname" name="nickname[]"/>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="game_id">ID Game</label>
                <input type="text" class="form-control" id="game_id" name="game_id[]" />
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="server_id">Server Game</label>
                <input type="text" class="form-control" id="server_id" name="server_id[]" />
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="phone_number">Mobile</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" />
              </div>
            </div>
          </div>
          <div class="row" data-aos="fade-up" data-aos-delay="150">
            <div class="col-12">
              <hr />
              @endforeach
            </div>
          <div class="container">
          <div class="row" data-aos="fade-up" data-aos-delay="200">
            @if ($totalCost != 0)
            <div class="col-12">
              <h2 class="mb-2">Payment Informations</h2>
            </div>
            <div class="col-12 col-md-4 col-lg-4">
              <div class="product-title text-success">Rp. {{ number_format($totalCost ?? 0) }}</div>
              <div class="product-subtitle">Total</div>
            </div>
            <div class="col-12 col-md-4 col-lg-4">
              <button onclick="checkout()" type="button" class="btn btn-success mt-4 px-4 btn-block">Checkout Now</button>
            </div>
            @else
              <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                No Items Found
              </div>
            @endif
          </div>
          </div>  
        </form>
        </div>
      </section>
    </div>
@endsection

@push('addon-script')
    <script>

    const form=document.getElementById("form");
    function removeCart(cartId) {
      let id = cartId.getAttribute("data-idcart");
      form.action=`/cart/${id}`;
      form.submit();
    }
    
      
      function checkout() {
        var gameId = document.getElementsByName("game_id[]");
        var nickname = document.getElementsByName("nickname[]");
        var serverId = document.getElementsByName("server_id[]");
        var phoneNumber = document.getElementsByName("phone_number");

        for (var i = 0; i < nickname.length; i++) {
        if (
          nickname[i].value == "" ||
          nickname[i].value == null ||
          nickname[i].value == undefined
        ) {
          alert("Please fill in the nickname field");
          return false;
        }
      }

      for (var i = 0; i < gameId.length; i++) {
        if (
          gameId[i].value == "" ||
          gameId[i].value == null ||
          gameId[i].value == undefined
        ) {
          alert("Please fill in the id game field");
          return false;
        }
      }

      for (var i = 0; i < serverId.length; i++) {
        if (
          serverId[i].value == "" ||
          serverId[i].value == null ||
          serverId[i].value == undefined
        ) {
          alert("Please fill in the server game field");
          return false;
        }
      }

        for (var i = 0; i < phoneNumber.length; i++) {
        if (
          phoneNumber[i].value == "" ||
          phoneNumber[i].value == null ||
          phoneNumber[i].value == undefined
        ) {
          alert("Please fill in the mobile field");
          return false;
        }
      }
        
      form.action="{{ route('checkout') }}";
      form.submit();
    }


  </script>
@endpush