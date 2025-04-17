        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    {{-- <i class="fas fa-laugh-wink"></i> --}}
                </div>
                <div class="sidebar-brand-text mx-3"><strong>Teknik Industri</strong> UNISBA</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                News & Post
            </div>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('category.index') }}">
                    <i class="bx bxs-category text-gray-300"></i>
                    <span>Categories</span>
                </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item {{ Route::is('post.index') || Route::is('post.create') ? 'active' : '' }}">
                <a class="nav-link collapsed" href="javascript:;" data-toggle="collapse" data-target="#collapsePosts"
                    aria-expanded="true" aria-controls="collapsePosts">
                    <i class="bx bx-news text-gray-300"></i>
                    <span>Posts</span>
                </a>
                <div id="collapsePosts" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Route::is('post.create') ? 'active' : '' }}" href="{{ route('post.create') }}">Add new post</a>
                        <a class="collapse-item {{ Route::is('post.index') ? 'active' : '' }}" href="{{ route('post.index') }}">Posts</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Pages & Data
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#landingPage"
                    aria-expanded="true" aria-controls="landingPage">
                    <i class="fas fa-fw fa-folder text-gray-300"></i>
                    <span>Landing Page</span>
                </a>
                <div id="landingPage" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('banner.index') }}">Banner</a>
                        <a class="collapse-item" href="{{ route('testimonials.index') }}">Testimonials</a>
                        <a class="collapse-item" href="{{ route('greetings.index') }}">Kolom Kaprodi</a>
                        <a class="collapse-item" href="{{ route('features.index') }}">Features</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder text-gray-300"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Profil</h6>
                        <a class="collapse-item" href="{{ route('histories.index') }}">Sejarah</a>
                        <a class="collapse-item" href="{{ route('visi-misi.index') }}">Visi Misi</a>
                        <a class="collapse-item" href="{{ route('struktur-organisasi.index') }}">Struktur Organisasi</a>
                        <a class="collapse-item" href="{{ route('akreditasi.index') }}">Akreditasi</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Akademik</h6>
                        <a class="collapse-item" href="{{ route('profil-lulusan.index') }}">Profil Lulusan</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dosen.index') }}">
                    <i class="bx bxs-graduation text-gray-300"></i>
                    <span>Data Dosen</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('matkul.index') }}">
                    <i class="bx bxs-book text-gray-300"></i>
                    <span>Data Mata Kuliah</span>
                </a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('labs.index') }}">
                    <i class="bx bx-desktop text-gray-300"></i>
                    <span>Data Lab</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('kelompok-keahlian.index') }}">
                    <i class='bx bxs-book-content text-gray-300'></i>
                    <span>Data Kelompok Keahlian</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('kaprodi.index') }}">
                    <i class="bx bxs-graduation text-gray-300"></i>
                    <span>Data Ketua Program Studi</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>