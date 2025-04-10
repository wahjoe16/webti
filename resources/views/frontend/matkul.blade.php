@extends('layouts.frontend.frontend_layout')

@section('content')

<section id="about" class="py-5">
    <div class="container px-5 py-3">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 about-header">
                <h6>MATA KULIAH</h6>
                <h1>Teknik Industri<br>Unisba</h1>
            </div>
            <hr>
        </div>
        <div class="row py-3">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <div class="col list-smt">
                        <h5>Semester 1</h5>
                        <ul class="list-group list-group-flush">
                            @foreach ($matkul1 as $m1)
                                <li class="list-group-item text-muted"><i class='bx bx-chevron-right'></i> {{ $m1->nama }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col list-smt">
                        <h5>Semester 2</h5>
                        <ul class="list-group list-group-flush">
                            @foreach ($matkul2 as $m2)
                                <li class="list-group-item text-muted"><i class='bx bx-chevron-right'></i> {{ $m2->nama }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col list-smt">
                        <h5>Semester 3</h5>
                        <ul class="list-group list-group-flush">
                            @foreach ($matkul3 as $m3)
                                <li class="list-group-item text-muted"><i class='bx bx-chevron-right'></i> {{ $m3->nama }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col list-smt">
                        <h5>Semester 4</h5>
                        <ul class="list-group list-group-flush">
                            @foreach ($matkul4 as $m4)
                                <li class="list-group-item text-muted"><i class='bx bx-chevron-right'></i> {{ $m4->nama }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-4 g-4 mt-3">
                    <div class="col list-smt">
                        <h5>Semester 5</h5>
                        <ul class="list-group list-group-flush">
                            @foreach ($matkul5 as $m5)
                                <li class="list-group-item text-muted"><i class='bx bx-chevron-right'></i> {{ $m5->nama }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col list-smt">
                        <h5>Semester 6</h5>
                        <ul class="list-group list-group-flush">
                            @foreach ($matkul6 as $m6)
                                <li class="list-group-item text-muted"><i class='bx bx-chevron-right'></i> {{ $m6->nama }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col list-smt">
                        <h5>Semester 7</h5>
                        <ul class="list-group list-group-flush">
                            @foreach ($matkul7 as $m7)
                                <li class="list-group-item text-muted"><i class='bx bx-chevron-right'></i> {{ $m7->nama }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col list-smt">
                        <h5>Semester 8</h5>
                        <ul class="list-group list-group-flush">
                            @foreach ($matkul8 as $m8)
                                <li class="list-group-item text-muted"><i class='bx bx-chevron-right'></i> {{ $m8->nama }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection