<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\DetailUserDosen;
use App\Models\Feature;
use App\Models\Greeting;
use App\Models\History;
use App\Models\Kaprodi;
use App\Models\KelompokKeahlian;
use App\Models\Lab;
use App\Models\Matkul;
use App\Models\Post;
use App\Models\ProfilLulusan;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $data_banner = Banner::latest()->first();
        $data_testi = Testimonial::latest()->get();
        $data_greeting = Greeting::latest()->first();
        $data_feature = Feature::paginate(4);
        $data_post = Post::with(['categories', 'user'])->latest()->paginate(3);
        $data_kelompok = KelompokKeahlian::orderBy('nama_kelompok', 'ASC')->get();
        $data_lab = Lab::get();
        // dd($data_testi);

        return view('frontend.index', compact(
            'data_banner', 'data_kelompok', 'data_lab',
            'data_testi', 'data_greeting', 'data_feature',
            'data_post'
        ));
    }

    public function about()
    {
        $data_about = History::first();
        $data_kelompok = KelompokKeahlian::orderBy('nama_kelompok', 'ASC')->get();
        $data_lab = Lab::get();
        $data_kaprodi = Kaprodi::get();
        return view('frontend.about', compact('data_about', 'data_lab', 'data_kelompok', 'data_kaprodi'));
    }

    public function visiMisi()
    {
        $dataVisiMisi = VisiMisi::first();
        $data_kelompok = KelompokKeahlian::orderBy('nama_kelompok', 'ASC')->get();
        $data_lab = Lab::get();

        return view('frontend.visi-misi', compact('dataVisiMisi', 'data_lab', 'data_kelompok'));
    }

    public function dosen()
    {
        $data_kelompok = KelompokKeahlian::orderBy('nama_kelompok', 'ASC')->get();
        $data_lab = Lab::get();
        // $data_dosen = User::with('detail_dosen')->where('type', '=', 'dosen')->get();
        $data_dosen = DetailUserDosen::select(
            'detail_user_dosen.id',
            'detail_user_dosen.link', 
            'kelompok_keahlian.nama_kelompok',
            'users.name',
            'users.profile_photo_path'
        )->leftJoin('kelompok_keahlian', 'kelompok_keahlian.id', 'detail_user_dosen.kelompok_keahlian_id')
         ->leftJoin('users', 'users.id', 'detail_user_dosen.user_id')
         ->where('users.type', '=', 'dosen')
         ->orderBy('no_urut')
         ->get();
        // dd($data_dosen);

        return view('frontend.dosen', compact('data_dosen', 'data_lab', 'data_kelompok'));
    }

    public function profilLulusan()
    {
        $data_kelompok = KelompokKeahlian::orderBy('nama_kelompok', 'ASC')->get();
        $data_lab = Lab::get();
        $profil2015 = ProfilLulusan::paginate(3);
        $profil2020 = ProfilLulusan::latest()->paginate(4);
        // dd($profil2015);

        return view('frontend.profil_lulusan', compact('data_lab', 'data_kelompok', 'profil2015', 'profil2020'));
    }

    public function mataKuliah()
    {
        $data_kelompok = KelompokKeahlian::orderBy('nama_kelompok', 'ASC')->get();
        $data_lab = Lab::get();
        $matkul1 = Matkul::where('semester', '=', 'Semester 1')->get();
        $matkul2 = Matkul::where('semester', '=', 'Semester 2')->get();
        $matkul3 = Matkul::where('semester', '=', 'Semester 3')->get();
        $matkul4 = Matkul::where('semester', '=', 'Semester 4')->get();
        $matkul5 = Matkul::where('semester', '=', 'Semester 5')->get();
        $matkul6 = Matkul::where('semester', '=', 'Semester 6')->get();
        $matkul7 = Matkul::where('semester', '=', 'Semester 7')->get();
        $matkul8 = Matkul::where('semester', '=', 'Semester 8')->get();

        return view('frontend.matkul', compact('data_kelompok', 'data_lab', 'matkul1', 'matkul2', 'matkul3', 'matkul4', 'matkul5', 'matkul6', 'matkul7', 'matkul8'));
    }

    public function kelompokKeahlian($id)
    {
        $data_kelompok = KelompokKeahlian::orderBy('nama_kelompok', 'ASC')->get();
        $data_lab = Lab::get();
        $data = KelompokKeahlian::find($id);
        $dosenAhli = DetailUserDosen::select(
            'detail_user_dosen.id',
            'detail_user_dosen.link',
            'users.name',
            'users.profile_photo_path'
        )->leftJoin('kelompok_keahlian', 'kelompok_keahlian.id', 'detail_user_dosen.kelompok_keahlian_id')
         ->leftJoin('users', 'users.id', 'detail_user_dosen.user_id')
         ->where('kelompok_keahlian_id', $id)
         ->orderBy('no_urut')
         ->get();

        //  dd($dosenAhli);

         return view('frontend.kelompok_keahlian', compact('data_kelompok', 'data_lab', 'data', 'dosenAhli'));
    }

    public function laboratorium($id)
    {
        $data_kelompok = KelompokKeahlian::orderBy('nama_kelompok', 'ASC')->get();
        $data_lab = Lab::get();
        $data = Lab::find($id);
        // dd($data);

        return view('frontend.laboratorium', compact('data_kelompok', 'data_lab', 'data'));
    }
}
