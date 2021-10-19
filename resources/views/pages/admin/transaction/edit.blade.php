{{-- @extends('layouts.admin')

@section('title')
    Transaction
@endsection

@section('content')
    <!-- Section Content-->
          <div class="section-content section-dashboard-home" data-aos="fade-up">
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Transaction</h2>
                <p class="dashboard-subtitle">Edit Transaction</p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('transaction.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Transaction Status</label>
                                                <select name="transaction_status" class="form-control">
                                                    @if ($item->transaction_status == 'SUCCESS')
                                                    <option selected disabled value="{{ $item->transaction_status }}">{{ $item->transaction_status }}</option>
                                                    @else
                                                    <option selected disabled value="PENDING">PENDING</option>
                                                    <option value="PAID">PAID</option>
                                                    <option value="SUCCESS">SUCCESS</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Total Price</label>
                                                <input type="number" name="total_cost" class="form-control" value="{{ $item->total_cost }}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($item->transaction_status == 'PENDING')
                                    <div class="row">
                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-success px-5">
                                                Save Now
                                            </button>
                                        </div>
                                    </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
            CKEDITOR.replace( 'editor' );
    </script>
@endpush --}}