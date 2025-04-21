@extends('layouts.frontend.frontend_layout')

@section('content')

<section id="about" class="py-5">
    <div class="container px-5 py-3">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 about-header">
                <h6  data-aos="fade-left" data-aos-duration="2000">KELOMPOK KEAHLIAN</h6>
                <h1  data-aos="fade-left" data-aos-duration="2000">{{ $data->nama_kelompok }}</h1>
                <p class="text-muted"  data-aos="fade-left" data-aos-duration="2000">{{ $data->description }}</p>
                <hr>
                <div class="row row-cols-1 row-cols-md-3 g-4 my-4"  data-aos="fade-up" data-aos-duration="2000">
                    @foreach ($dosenAhli as $da)
                        <div class="col">
                            <div class="card shadow h-100 list-dosen">
                                <img src="{{ url('/media/dosen/', $da->profile_photo_path) }}" class="card-img-top" alt="...">
                                <div class="card-body text-center">
                                    <h5 class="card-title mt-4">{{ $da->name }}</h5>
                                    <a href="{{ $da->link }}" target="_blank" class="btn btn-danger mt-3" style="border-radius: 50px;">Detail</a>
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