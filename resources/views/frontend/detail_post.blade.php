@extends('layouts.frontend.frontend_layout')

@section('content')

<section id="about" class="py-5">
    <div class="container px-5 py-3">
        <div class="row about-header">
            <h3>{{ $post->title }}</h3>
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-9">
                <img src="{{ url('/media/posts/', $post->featured_image) }}" alt="post-image" class="img-fluid mb-3">
                <i class='bx bxs-purchase-tag'></i>&nbsp;&nbsp;<span class="post-cat">{{ $post->categories->name }}</span>&nbsp;&nbsp;&nbsp;&nbsp;
                <i class='bx bxs-user-pin'></i>&nbsp;&nbsp;Post by <span class="post-name">{{ $post->user->name }}</span><br>
                <small class="text-body-secondary">{{ tanggal_indonesia($post->post_date, false) }}</small>
                <hr>
                {!! $post->content !!}
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
</section>

@endsection