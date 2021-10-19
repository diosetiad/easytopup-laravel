@extends('layouts.app')

@section('title')
    EASYTOPUP Detail Page
@endsection

@section('content')
    <!-- Page Content-->
    <div class="page-content page-details">
      <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <nav>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Product Details</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </section>

      <section class="store-gallery mb-3" id="gallery">
        <div class="container">
          <div class="row">
            <div class="col-lg-8" data-aos="zoom-in">
              <transition name="slide-fade" mode="out-in">
                <img :src="photos[activePhoto].url" :key="photos[activePhoto].id" class="w-100 main-image" alt="" />
              </transition>
            </div>
            <div class="col-lg-2">
              <div class="row">
                <div class="col-3 col-lg-12 mt-2 mt-lg-0" v-for="(photo, index) in photos" :key="photo.id" data-aos="zoom-in" data-aos-delay="100">
                  <a href="#" @click="changeActive(index)">
                    <img :src="photo.url" class="w-100 thumbnail-image" :class="{ active: index == activePhoto }" alt="" />
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <div class="store-details-container" data-aos="fade-up">
        <section class="store-heading">
          <div class="container">
            <div class="row">
              <div class="col-lg-8">
                <h1>{{ $product->name }}</h1>
                <div class="price">Rp. {{ number_format($product->price) }}</div>
              </div>
              <div class="col-lg-2" data-aos="zoom-in">
                @auth
                    @if (Auth::user()->roles == 'USER') 
                    <form action="{{ route('detail-add', $product->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <button type="submit" class="btn btn-success px-4 text-white btn-block mb-3"> Add to Cart </button>
                    </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-success px-4 text-white btn-block mb-3"> Sign in to Add </a>
                @endauth
              </div>
            </div>
          </div>
        </section>
        <section class="store-description">
          <div class="container">
            <div class="row">
              <div class="col-12 col-lg-8">
                {!! $product->description !!}
              </div>
            </div>
          </div>
        </section>
        <section class="store-review container">
          <div class="row">
              <div class="col-lg-8 col-md-8 col-12 mt-2">
                  <div class="card">
                      <div class="card-body p-0">
                          <h5 class="card-title bg-light pt-2 pb-2">
                              Product Review ({{ $total_review }})
                          </h5>
                          <div class="card-title py-2 px-2">
                             @foreach ( $review as $reviews)
                              @if (!($reviews->description == NULL))
                              <div class="media border-bottom mb-4">
                              @if ($reviews->user->photo != NULL)
                               <img 
                                src="{{ Storage::url($reviews->user->photo ?? '') }}" 
                                class="mr-3" 
                                alt="..."
                              >
                              @else
                              <img 
                                src= "/images/icon-testimonial-2.png" 
                                class="mr-3" 
                                alt="..."
                              >
                              @endif
                              <div class="media-body">
                                <div class="row">
                                  <div class="col-12">
                                    <h5 class="mt-0 text-capitalize">{{ $reviews->user->name }}</h5>
                                  </div>
                                  <div class="col-12">
                                    <div class="media-star mt-0">
                                      <div class="star-review">
                                          <input type="radio" id="rate-5" {{ $reviews->stars == 5 || $reviews->stars == NULL ? 'checked' : '' }}>
                                          <label for="rate-5"> <i class="bi bi-star-fill"></i></label>

                                          <input type="radio" id="rate-4" {{ $reviews->stars == 4 || $reviews->stars == NULL ? 'checked' : '' }}>
                                          <label for="rate-4"><i class="bi bi-star-fill"></i></label>

                                          <input type="radio" id="rate-3" {{ $reviews->stars == 3 || $reviews->stars == NULL ? 'checked' : '' }}>
                                          <label for="rate-3"><i class="bi bi-star-fill"></i></label>

                                          <input type="radio" id="rate-2" {{ $reviews->stars == 2 || $reviews->stars == NULL ? 'checked' : '' }}>
                                          <label for="rate-2"><i class="bi bi-star-fill"></i></label>

                                          <input type="radio" id="rate-1" {{ $reviews->stars == 1 || $reviews->stars == NULL ? 'checked' : '' }}>
                                          <label for="rate-1"><i class="bi bi-star-fill"></i></label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-12">
                                    <p>{{ $reviews->description }}</p>
                                  </div>
                                </div>
                              </div>
                          </div>
                              @endif   
                             @endforeach
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>

        {{-- <section class="store-review">
          <div class="container">
            <div class="row">
              <div class="col-12 col-lg-8 mt-3 mb-3">
                <h5>Customer Review (3)</h5>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-8">
                <ul class="list-unstyled">
                  <li class="media">
                    <img src="/images/icon-testimonial-1.png" alt="" class="mr-3 rounded-circle" />
                    <div class="media-body">
                      <h5 class="mt-2 mb-1">Hazza Risky</h5>
                      Terima kasih, pengiriman sangat cepat.
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </section> --}}
      </div>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
      var gallery = new Vue({
        el: "#gallery",
        mounted() {
          AOS.init();
        },
        data: {
          activePhoto: 0,
          photos: [
            @foreach($product->galleries as $gallery)
              {
              id: {{ $gallery->id }},
              url: "{{ Storage::url($gallery->photo) }}",
            },
            @endforeach
          ],
        },
        methods: {
          changeActive(id) {
            this.activePhoto = id;
          },
        },
      });
    </script>
@endpush