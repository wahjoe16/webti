@extends('layouts.frontend.frontend_layout')

@section('content')

<section id="about" class="py-5">
    <div class="container px-5 py-3">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 about-header" data-aos="fade-right" data-aos-duration="3000">
                <h6>SEJARAH</h6>
                <h1>Teknik Industri<br>Unisba</h1>
                <hr>
                <p class="content-description">{!! $data_about->description !!}</p>
                <p class="content-about">{!! $data_about->content !!}</p>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 offset-md-1" data-aos="fade-left" data-aos-duration="3000">
                <img class="about-img img-fluid mb-3" src="{{ url('/media/histories/', $data_about->image_1) }}" alt="About Us">
                <img class="about-img img-fluid mb-3" src="{{ url('/media/histories/', $data_about->image_2) }}" alt="About Us">
                <img class="about-img img-fluid mb-3" src="{{ url('/media/histories/', $data_about->image_3) }}" alt="About Us">
            </div>
        </div>
        <div class="row text-center mt-5 mb-5">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 about-header">
                <h6>SEJARAH</h6>
                <h1>Ketua Program Studi</h1>
                <hr>
                <div class="row row-cols-1 row-cols-md-4 g-4 mt-3" data-aos="fade-up" data-aos-duration="3000">
                    @foreach ($data_kaprodi as $dk)
                        <div class="col">
                            <div class="card shadow h-100">
                            <img src="{{ url('/media/kaprodi/', $dk->photo) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title mt-4">{{ $dk->name }}</h5>
                                <p class="card-text text-muted">Periode {{ $dk->periode }}</p>
                            </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@endsection