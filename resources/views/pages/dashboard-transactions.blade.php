@extends('layouts.dashboard')

@section('title')
    EASYTOPUP Dashboard Transaction
@endsection

@section('content')
    <!-- Section Content-->
          <div class="section-content section-dashboard-home" data-aos="fade-up">
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Transactions</h2>
                <p class="dashboard-subtitle">Big result start from the small one</p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                  <div class="col-12 mt-2">
                    <p class="nav-item">Buy Product</p>
                    <div class="tab-content" id="pills-tabContent">
                      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                       @foreach ($transaction_data as $transaction)
                        <a href="{{ route('dashboard-transaction-details', $transaction->id) }}" class="card card-list d-block">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-4">{{ $transaction->transaction_status ?? '' }}</div>
                          <div class="col-md-4">Rp. {{number_format ($transaction->total_cost ?? '') }}</div>
                          <div class="col-md-3">{{ $transaction->created_at ?? '' }}</div>
                          <div class="col-md-1 d-none d-md-block">
                            <img src="/images/dashboard-arrow-right.svg" alt="" />
                          </div>
                        </div>
                      </div>
                    </a>
                    @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection