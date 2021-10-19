@extends('layouts.admin')

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
                              <div class="col-12 col-md-2">
                                <div class="product-title">Customer Name</div>
                                <div class="product-subtitle">{{ $transactions->user->name }}</div>
                              </div>
                              <div class="col-12 col-md-3">
                                <div class="product-title">Date of Transaction</div>
                                <div class="product-subtitle">{{ $transactions->created_at }}</div>
                              </div>
                              <div class="col-12 col-md-3">
                                <div class="product-title">Payment Status</div>
                                <div class="product-subtitle text-danger">{{ $transactions->transaction_status }}</div>
                              </div>
                              <div class="col-12 col-md-2">
                                <div class="product-title">Mobile</div>
                                <div class="product-subtitle">{{ $transactions->user->phone_number }}</div>
                              </div>
                              <div class="col-12 col-md-2">
                                <div class="product-title">Total Amount</div>
                                <div class="product-subtitle">Rp. {{ number_format($transactions->total_cost) }}</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12 mt-4">
                            <h5>Shipping Information</h5>
                          </div>
                          <div class="col-12">
                          <form method="POST" action="{{ route('admin-transaction-details-update', $transactions->id) }}">
                                @csrf
                          @foreach ($transactionDetail as $transaction)
                            <div class="row mt-4">
                              <div class="col-12 col-md-2">
                                <img src="{{ Storage::url($transaction->product->galleries->first()->photo ?? '') }}" class="w-100 mb-3" alt="" /> 
                              </div>
                              <div class="col-12 col-md-2">
                                <div class="product-title">Product Name</div>
                                <div class="product-subtitle">{{ $transaction->product->name  }}</div>
                              </div>
                              <div class="col-12 col-md-2">
                                <div class="product-title">Nickname</div>
                                <div class="product-subtitle">{{ $transaction->nickname  }}</div>
                              </div>
                              <div class="col-12 col-md-2">
                                <div class="product-title">ID Game</div>
                                <div class="product-subtitle">{{ $transaction->game_id }}</div>
                              </div>
                              <div class="col-12 col-md-2">
                                <div class="product-title">Server Game</div>
                                <div class="product-subtitle">{{ $transaction->server_id }}</div>
                              </div>
                              <div class="col-12 col-md-2">
                                <input type="hidden" name="id_transaksi" value="{{ $transactions->id }}">
                                <div class="product-title">Shipping Status</div>
                                  <select name="shipping_status" id="status" class="form-control">   
                                  @if ($transactions->transaction_status == 'PAID')
                                    <option selected disabled value="{{ $transaction->shipping_status }}">{{ $transaction->shipping_status }}</option>
                                  @endif
                                  @if ($transactions->transaction_status == 'PENDING')
                                    <option selected disabled value="PENDING">PENDING</option>
                                  @else
                                    <option value="SUCCESS">SUCCESS</option>
                                  @endif
                                  </select>
                              </div>   
                            </div>
                          @endforeach
                          @if($transactions->transaction_status == 'PAID')
                          <div class="row mt-2">
                            <div class="col-12 text-right">
                              <button type="submit" class="btn btn-success">Save</button>
                            </div>
                          </div>
                          @endif 
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
            </div>
          </div>
@endsection