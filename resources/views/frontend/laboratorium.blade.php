@extends('layouts.frontend.frontend_layout')

@section('content')

<section id="about" class="py-5">
    <div class="container px-5 py-3">
        <div class="row"  data-aos="fade-left" data-aos-duration="2000">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 about-header">
                <h6>LABS</h6>
                <h1>{{ $data->name }}</h1>
                <p class="text-muted">{!! $data->description !!}</p>
                <hr>
                <div class="row row-cols-1 row-cols-md-2 g-4 my-4">
                    
                </div>
            </div>
        </div>
        <div class="row py-2 row-gallery-lab">
            <div class="column">
                <img src="{{ url('/media/labs/', $data->image_1) }}" alt="" data-aos="fade-right" data-aos-duration="2000">
                <img src="{{ url('/media/labs/', $data->image_2) }}" alt="" data-aos="fade-right" data-aos-duration="2000">
            </div>
            <div class="column">
                <img src="{{ url('/media/labs/', $data->image_3) }}" alt="" data-aos="fade-left" data-aos-duration="2000">
                <img src="{{ url('/media/labs/', $data->image_4) }}" alt="" data-aos="fade-left" data-aos-duration="2000">
                <img src="{{ url('/media/labs/', $data->image_5) }}" alt="" data-aos="fade-left" data-aos-duration="2000">
            </div>
        </div>
    </div>
</section>

@endsection