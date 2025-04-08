<?php

namespace App\Http\Controllers;

use App\Models\DetailUserDosen;
use App\Models\KelompokKeahlian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class DosenController extends Controller
{
    public function index()
    {
        $pageTitle = "Manage lectures";
        // $data = User::with('detail_dosen')->where('type', '=', 'dosen')->get();
        // dd($data);

        // Pass the fetched posts to the view
        return view('backend.dosen.index', compact('pageTitle'));
    }

    public function dataDosen()
    {
        $data = User::with('detail_dosen')->where('type', '=', 'dosen')->get();

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('photo', function ($data) {
                return '<img src="'. asset('media/dosen/'. $data->profile_photo_path). '" class="img-fluid rounded" width="80" alt="">';
            })
            ->addColumn('aksi', function ($data) {
                return '
                    <a href="'. route('dosen.edit', $data->id). '" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                    <a href="javascript:void(0)" data-id="' . $data->id . '" id="btn-delete-dosen" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                ';
            })
            ->rawColumns(['photo', 'aksi'])
            ->make(true);
    }

    public function create()
    {
        $pageTitle = "Add new lecture";
        $kel = KelompokKeahlian::orderBy('nama_kelompok', 'ASC')->get();
        
        return view('backend.dosen.create', compact('pageTitle', 'kel'));
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required',
            'nik' => 'required',
            'email' => 'required|email|unique:users',
            'kelompok_keahlian_id' =>'required',
            'fungsional' => 'required',
            'link' => 'required',
            'profile_photo_path' => 'required|image',
            'pendidikan' => 'required',
            'no_urut' => 'required'
        ]);

        // Upload profile photo
        $photo = $request->file('profile_photo_path');
        $photoName = time(). '_'. $photo->getClientOriginalName();
        $path = ('media/dosen');
        $photo->move($path, $photoName);

        // Store data in database
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->nik = $request->nik;
        $user->type = "dosen";
        $user->password = bcrypt($user->nik);
        $user->profile_photo_path = $photoName;
        $user->save();

        $detail_dosen = new DetailUserDosen();
        $detail_dosen->user_id = $user->id;
        $detail_dosen->pendidikan = $request->pendidikan;
        $detail_dosen->jabatan = $request->jabatan;
        $detail_dosen->kelompok_keahlian_id = $request->kelompok_keahlian_id;
        $detail_dosen->fungsional = $request->fungsional;
        $detail_dosen->link = $request->link;
        $detail_dosen->no_urut = $request->no_urut;
        $detail_dosen->save();

        Alert::success('Lecture successfully created!');
        return redirect()->route('dosen.index');

    }

    public function edit($id)
    {
        $pageTitle = "Edit Lecture";
        $data = User::with('detail_dosen')->find($id);
        $kel = KelompokKeahlian::orderBy('nama_kelompok', 'ASC')->get();

        return view('backend.dosen.edit', compact('pageTitle', 'data', 'kel'));
    }

    public function update(Request $request, $id)
    {
        $data = User::with('detail_dosen')->find($id);
        $detail_dosen = DetailUserDosen::where('user_id', $id)->first();
        // Validation
        $request->validate([
            'name' => 'required',
            'nik' => 'required',
            'email' => 'required|email|unique:users',
            'kelompok_keahlian_id' =>'required',
            'fungsional' => 'required',
            'link' => 'required',
            'profile_photo_path' => 'required|image',
            'pendidikan' => 'required',
            'no_urut' => 'required'
        ]);

        // Upload profile photo
        if ($request->hasFile('profile_photo_path')) {
            $photo = $request->file('profile_photo_path');
            if (!is_null($photo)) {
                File::delete(public_path('/media/dosen/' . $data->profile_photo_path));
                $photoName = time(). '_'. $photo->getClientOriginalName();
                $path = ('media/dosen');
                $photo->move($path, $photoName);
            }
        }

        // Update data in database
        $data->name = $request->name;
        $data->email = $request->email;
        $data->nik = $request->nik;
        $data->type = "dosen";
        $data->password = bcrypt($data->nik);
        $data->profile_photo_path = $photoName;
        $data->save();

        $detail_dosen->user_id = $data->id;
        $detail_dosen->pendidikan = $request->pendidikan;
        $detail_dosen->jabatan = $request->jabatan;
        $detail_dosen->kelompok_keahlian_id = $request->kelompok_keahlian_id;
        $detail_dosen->fungsional = $request->fungsional;
        $detail_dosen->link = $request->link;
        $detail_dosen->no_urut = $request->no_urut;
        $detail_dosen->save();

        Alert::success('Lecture successfully updated!');
        return redirect()->route('dosen.index');
    }

    public function destroy($id)
    {
        $data = User::find($id);
        File::delete(public_path('/media/dosen/'. $data->profile_photo_path));

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Lecture successfully deleted!'
        ]);
    }
}
