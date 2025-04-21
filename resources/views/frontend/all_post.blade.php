@extends('layouts.frontend.frontend_layout')

@section('content')

<section id="about" class="py-5">
    <div class="container px-5 py-3">
        <div class="row about-header">
            <h6>BERITA</h6>
            <h1>Teknik Industri <br> Unisba</h1>
            <hr>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 py-3">
                @foreach ($data_post as $dp)
                    <div class="col">
                        <div class="card shadow mb-4" data-aos="fade-up" data-aos-duration="2000">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="{{ url('/media/posts/', $dp->featured_image) }}" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8 feature-caption">
                                    <div class="card-body">
                                        <h5 class="card-title mb-5">{{ $dp->title }}</h5><i class='bx bxs-purchase-tag'></i>&nbsp;&nbsp;<span class="post-cat">{{ $dp->categories->name }}</span><br>
                                        <i class='bx bxs-user-pin'></i>&nbsp;&nbsp;Post by <span class="post-name">{{ $dp->user->name }}</span><br>
                                        <small class="text-body-secondary">{{ tanggal_indonesia($dp->post_date, false) }}</small><br>
                                        <a href="{{ route('landing.showPost', ['slug' => $dp->slug]) }}" target="_blank" class="btn btn-danger btn-sm mt-3">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="d-flex justify-content-between mb-4">
                    <div>
                        @if (!$data_post->onFirstPage())
                            <a class="btn btn-primary text-uppercase" href="{{ $data_post->previousPageUrl() }}">&larr; Newer Post</a>
                        @endif
                    </div>
                    <div>
                        @if ($data_post->hasMorePages())
                            <a class="btn btn-primary text-uppercase" href="{{ $data_post->nextPageUrl() }}">&rarr; Older Post</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection