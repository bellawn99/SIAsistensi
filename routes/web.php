<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'LandingController@index')->name('index');
Route::post('/', 'LandingController@saveContact');
Route::get('/berita/{id}', 'LandingController@berita');
Route::post('/login', 'Auth\LoginController@login')->middleware('checkRole'); //CEKROLE MIDDLEWARE JIKA SUDAH LOGIN DI REDIRECT 
Auth::routes();
 Route::get('/config-cache', function() {
     $exitCode = Artisan::call('config:cache');
     return 'Config cache cleared';
 });
Route::get('/home', 'HomeController@index')->name('home')->middleware('checkRole');//CEKROLE MIDDLEWARE JIKA SUDAH LOGIN DI REDIRECT 

Route::group(['middleware' => ['auth','superadmin'], 'prefix'=> 'superadmin'], function() {
    Route::get('/dashboard', 'Superadmin\AdminController@home')->name('superadmin.dashboard');
    Route::get('/dashboard/stat', 'Superadmin\AdminController@get_data')->name('search.super');
    // Route::get('/dashboard/', 'Admin\AdminController@search')->name('search');
    
    
    Route::group(['prefix' => '/pengguna'],function(){
        Route::group(['prefix' => '/user-admin'],function(){
            Route::get('/', 'Superadmin\PenggunaAdminController@index')->name('superadmin.pengguna.admin');
            Route::post('/import','Superadmin\PenggunaAdminController@csv_import')->name('superadmin.import.pengguna.admin');
            Route::post('/', 'Superadmin\PenggunaAdminController@store')->name('superadmin.store.pengguna.admin');
            Route::post('/reset', 'Superadmin\PenggunaAdminController@reset')->name('superadmin.reset.admin');
            Route::delete('/delete/{id}', 'Superadmin\PenggunaAdminController@delete');
        });

        Route::group(['prefix' => '/user-mahasiswa'],function(){
            Route::get('/', 'Superadmin\PenggunaMahasiswaController@index')->name('superadmin.pengguna.mhs');
            Route::get('/detail/{id}', 'Superadmin\PenggunaMahasiswaController@show')->name('superadmin.pengguna.detail');
            Route::post('/import','Superadmin\PenggunaMahasiswaController@csv_import')->name('superadmin.import.pengguna.mhs');
            Route::post('/', 'Superadmin\PenggunaMahasiswaController@store')->name('superadmin.store.pengguna.mhs');
            Route::post('/reset', 'Superadmin\PenggunaMahasiswaController@reset')->name('superadmin.reset.mahasiswa');
            Route::delete('/delete/{id}', 'Superadmin\PenggunaMahasiswaController@delete');
        });

    });

    Route::group(['prefix' => '/master'],function(){

        //master dosen
        Route::group(['prefix' => '/dosen'],function(){
            Route::get('/', 'Superadmin\DataDosenController@index')->name('superadmin.master.dosen');
            Route::post('/', 'Superadmin\DataDosenController@store')->name('superadmin.store.dosen');
            Route::get('/edit/{id}', 'Superadmin\DataDosenController@edit')->name('superadmin.master.editDosen');
            Route::put('/update/{id}', 'Superadmin\DataDosenController@update');
            Route::delete('/delete/{id}', 'Superadmin\DataDosenController@delete');
            Route::post('/import','Superadmin\DataDosenController@csv_import')->name('superadmin.import.dosen');
        });

        //master matkul
        Route::group(['prefix' => '/matkul'],function(){
            Route::get('/', 'Superadmin\DataMatkulController@index')->name('superadmin.master.matkul');
            Route::get('/edit/{id}', 'Superadmin\DataMatkulController@edit')->name('superadmin.master.editMatkul');
            Route::put('/update/{id}', 'Superadmin\DataMatkulController@update');
            Route::post('/', 'Superadmin\DataMatkulController@store')->name('superadmin.store.matkul');
            Route::delete('/delete/{id}', 'Superadmin\DataMatkulController@delete');
            Route::post('/import','Superadmin\DataMatkulController@csv_import')->name('superadmin.import.matkul');
        });

        //master ruangan
        Route::group(['prefix' => '/ruangan'],function(){
            Route::get('/', 'Superadmin\DataRuanganController@index')->name('superadmin.master.ruangan');
            Route::get('/edit/{id}', 'Superadmin\DataRuanganController@edit')->name('superadmin.master.editRuangan');
            Route::put('/update/{id}', 'Superadmin\DataRuanganController@update');
            Route::post('/', 'Superadmin\DataRuanganController@store')->name('superadmin.store.ruangan');
            Route::delete('/delete/{id}', 'Superadmin\DataRuanganController@delete');
            Route::post('/import','Superadmin\DataRuanganController@csv_import')->name('superadmin.import.ruangan');
        });

        //master jadwal
        Route::group(['prefix' => '/jadwal'],function(){
            Route::get('/', 'Superadmin\DataJadwalController@index')->name('superadmin.master.jadwal');
            Route::get('/edit/{id}', 'Superadmin\DataJadwalController@edit')->name('superadmin.master.editJadwal');
            Route::put('/update/{id}', 'Superadmin\DataJadwalController@update');
            Route::post('/', 'Superadmin\DataJadwalController@store')->name('superadmin.store.jadwal');
            Route::delete('/delete/{id}', 'Superadmin\DataJadwalController@delete');
            Route::post('/import','Superadmin\DataJadwalController@csv_import')->name('superadmin.import.jadwal');
        });

        //master kelas
        Route::group(['prefix' => '/kelas'],function(){
            Route::get('/', 'Superadmin\DataKelasController@index')->name('superadmin.master.kelas');
            Route::get('/edit/{id}', 'Superadmin\DataKelasController@edit')->name('superadmin.master.editKelas');
            Route::put('/update/{id}', 'Superadmin\DataKelasController@update');
            Route::post('/', 'Superadmin\DataKelasController@store')->name('superadmin.store.kelas');
            Route::delete('/delete/{id}', 'Superadmin\DataKelasController@delete');
            Route::post('/import','Superadmin\DataKelasController@csv_import')->name('superadmin.import.kelas');
        });
    });
    //praktikum
    Route::group(['prefix' => '/praktikum'],function(){
        Route::get('/', 'Superadmin\DataPraktikumController@index')->name('superadmin.praktikum');
        Route::get('/edit/{id}', 'Superadmin\DataPraktikumController@edit')->name('superadmin.edit.praktikum');
            Route::put('/update/{id}', 'Superadmin\DataPraktikumController@update');
            Route::post('/', 'Superadmin\DataPraktikumController@store')->name('superadmin.store.praktikum');
            Route::delete('/delete/{id}', 'Superadmin\DataPraktikumController@delete');
    });
    //periode
    Route::group(['prefix' => '/periode'],function(){
        Route::get('/', 'Superadmin\DataPeriodeController@index')->name('superadmin.periode');
        Route::get('/edit/{id}', 'Superadmin\DataPeriodeController@edit')->name('superadmin.edit.periode');
        Route::put('/update/{id}', 'Superadmin\DataPeriodeController@update');
        Route::post('/', 'Superadmin\DataPeriodeController@store')->name('superadmin.store.periode');
        Route::delete('/delete/{id}', 'Superadmin\DataPeriodeController@delete');
    });

    //ketentuan
    Route::group(['prefix' => '/ketentuan'],function(){
        Route::get('/', 'Superadmin\DataKetentuanController@index')->name('superadmin.ketentuan');
        Route::get('/edit/{id}', 'Superadmin\DataKetentuanController@edit')->name('superadmin.edit.ketentuan');
        Route::put('/update/{id}', 'Superadmin\DataKetentuanController@update');
        Route::post('/', 'Superadmin\DataKetentuanController@store')->name('superadmin.store.ketentuan');
        Route::delete('/delete/{id}', 'Superadmin\DataKetentuanController@delete');
    });

    //berita
    Route::group(['prefix' => '/berita'],function(){
        Route::get('/', 'Superadmin\DataBeritaController@index')->name('superadmin.berita');
        Route::post('/', 'Superadmin\DataBeritaController@store')->name('superadmin.store.berita');
        Route::get('/edit/{id}', 'Superadmin\DataBeritaController@edit')->name('superadmin.edit.berita');
        Route::put('/update/{id}', 'Superadmin\DataBeritaController@update');
        Route::delete('/delete/{id}', 'Superadmin\DataBeritaController@delete');
    });

    //ubah-password
    Route::group(['prefix' => 'ubah-password'],function(){
        Route::get('/', 'Superadmin\UbahPasswordController@index')->name('superadmin.ubahPass');
        Route::put('/', 'Superadmin\UbahPasswordController@changePassword')->name('superadmin.changePasswordAdmin');
    });

    //profil
    Route::group(['prefix' => 'profil'],function(){
        Route::get('/', 'Superadmin\ProfilController@index')->name('superadmin.profil');
        Route::get('/edit-foto/{id}', 'Superadmin\ProfilController@editFoto')->name('superadmin.edit.fotoAdmin');;
        Route::put('/update-foto/{id}', 'Superadmin\ProfilController@updateFoto');
        Route::get('/edit-data/{id}', 'Superadmin\ProfilController@editData');
        Route::put('/update-data/{id}', 'Superadmin\ProfilController@updateData');        
    });

    //pengajuan
    Route::group(['prefix' => 'pengajuan'],function(){
        Route::get('/', 'Superadmin\PengajuanController@index')->name('superadmin.pengajuan');
        Route::get('/{id}', ['as' => 'pengajuans.status', 'uses' => 'Superadmin\PengajuanController@editStat']);
        Route::post('/update', ['as' => 'pengajuans.change', 'uses' => 'Superadmin\PengajuanController@statusUpdate']);
    });

    //asistensi
    Route::group(['prefix' => 'asistensi'],function(){
        Route::get('/', 'Superadmin\AsistensiController@index')->name('superadmin.asistensi');
        Route::get('/{id}','Superadmin\AsistensiController@matkulAjax');
    });
});

Route::group(['middleware' => ['auth','admin'], 'prefix'=> 'admin'], function() {
    Route::get('/dashboard', 'Admin\AdminController@home')->name('admin.dashboard');
    Route::get('/dashboard/stat', 'Admin\AdminController@get_data')->name('search');
    // Route::get('/dashboard/', 'Admin\AdminController@search')->name('search');
    
    
    Route::group(['prefix' => '/pengguna'],function(){
            Route::get('/', 'Admin\PenggunaMahasiswaController@index')->name('pengguna.mhs');
            Route::get('/detail/{id}', 'Admin\PenggunaMahasiswaController@show')->name('pengguna.detail');
            Route::post('/import','Admin\PenggunaMahasiswaController@csv_import')->name('import.pengguna.mhs');
            Route::post('/', 'Admin\PenggunaMahasiswaController@store')->name('store.pengguna.mhs');
            Route::post('/reset', 'Admin\PenggunaMahasiswaController@reset')->name('reset.mahasiswa');
            Route::delete('/delete/{id}', 'Admin\PenggunaMahasiswaController@delete');
    });

    Route::group(['prefix' => '/master'],function(){

        //master dosen
        Route::group(['prefix' => '/dosen'],function(){
            Route::get('/', 'Admin\DataDosenController@index')->name('master.dosen');
            Route::post('/', 'Admin\DataDosenController@store')->name('store.dosen');
            Route::get('/edit/{id}', 'Admin\DataDosenController@edit')->name('master.editDosen');
            Route::put('/update/{id}', 'Admin\DataDosenController@update');
            Route::delete('/delete/{id}', 'Admin\DataDosenController@delete');
            Route::post('/import','Admin\DataDosenController@csv_import')->name('import.dosen');
        });

        //master matkul
        Route::group(['prefix' => '/matkul'],function(){
            Route::get('/', 'Admin\DataMatkulController@index')->name('master.matkul');
            Route::get('/edit/{id}', 'Admin\DataMatkulController@edit')->name('master.editMatkul');
            Route::put('/update/{id}', 'Admin\DataMatkulController@update');
            Route::post('/', 'Admin\DataMatkulController@store')->name('store.matkul');
            Route::delete('/delete/{id}', 'Admin\DataMatkulController@delete');
            Route::post('/import','Admin\DataMatkulController@csv_import')->name('import.matkul');
        });

        //master ruangan
        Route::group(['prefix' => '/ruangan'],function(){
            Route::get('/', 'Admin\DataRuanganController@index')->name('master.ruangan');
            Route::get('/edit/{id}', 'Admin\DataRuanganController@edit')->name('master.editRuangan');
            Route::put('/update/{id}', 'Admin\DataRuanganController@update');
            Route::post('/', 'Admin\DataRuanganController@store')->name('store.ruangan');
            Route::delete('/delete/{id}', 'Admin\DataRuanganController@delete');
            Route::post('/import','Admin\DataRuanganController@csv_import')->name('import.ruangan');
        });

        //master jadwal
        Route::group(['prefix' => '/jadwal'],function(){
            Route::get('/', 'Admin\DataJadwalController@index')->name('master.jadwal');
            Route::get('/edit/{id}', 'Admin\DataJadwalController@edit')->name('master.editJadwal');
            Route::put('/update/{id}', 'Admin\DataJadwalController@update');
            Route::post('/', 'Admin\DataJadwalController@store')->name('store.jadwal');
            Route::delete('/delete/{id}', 'Admin\DataJadwalController@delete');
            Route::post('/import','Admin\DataJadwalController@csv_import')->name('import.jadwal');
        });

        //master kelas
        Route::group(['prefix' => '/kelas'],function(){
            Route::get('/', 'Admin\DataKelasController@index')->name('master.kelas');
            Route::get('/edit/{id}', 'Admin\DataKelasController@edit')->name('master.editKelas');
            Route::put('/update/{id}', 'Admin\DataKelasController@update');
            Route::post('/', 'Admin\DataKelasController@store')->name('store.kelas');
            Route::delete('/delete/{id}', 'Admin\DataKelasController@delete');
            Route::post('/import','Admin\DataKelasController@csv_import')->name('import.kelas');
        });
    });
    //praktikum
    Route::group(['prefix' => '/praktikum'],function(){
        Route::get('/', 'Admin\DataPraktikumController@index')->name('praktikum');
        Route::get('/edit/{id}', 'Admin\DataPraktikumController@edit')->name('edit.praktikum');
            Route::put('/update/{id}', 'Admin\DataPraktikumController@update');
            Route::post('/', 'Admin\DataPraktikumController@store')->name('store.praktikum');
            Route::delete('/delete/{id}', 'Admin\DataPraktikumController@delete');
    });
    //periode
    Route::group(['prefix' => '/periode'],function(){
        Route::get('/', 'Admin\DataPeriodeController@index')->name('periode');
        Route::get('/edit/{id}', 'Admin\DataPeriodeController@edit')->name('edit.periode');
        Route::put('/update/{id}', 'Admin\DataPeriodeController@update');
        Route::post('/', 'Admin\DataPeriodeController@store')->name('store.periode');
        Route::delete('/delete/{id}', 'Admin\DataPeriodeController@delete');
    });

    //ketentuan
    Route::group(['prefix' => '/ketentuan'],function(){
        Route::get('/', 'Admin\DataKetentuanController@index')->name('ketentuan');
        Route::get('/edit/{id}', 'Admin\DataKetentuanController@edit')->name('edit.ketentuan');
        Route::put('/update/{id}', 'Admin\DataKetentuanController@update');
        Route::post('/', 'Admin\DataKetentuanController@store')->name('store.ketentuan');
        Route::delete('/delete/{id}', 'Admin\DataKetentuanController@delete');
    });

    //berita
    Route::group(['prefix' => '/berita'],function(){
        Route::get('/', 'Admin\DataBeritaController@index')->name('berita');
        Route::post('/', 'Admin\DataBeritaController@store')->name('store.berita');
        Route::get('/edit/{id}', 'Admin\DataBeritaController@edit')->name('edit.berita');
        Route::put('/update/{id}', 'Admin\DataBeritaController@update');
        Route::delete('/delete/{id}', 'Admin\DataBeritaController@delete');
    });

    //ubah-password
    Route::group(['prefix' => 'ubah-password'],function(){
        Route::get('/', 'Admin\UbahPasswordController@index')->name('admin.ubahPass');
        Route::put('/', 'Admin\UbahPasswordController@changePassword')->name('changePasswordAdmin');
    });

    //profil
    Route::group(['prefix' => 'profil'],function(){
        Route::get('/', 'Admin\ProfilController@index')->name('admin.profil');
        Route::get('/edit-foto/{id}', 'Admin\ProfilController@editFoto')->name('edit.fotoAdmin');;
        Route::put('/update-foto/{id}', 'Admin\ProfilController@updateFoto');
        Route::get('/edit-data/{id}', 'Admin\ProfilController@editData');
        Route::put('/update-data/{id}', 'Admin\ProfilController@updateData');        
    });

    //pengajuan
    Route::group(['prefix' => 'pengajuan'],function(){
        Route::get('/', 'Admin\PengajuanController@index')->name('pengajuan');
        Route::get('/{id}', ['as' => 'pengajuans.status', 'uses' => 'Admin\PengajuanController@editStat']);
        Route::post('/update', ['as' => 'pengajuans.change', 'uses' => 'Admin\PengajuanController@statusUpdate']);
    });

    //asistensi
    Route::group(['prefix' => 'asistensi'],function(){
        Route::get('/', 'Admin\AsistensiController@index')->name('asistensi');
        Route::get('/{id}','Admin\AsistensiController@matkulAjax');
    });
});

Route::group(['middleware' => ['auth', 'mahasiswa'], 'prefix'=> 'mahasiswa'], function() {
    Route::get('/dashboard', 'Mahasiswa\MahasiswaController@index')->name('mahasiswa.beranda');
    //profil
    Route::group(['prefix' => 'profil'],function(){
        Route::get('/', 'Mahasiswa\ProfilController@index')->name('mhs.profil');
        Route::get('/edit-foto/{id}', 'Mahasiswa\ProfilController@editFoto')->name('edit.editFotoMhs');
        Route::put('/update-foto/{id}', 'Mahasiswa\ProfilController@updateFoto');
        Route::get('/edit-data/{id}', 'Mahasiswa\ProfilController@editData')->name('edit.data');
        Route::put('/update-data/{id}', 'Mahasiswa\ProfilController@updateData');
        Route::get('/edit-bank/{id}', 'Mahasiswa\ProfilController@editBank')->name('edit.bank');
        Route::put('/update-bank/{id}', 'Mahasiswa\ProfilController@updateBank');
        Route::get('/edit-mahasiswa/{id}', 'Mahasiswa\ProfilController@editMahasiswa')->name('edit.mahasiswa');
        Route::put('/update-mahasiswa/{id}', 'Mahasiswa\ProfilController@updateMahasiswa');
    });

    //ubah-password
    Route::group(['prefix' => 'ubah-password'],function(){
        Route::get('/', 'Mahasiswa\UbahPasswordController@index')->name('mhs.ubahPass');
        Route::put('/', 'Mahasiswa\UbahPasswordController@changePassword')->name('changePassword');
    });

    //daftar
    Route::group(['prefix' => 'daftar'],function(){
        Route::get('/', 'Mahasiswa\DaftarController@index')->name('daftar');
        Route::post('/', 'Mahasiswa\DaftarController@store')->name('store.daftar');
        Route::delete('/delete/{id}', 'Mahasiswa\DaftarController@delete');
    });

    //pengumuman
    Route::group(['prefix' => 'pengumuman'],function(){
        Route::get('/', 'Mahasiswa\PengumumanController@index')->name('pengumuman');
    });
});

