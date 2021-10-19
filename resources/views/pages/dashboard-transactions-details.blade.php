@extends('layouts.dashboard')

@section('title')
    EASYTOPUP Dashboard Transaction Detail
@endsection

@section('content')
    <!-- Section Content-->
          <div class="section-content section-dashboard-home" data-aos="fade-up">
            <div class="container-fluid">
            @foreach ($transaction as $transactions)
              <div class="dashboard-heading">
                <h2 class="dashboard-title">#{{ $transactions->code }}</h2>
                <p class="dashboard-subtitle">Transactions Details</p>
              </div>
              <div class="dashboard-content" id="transactionDetails">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-12">
                            <div class="row">
                              <div class="col-12 col-md-12 col-lg-6">
                                <div class="product-title">Customer Name</div>
                                <div class="product-subtitle">{{ $transactions->user->name }}</div>
                              </div>
                              <div class="col-12 col-md-12 col-lg-6">
                                <div class="product-title">Mobile</div>
                                <div class="product-subtitle">{{ $transactions->user->phone_number }}</div>
                              </div>
                              <div class="col-12 col-md-12 col-lg-6">
                                <div class="product-title">Date of Transaction</div>
                                <div class="product-subtitle">{{ $transactions->created_at }}</div>
                              </div>
                              <div class="col-12 col-md-12 col-lg-6">
                                <div class="product-title">Total Amount</div>
                                <div class="product-subtitle">Rp. {{ number_format($transactions->total_cost) }}</div>
                              </div>
                              <div class="col-12 col-md-12 col-lg-12">
                                <div class="product-title">Payment Status</div>
                                <div class="product-subtitle text-danger">{{ $transactions->transaction_status }}</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <form action="{{ route('dashboard-transaction-update', $transactions->id) }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="row">
                          <div class="col-12 mt-4">
                            <h5>Shipping Information</h5>
                          </div>
                          <div class="col-12">
                          @foreach ($transactionDetail as $transaction)
                            <div class="row mb-4">
                              <div class="col-4 col-sm-4 col-md-4 col-lg-4">
                                <img src="{{ Storage::url($transaction->product->galleries->first()->photo ?? '') }}" class="w-100 mb-3" alt="" />
                              </div>
                              <div class="col-8 col-md-8 col-lg-8">
                                <div class="row">
                                  <div class="col-6 col-md-6 col-lg-6">
                                    <div class="product-title">Product Name</div>
                                    <div class="product-subtitle">{{ $transaction->product->name }}</div>
                                  </div>
                                  <div class="col-6 col-md-6 col-lg-6">
                                    <div class="product-title">Nickname</div>
                                    <div class="product-subtitle">{{ $transaction->nickname }}</div>
                                  </div>
                                  <div class="col-6 col-md-6 col-lg-6">
                                    <div class="product-title">ID Game</div>
                                    <div class="product-subtitle">{{ $transaction->game_id }}</div>
                                  </div>
                                  <div class="col-6 col-md-6 col-lg-6">
                                    <div class="product-title">Server Game</div>
                                    <div class="product-subtitle">{{ $transaction->server_id}}</div>
                                  </div>
                                  <div class="col-6 col-md-6 col-lg-6">
                                    <div class="product-title">Shipping Status</div>
                                    <div class="product-subtitle">{{ $transaction->shipping_status}}</div>
                                  </div>
                                </div>
                              </div> 
                            </div>
                          @endforeach
                          </div>
                          </div>
                            {{-- @if ($transactions->transaction_status == "SUCCESS") --}}
                            {{-- @if ($transaction->shipping_status == "PROCESS")
                            <div class="row">
                              <div class="col-6 col-sm-5 col-md-7 col-lg-5">
                                <div class="product-title">Confirm goods received</div>
                                <select name="shipping_status" id="status" class="form-control w-75" v-model="status">
                                  <option selected disabled value="{{ $transaction->shipping_status }}">{{ $transaction->shipping_status }}</option>   
                                  <option value="SUCCESS">SUCCESS</option>
                                </select>
                              </div>
                            </div>
                            @endif --}}
                            {{-- @if ($transaction->shipping_status == "PROCESS")
                            <div class="row mt-3">
                               <div class="col-12">
                                 <button type="submit" class="btn btn-success">Save</button>
                               </div>
                            </div>
                            @endif --}}
                            @if (  $transactions->transaction_status == 'SUCCESS' )
                            <div class="row mt-4">
                            <div class="col-12">
                                <h5>Product Reviews</h5>
                            </div>
                            <div class="col-12 col-md-12">
                              <input type="text" class="form-control" name="description" required value="{{ $review->description ?? ''}}" />
                            </div>
                            <div class=" col-12 mt-4">
                              <div class="container d-flex justify-content-center mb-3">
                                <div class="star-review">
                                  <input type="radio" value="5" name="stars" id="rate-5" {{ $review->stars == 5 || $review->stars == NULL ? 'checked' : '' }}>
                                  <label for="rate-5"> <i class="bi bi-star-fill"></i></label>

                                  <input type="radio" value="4" name="stars" id="rate-4" {{ $review->stars == 4 || $review->stars == NULL ? 'checked' : '' }}>
                                  <label for="rate-4"><i class="bi bi-star-fill"></i></label>

                                  <input type="radio" value="3" name="stars" id="rate-3" {{ $review->stars == 3 || $review->stars == NULL ? 'checked' : '' }}>
                                  <label for="rate-3"><i class="bi bi-star-fill"></i></label>

                                  <input type="radio" value="2" name="stars" id="rate-2" {{ $review->stars == 2 || $review->stars == NULL ? 'checked' : '' }}>
                                  <label for="rate-2"><i class="bi bi-star-fill"></i></label>

                                  <input type="radio" value="1" name="stars" id="rate-1" {{ $review->stars == 1 || $review->stars == NULL ? 'checked' : '' }}>
                                  <label for="rate-1"><i class="bi bi-star-fill"></i></label>
                                </div>
                              </div>
                            </div>
                            @if (  $review->description == NULL )
                            <div class="col-12">
                              <button class="btn btn-success btn-block">Send a review</button>
                            </div>
                            @endif
                            </div>
                            @endif
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
      var transactionDetails = new Vue({
        el: "#transactionDetails",
        data: {
          status: "{{ $transaction->shipping_status }}",
        },
      });
    </script>
@endpush