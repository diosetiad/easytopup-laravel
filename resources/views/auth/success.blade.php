@extends('layouts.success')

@section('title')
    EASYTOPUP Success Page
@endsection

@section('content')
    <div class="page-content page-success">
      <div class="section-success" data-aos="zoom-in">
        <div class="container">
          <div class="row align-item-center row-login justify-content-center">
            <div class="col-lg-6 text-center">
              <img src="/images/success.svg" alt="" class="mb-4" />
              <h2>Welcome to EASYTOPUP</h2>
              <p>
                You have successfully registered <br />
                with us. Let’s shop now.
              </p>
              <div>
                <a href="{{ route('dashboard') }}" class="btn btn-success w-50 mt-4"> My Dashboard</a>
              </div>
              <div>
                <a href="{{ route('home') }}" class="btn btn-signup w-50 mt-2"> Go to Shopping</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection