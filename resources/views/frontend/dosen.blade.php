@extends('layouts.frontend.frontend_layout')

@section('content')

<section id="about" class="py-5">
    <div class="container px-5 py-3">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 about-header">
                <h6>DOSEN</h6>
                <h1>Teknik Industri <br> Unisba</h1>
                <hr>
                <div class="row row-cols-1 row-cols-md-3 g-4 my-4">
                    @foreach ($data_dosen as $dd)
                        <div class="col">
                            <div class="card shadow h-100 list-dosen" data-aos="fade-up" data-aos-duration="2000">
                                <img src="{{ url('/media/dosen/', $dd->profile_photo_path) }}" class="card-img-top" alt="...">
                                <div class="card-body text-center">
                                    <h5 class="card-title mt-4">{{ $dd->name }}</h5>
                                    <p class="card-text">Dosen dengan kelompok keahlian {{ $dd->nama_kelompok }}</p>
                                    <a href="{{ $dd->link }}" target="_blank" class="btn btn-danger mt-3" style="border-radius: 50px;">Detail</a>
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