<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\validasilogin;
use App\Http\Requests\validasiregister;
use App\Http\Requests\validasitambahdata;
use App\Http\Requests;
use Auth;
use Input;
use DB;
use View;
use Redirect;

class Crudcontroller extends Controller
{

	public function home()
	{
		return Redirect::to('/');
	}

	public function tambahlogin(validasiregister $data )
	{
		$user  = $data->username;
		$password = bcrypt($data->password);
		$hakakses;
		if ($user == 'admin')
		{
			$hakakses = 'admin';
		}
		else
		{
			$hakakses = 'user';
		}

		$data = array(
			'username' => $user,
			'password' => $password,
			'hak_akses' => $hakakses
			);
		DB::table('login')->insert($data);
		return Redirect::to('/login')->with('message','berhasil mendafatar');
	}

	public function login(validasilogin $validasi)
	{
		if (Auth::attempt(['username' => Input::get('username'),'password' => Input::get('password')]))
		{
			if(Auth::user()->hak_akses=="admin" )
			{
				return Redirect::to('');
			}
			else
			{
				return Redirect::to('user');
			}
		}
		else{
			echo "gagal login";
		}
	}

	public function logout()
	{
		Auth::logout();
		return Redirect::to('login')->with('message','Berhasil Logout');
	}

    public function tambahdata(validasitambahdata $data)
    {
    	$nama = $data->nama;
    	$alamat= $data->alamat;
    	$kelas= $data->kelas;
    	$data=array(
    		'nama' => $nama,
    		'alamat' => $alamat,
    		'kelas' => $kelas
    		);
    	DB::table('siswa')->insert($data);
    	return Redirect::to('/read')->with('message','Berhasil Menambah Data');
    	
    }

    public function lihatdata()
    {
    	$data = DB::table('siswa')->get();

    	return View::make('read')->with('siswa',$data);
    }

    public function hapusdata($id)
    {
    	DB::table('siswa')->where('id','=',$id)->delete();

    	return Redirect::to('/read')->with('message','berhasil menghapus data');
    }

    public function editdata($id)
    {
    	$data = DB::table('siswa')->where('id','=',$id)->first();

    	return View::make('form_edit')->with('siswa',$data);
    }

    public function proseseditdata()
    {
    	$data=array(
    		'nama' => Input::get('nama'),
    		'alamat' => Input::get('alamat'),
    		'kelas' => Input::get('kelas')
    		);
    	DB::table('siswa')->where('id','=',Input::get('id'))->update($data);
    	return Redirect::to('/read')->with('message','Berhasil Mengedit Data');
    }
}
