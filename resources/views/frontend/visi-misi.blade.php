@extends('layouts.frontend.frontend_layout')

@section('content')

<section id="about" class="py-5">
    <div class="container px-5 py-3">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 about-header" data-aos="fade-right" data-aos-duration="3000">
                <h6>VISI MISI</h6>
                <h1>Teknik Industri<br>Unisba</h1>
                <hr>
                <p class="text-muted">{!! $dataVisiMisi->content !!}</p>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 offset-md-1" data-aos="fade-left" data-aos-duration="3000">
                <img class="about-img img-fluid mb-3" src="{{ url('/media/visi-misi/', $dataVisiMisi->image_1) }}" alt="visi-misi">
                @if ($dataVisiMisi->image_2 != '')
                    <img class="about-img img-fluid mb-3" src="{{ url('/media/visi-misi/', $dataVisiMisi->image_2) }}" alt="visi-misi">
                @endif
                @if ($dataVisiMisi->image_3 != '')
                    <img class="about-img img-fluid mb-3" src="{{ url('/media/visi-misi/', $dataVisiMisi->image_3) }}" alt="visi-misi">
                @endif
                
            </div>
        </div>
    </div>
</section>

@endsection