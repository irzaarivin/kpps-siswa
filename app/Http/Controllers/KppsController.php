<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kpps;
use App\Models\Document;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Middleware\VerifyCsrfToken;

class KppsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('main', [
            'catatan' => DB::table('notes')->where('nis', auth()->user()->nis)->latest()->get(),
            'dokumenPribadi' => DB::table('documents')->where('email', auth()->user()->email)->where('visibility', 'private')->latest()->get(),
            'dokumenPublik' => DB::table('documents')->where('email', auth()->user()->email)->where('visibility', 'public')->latest()->get(),
            'dataDiri' => DB::table('students')->where('id', auth()->user()->id)->get(),
            'pelanggaranSaya' => DB::table('violators')->where('nis', auth()->user()->nis)->join('violations', 'violators.pelanggaran', '=', 'violations.pelanggaran')->select('violators.pelanggaran', 'violations.poin', 'violators.created_at')->get(),
            'prestasiSaya' => DB::table('prestasi_siswas')->where('nis', auth()->user()->nis)->join('achievements', 'prestasi_siswas.prestasi', '=', 'achievements.prestasi')->select('prestasi_siswas.prestasi', 'achievements.poin', 'prestasi_siswas.created_at')->get(),
            'daftarPelanggaran' => DB::table('violations')->get(),
            'daftarPrestasi' => DB::table('achievements')->get(),
            'daftarGuru' => DB::table('users')->get()
        ]);
    }

    public function authenticate() {
        return view('auth');
    }

    public function login(Request $request) {

        $credentials = $request->validate([
            'nis' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect(env('APP_URL') . "/home")->with('masuk', 'Welcome back, ' . auth()->user()->nama);
        }
 
        /* return back()->withErrors([
            'email' => 'Email anda telah terdaftar.',
            'nis' => 'NIS anda telah terdaftar.',
            'password' => 'Password anda salah',
        ])->with('gagalLogin', 'Data tidak sesuai!!!'); */

        return redirect(env('APP_URL') . "/home")->with('gagalLogin', 'Data tidak sesuai!!!');

    }

    public function register(Request $request) {

        $validatedData = $request->validate([
            'nama' => 'required',
            'kelas' => 'required',
            'nis' => 'required|unique:students',
            'email' => 'required|unique:students',
            'password' => 'required',
            'jurusan' => 'required'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        // Student::create($validatedData);

        DB::table('students')->insert([
            'nama' => $validatedData['nama'],
            'kelas' => $validatedData['kelas'],
            'email' => $validatedData['email'],
            'nis' => $validatedData['nis'],
            'password' => $validatedData['password'],
            'jurusan' => $validatedData['jurusan'],
            'pelanggaran' => $request->pelanggaran,
            'prestasi' => $request->prestasi
        ]);

        return redirect()->back()->with('suksesDaftar', 'Silahkan login');

    }

    public function simpanDataDiri(Request $request) {

        /** DB::table('students')->where('nis', auth()->user()->nis)->update(
            ['nama' => $request->nama],
            ['kelas' => auth()->user()->kelas],
            ['jurusan' => auth()->user()->jurusan],
            ['email' => auth()->user()->email],
            ['nis' => auth()->user()->nis],
            ['alamat' => $request->alamat],
            ['telepon' => $request->telepon],
            ['password' => auth()->user()->password],
            ['pelanggaran' => auth()->user()->pelanggaran],
            ['prestasi' => auth()->user()->prestasi],
            ['ayah' => auth()->user()->ayah],
            ['ibu' => auth()->user()->ibu],
            ['alamatWali' => auth()->user()->alamatWali],
            ['teleponWali' => auth()->user()->teleponWali]
        ); **/

        DB::table('students')->where('nis', auth()->user()->nis)->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon
        ]);

        return redirect()->back()->with('dataDiri', 'Data kamu berhasil diubah!');
    }

    public function simpanDataWali(Request $request) {

        DB::table('students')->where('nis', auth()->user()->nis)->update([
            'ayah' => $request->ayah,
            'ibu' => $request->ibu,
            'alamatWali' => $request->alamatWali,
            'teleponWali' => $request->teleponWali
        ]);

        return redirect()->back()->with('dataWali', 'Data Wali berhasil diubah!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'file' => 'file|max:10480|required'
        ]);

        $folder = auth()->user()->email;
        $folder = explode('@', $folder);
        $folder = array_shift($folder);
        $folder = explode('.', $folder);
        $folder = array_shift($folder);

        $type = $request->file('file')->store($folder);
        $type = explode('/', $type);
        $type = end($type);
        $type = explode('.', $type);
        $type = end($type);

        if($type == "pdf") {
            $icon = '<i class="bi bi-file-pdf"></i>';
        } elseif($type == "docx") {
            $icon = '<i class="bi bi-filetype-docx"></i>';
        } elseif($type == "pptx") {
            $icon = '<i class="bi bi-filetype-pptx"></i>';
        } elseif($type == "xlsx") {
            $icon = '<i class="bi bi-filetype-xlsx"></i>';
        } elseif($type == "txt") {
            $icon = '<i class="bi bi-filetype-txt"></i>';
        } elseif($type == "jpg") {
            $icon = '<i class="bi bi-image"></i>';
        } elseif($type == "jpeg") {
            $icon = '<i class="bi bi-image"></i>';
        } elseif($type == "png") {
            $icon = '<i class="bi bi-image"></i>';
        } elseif($type == "webm") {
            $icon = '<i class="bi bi-image"></i>';
        } elseif($type == "svg") {
            $icon = '<i class="bi bi-image"></i>';
        } elseif($type == "mp4") {
            $icon = '<i class="bi bi-camera-video"></i>';
        } elseif($type == "mp3") {
            $icon = '<i class="bi bi-music-note-beamed"></i>';
        } elseif($type == "mov") {
            $icon = '<i class="bi bi-camera-video"></i>';
        } elseif($type == "mkv") {
            $icon = '<i class="bi bi-camera-video"></i>';
        } elseif($type == "wmv") {
            $icon = '<i class="bi bi-camera-video"></i>';
        } elseif($type == "zip") {
            $icon = '<i class="bi bi-file-earmark-zip"></i>';
        } elseif($type == "rar") {
            $icon = '<i class="bi bi-file-earmark-zip"></i>';
        } else {
            $icon = '<i class="bi bi-question-circle"></i>';
        }

        $validatedData['author'] = auth()->user()->nama;
        $validatedData['judul'] = $request->judul;
        $validatedData['link'] = $request->file('file')->store($folder);
        $validatedData['icon'] = $icon;
        $validatedData['type'] = $type;
        $validatedData['email'] = auth()->user()->email;
        $validatedData['visibility'] = $request->visibilitas;

        Document::create($validatedData);

        return redirect('/')->with('dokumen', 'Dokumen anda berhasil diunggah');

    }

    public function logout(Request $request) {

        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
