@extends('layouts.frontend.frontend_layout')

@section('content')

<section id="about" class="py-5">
    <div class="container px-5 py-3">
        <div class="row text-center mb-5 about-header">
            <h1>Profil Lulusan Kurikulum 2015</h1>
            <h6 class="mt-4">Dekripsi Profil Luusan</h6>
            @foreach ($profil2015 as $p2015)
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $p2015->title }}</h5>
                            <p class="card-text text-muted">{{ $p2015->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row text-center about-header">
            <h1 class="mt-5">Profil Lulusan Kurikulum 2020</h1>
            <h6 class="mt-4">Dekripsi Profil Luusan</h6>
            @foreach ($profil2020 as $p2020)
                <div class="col-sm-6 mb-4 mb-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $p2020->title }}</h5>
                            <p class="card-text text-muted">{{ $p2020->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection