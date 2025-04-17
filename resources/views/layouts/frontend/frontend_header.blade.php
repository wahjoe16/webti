<nav class="navbar navbar-expand-lg py-4 py-lg-0 shadow fixed-top">
    <div class="container-fluid px-5">
        <a href="{{ route('landing.index') }}"><img src="{{ url('frontend_page/img/TEKNIK-INDUSTRI.png') }}" alt="" style="height: 70px; width: auto;"></a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#top-navbar" aria-controls="top-navbar" aria-expanded="false" aria-label="Toggle navigation">
            <svg class="hamburger" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" transform="rotate(0 0 0)">
                <path d="M20 7.125L4 7.125C3.37868 7.125 2.875 6.62132 2.875 6C2.875 5.37868 3.37868 4.875 4 4.875L20 4.875C20.6213 4.875 21.125 5.37868 21.125 6C21.125 6.62132 20.6213 7.125 20 7.125ZM20 13.125L4 13.125C3.37868 13.125 2.875 12.6213 2.875 12C2.875 11.3787 3.37868 10.875 4 10.875L20 10.875C20.6213 10.875 21.125 11.3787 21.125 12C21.125 12.6213 20.6213 13.125 20 13.125ZM20 19.125L4 19.125C3.37868 19.125 2.875 18.6213 2.875 18C2.875 17.3787 3.37868 16.875 4 16.875L20 16.875C20.6213 16.875 21.125 17.3787 21.125 18C21.125 18.6213 20.6213 19.125 20 19.125Z" fill="#343C54"/>
            </svg>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="top-navbar" aria-labelledby="offcanvasRightLabel">
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#top-navbar" aria-controls="top-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <div class="d-flex justify-content-between p-3">
                    <img src="{{ url('frontend_page/img/TEKNIK-INDUSTRI.png') }}" alt="" style="height: 70px; width: auto;">
                    <svg class="hamburger" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.78362 8.78412C8.49073 9.07702 8.49073 9.55189 8.78362 9.84478L10.9388 12L8.78362 14.1552C8.49073 14.4481 8.49073 14.923 8.78362 15.2159C9.07652 15.5088 9.55139 15.5088 9.84428 15.2159L11.9995 13.0607L14.1546 15.2158C14.4475 15.5087 14.9224 15.5087 15.2153 15.2158C15.5082 14.9229 15.5082 14.448 15.2153 14.1551L13.0602 12L15.2153 9.84485C15.5082 9.55196 15.5082 9.07708 15.2153 8.78419C14.9224 8.4913 14.4475 8.4913 14.1546 8.78419L11.9995 10.9393L9.84428 8.78412C9.55139 8.49123 9.07652 8.49123 8.78362 8.78412Z" fill="#323544"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2ZM3.5 12C3.5 7.30558 7.30558 3.5 12 3.5C16.6944 3.5 20.5 7.30558 20.5 12C20.5 16.6944 16.6944 20.5 12 20.5C7.30558 20.5 3.5 16.6944 3.5 12Z" fill="#323544"/>
                    </svg>

                </div>
            </button>
            <ul class="navbar-nav ms-lg-auto me-lg-auto p-4 p-lg-0">
                <li class="nav-item px-3 px-lg-0 py-1 py-lg-4 dropdown">
                    <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Profil
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('landing.about') }}">Sejarah</a></li>
                        <li><a class="dropdown-item" href="{{ route('landing.visiMisi') }}">Visi Misi</a></li>
                        <li><a class="dropdown-item" href="#">Struktur Organisasi</a></li>
                        <li><a class="dropdown-item" href="#">Akreditasi</a></li>
                        <li><a class="dropdown-item" href="{{ route('landing.dosen') }}">Dosen</a></li>
                    </ul>
                </li>
                <li class="nav-item px-3 px-lg-0 py-1 py-lg-4 dropdown">
                    <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Akademik
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('landing.profilLulusan') }}">Profil Lulusan</a></li>
                        <li><a class="dropdown-item" href="{{ route('landing.mataKuliah') }}">Mata Kuliah</a></li>
                    </ul>
                </li>
                <li class="nav-item px-3 px-lg-0 py-1 py-lg-4 dropdown">
                    <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Kelompok Keahlian
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($data_kelompok as $dk)
                            <li><a class="dropdown-item" href="{{ route('landing.kelompokKeahlian', $dk->id) }}">{{ $dk->nama_kelompok }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item px-3 px-lg-0 py-1 py-lg-4 dropdown">
                    <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Laboratorium
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($data_lab as $dl)
                            <li><a class="dropdown-item" href="{{ route('landing.laboratorium', $dl->id) }}">{{ $dl->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item px-3 px-lg-0 py-1 py-lg-4 dropdown">
                    <a href="" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Download
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Panduan Kerja Praktik</a></li>
                        <li><a class="dropdown-item" href="#">Panduan Tugas Akhir</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Data Akreditasi</a></li>
                        <li><a class="dropdown-item" href="#">Sertifikat Akreditasi</a></li>
                    </ul>
                </li>
                <li class="nav-item px-3 px-lg-0 py-2 py-lg-4" style="margin-left: 90px;">
                    <a href="https://admission.unisba.ac.id/" class="btn btn-lg btn-admission">Admission <i class='bx bx-chevrons-right'></i></a>
                </li>
            </ul>
            
        </div>
    </div>
</nav>