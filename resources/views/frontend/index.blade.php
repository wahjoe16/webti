@extends('layouts.frontend.frontend_layout')

@section('content')

<section id="welcome" class="py-5" data-aos="fade-up" data-aos-duration="3000">
    <div class="container px-2 py-3">
        <div class="row align-items-center">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 welcome-image-1">
                <img src="{{ url('/media/banner/', $data_banner->image_1) }}" alt="" style="width: 250px; height:auto; border-radius: 10px;">
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 welcome-image-2">
                <img src="{{ url('/media/banner/', $data_banner->image_2) }}" alt="" style="width: 250px; height:auto; border-radius: 10px; margin-bottom:8px;">
                <img src="/media/banner/1741834195-IMG_2174-scaled.jpg" alt="" style="width: 250px; height:auto; border-radius: 10px;">
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 px-lg-0">
                <div class="welcome-description">
                    <h6>PROGRAM STUDI</h6>
                    <h1>Teknik Industri</h1>
                    <h3>Universitas Islam Bandung</h3>
                    <p>{{ $data_banner->caption }}</p>
                    <a href="{{ route('landing.about') }}" class="btn">Selengkapnya <i class='bx bx-chevrons-down'></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="counter" class="py-5">
    <div class="container px-2 py-3">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-6">
                <div class="counter-item">
                    <div class="counter-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="counter-value" data-target="30">0</div>
                    <div class="counter-title">Tahun Pengalaman</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="counter-item">
                    <div class="counter-icon">
                        <i class="fas fa-university"></i>
                    </div>
                    <div class="counter-value" data-target="25">0</div>
                    <div class="counter-title">Tenaga Pengajar</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="counter-item">
                    <div class="counter-icon">
                        <i class="fas fa-university"></i>
                    </div>
                    <div class="counter-value" data-target="4">0</div>
                    <div class="counter-title">Laboratorium</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="counter-item">
                    <div class="counter-icon">
                        <i class="fas fa-university"></i>
                    </div>
                    <div class="counter-value" data-target="2000">0</div>
                    <div class="counter-title">lulusan</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="testimonials" data-aos="zoom-in" data-aos-duration="3000">
    <div class="container-fluid px-2 px-md-4 mx-auto">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-9 col-xl-8">
                <div class="testimonial mySwiper">
                    <div class="testi-content swiper-wrapper">
                        @foreach ($data_testi as $dt)
                            <div class="slide swiper-slide">
                                <img src="{{ url('/media/testimonial/' . $dt->photo) }}" class="image" alt="">
                                <p>
                                    {{ $dt->content }}
                                </p>
                                <i class='bx bxs-quote-alt-right quote-icon'></i>

                                <div class="details">
                                    <span class="name">{{ $dt->name }}</span>
                                    <span class="job">{{ $dt->position }} di {{ $dt->company }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next nav-btn"></div>
                    <div class="swiper-button-prev nav-btn"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="greeting">
    <div class="container py-3">
        <div class="row align-items-center justify-content-evenly">
            <div class="col-lg-5" data-aos="fade-right" data-aos-duration="3000">
                <div class="greeting-caption">
                    <h6>KETUA PROGRAM STUDI</h6>
                    <h1>Teknik Industri</h1>
                    <h3>{{ $data_greeting->name }}</h3>
                    <p>{{ $data_greeting->message }}</p>
                    <a href="" class="btn">Selengkapnya <i class='bx bx-chevrons-right'></i></a>
                </div>
            </div>
            <div class="col-lg-5 greeting-img" data-aos="fade-left" data-aos-duration="3000">
                <img class="img-fluid" src="{{ url('/media/greeting/', $data_greeting->photo) }}" alt="">
            </div>
        </div>
    </div>
</section>

<section id="features" class="py-5">
    <div class="container-fluid px-4">
        <div class="row">
            @foreach ($data_feature as $df)
                <div class="col-lg-6">
                    <div class="card shadow mb-4" data-aos="zoom-in" data-aos-duration="1000">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ url('/media/feature/', $df->image) }}" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8 feature-caption">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $df->name }}</h5>
                                    <p class="card-text">{{ $df->description }}</p>
                                    {{-- <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section id="posts" data-aos="fade-up" data-aos-duration="3000">
    <div class="container">
        <h3 class="text-center">Berita Teknik Industri</h3>
        <div class="row mt-4">
            <div class="card-group">
                @foreach($data_post as $dp)
                    <div class="card">
                        <img src="{{ url('/media/posts/', $dp->featured_image) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title mb-5">{{ $dp->title }}</h5>
                            <i class='bx bxs-purchase-tag'></i>&nbsp;&nbsp;<span class="post-cat">{{ $dp->categories->name }}</span><br>
                            <i class='bx bxs-user-pin'></i>&nbsp;&nbsp;Post by <span class="post-name">{{ $dp->user->name }}</span><br>
                            <a href="{{ route('landing.showPost', ['slug' => $dp->slug]) }}" target="_blank" class="btn btn-danger btn-sm mt-3">Detail</a>
                        </div>
                        <div class="card-footer">
                            <small class="text-body-secondary">{{ tanggal_indonesia($dp->post_date, false) }}</small>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('landing.listPost') }}" class="btn btn-more-posts">Selengkapnya <i class='bx bx-chevrons-right'></i></a>
            </div>
        </div>
    </div>
</section>

<section id="admission" class="py-5" data-aos="fade-left" data-aos-duration="3000">
    <div class="container admission-padding">
        <div class="col-md-6">
            <div class="admission-caption">
                <h5>PENERIMAAN MAHASISWA BARU</h5>
                <h1>Bergabunglah Bersama Kami Untuk Menjadi Ahli di Bidang Industri</h1>
                <a href="https://admission.unisba.ac.id/" class="btn">Admission Link <i class='bx bx-chevrons-right'></i></a>
            </div>
        </div>
    </div>
</section>

<section id="maps" data-aos="zoom-in" data-aos-duration="3000">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.8891631069014!2d107.60579637367151!3d-6.9038559930954575!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6466a488595%3A0x256cbfba75fb4e60!2sTeknik%20Industri%20-%20UNISBA!5e0!3m2!1sen!2sid!4v1742372673085!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</section>

@endsection

@push('frontend_scripts')
    <script>
        // counter
        let valueDisplays = document.querySelectorAll(".counter-value");
        let interval = 4000;

        valueDisplays.forEach((valueDisplay) => {
            let startValue = 0;
            let endValue = parseInt(valueDisplay.getAttribute("data-target"));
            let duration = Math.floor(interval / endValue);
            let counter = setInterval(function () {
                startValue += 1;
                valueDisplay.textContent = startValue;
                if (startValue >= endValue) {
                    clearInterval(counter);
                }
            }, duration);
        });
    </script>

    <script>
        // testimonial carousel
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                type: 'bullets',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            // breakpoints: {
            //     768: {
            //         slidesPerView: 2,
            //     },
            //     1024: {
            //         slidesPerView: 3,
            //     }
            // }
        })
    </script>
@endpush