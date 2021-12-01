<?php

namespace Ajifatur\FaturCMS\DummySeeder;

use Illuminate\Database\Seeder;
use Ajifatur\FaturCMS\Models\Permission;
use Ajifatur\FaturCMS\Models\RolePermission;

class DummyRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            // Role
            ['permission' => 'RoleController::index', 'role' => role('it'), 'access' => 1],
            ['permission' => 'RoleController::edit', 'role' => role('it'), 'access' => 1],

            // Role Permission
            ['permission' => 'RolePermissionController::index', 'role' => role('it'), 'access' => 1],
            ['permission' => 'PermissionController::create', 'role' => role('it'), 'access' => 1],
            ['permission' => 'PermissionController::edit', 'role' => role('it'), 'access' => 1],
            ['permission' => 'PermissionController::delete', 'role' => role('it'), 'access' => 1],

            // Package
            ['permission' => 'PackageController::index', 'role' => role('it'), 'access' => 1],
            ['permission' => 'PackageController::detail', 'role' => role('it'), 'access' => 1],
            ['permission' => 'PackageController::me', 'role' => role('it'), 'access' => 1],
            ['permission' => 'PackageController::updateMe', 'role' => role('it'), 'access' => 1],

            // Artisan
            ['permission' => 'ArtisanController::index', 'role' => role('it'), 'access' => 1],

            // Pengaturan
            ['permission' => 'SettingController::index', 'role' => role('it'), 'access' => 1],
            ['permission' => 'SettingController::edit', 'role' => role('it'), 'access' => 1],

            // User
            ['permission' => 'UserController::index', 'role' => role('it'), 'access' => 1],
            ['permission' => 'UserController::create', 'role' => role('it'), 'access' => 1],
            ['permission' => 'UserController::detail',  'role' => role('it'), 'access' => 1],
            ['permission' => 'UserController::edit', 'role' => role('it'), 'access' => 1],
            ['permission' => 'UserController::delete', 'role' => role('it'), 'access' => 1],
            ['permission' => 'UserController::refer', 'role' => role('it'), 'access' => 1],
            ['permission' => 'UserController::trainer', 'role' => role('it'), 'access' => 1],
            ['permission' => 'UserController::profile', 'role' => role('it'), 'access' => 1],
            ['permission' => 'UserController::editProfile', 'role' => role('it'), 'access' => 1],
            ['permission' => 'UserController::export', 'role' => role('it'), 'access' => 1],
            ['permission' => 'UserController::profile', 'role' => role('trainer'), 'access' => 1],
            ['permission' => 'UserController::profile', 'role' => role('student'), 'access' => 1],
            ['permission' => 'UserController::editProfile', 'role' => role('trainer'), 'access' => 1],
            ['permission' => 'UserController::editProfile', 'role' => role('student'), 'access' => 1],

            // Kelompok User
            ['permission' => 'KelompokController::index', 'role' => role('it'), 'access' => 1],
            ['permission' => 'KelompokController::create', 'role' => role('it'), 'access' => 1],
            ['permission' => 'KelompokController::detail', 'role' => role('it'), 'access' => 1],
            ['permission' => 'KelompokController::edit', 'role' => role('it'), 'access' => 1],
            ['permission' => 'KelompokController::delete', 'role' => role('it'), 'access' => 1],

            // Statistik
            ['permission' => 'StatistikController::member', 'role' => role('it'), 'access' => 1],
            ['permission' => 'StatistikController::device', 'role' => role('it'), 'access' => 1],
            ['permission' => 'StatistikController::location', 'role' => role('it'), 'access' => 1],
            ['permission' => 'StatistikController::byTanggal', 'role' => role('it'), 'access' => 1],
            ['permission' => 'StatistikController::byKelompok', 'role' => role('it'), 'access' => 1],

            // Rekening
            ['permission' => 'RekeningController::index', 'role' => role('it'), 'access' => 1],
            ['permission' => 'RekeningController::create', 'role' => role('it'), 'access' => 1],
            ['permission' => 'RekeningController::edit', 'role' => role('it'), 'access' => 1],
            ['permission' => 'RekeningController::delete', 'role' => role('it'), 'access' => 1],
            ['permission' => 'RekeningController::index', 'role' => role('trainer'), 'access' => 1],
            ['permission' => 'RekeningController::create', 'role' => role('trainer'), 'access' => 1],
            ['permission' => 'RekeningController::edit', 'role' => role('trainer'), 'access' => 1],
            ['permission' => 'RekeningController::delete', 'role' => role('trainer'), 'access' => 1],
            ['permission' => 'RekeningController::index', 'role' => role('student'), 'access' => 1],
            ['permission' => 'RekeningController::create', 'role' => role('student'), 'access' => 1],
            ['permission' => 'RekeningController::edit', 'role' => role('student'), 'access' => 1],
            ['permission' => 'RekeningController::delete', 'role' => role('student'), 'access' => 1],

            // Default Rekening
            ['permission' => 'DefaultRekeningController::index', 'role' => role('it'), 'access' => 1],
            ['permission' => 'DefaultRekeningController::create', 'role' => role('it'), 'access' => 1],
            ['permission' => 'DefaultRekeningController::edit', 'role' => role('it'), 'access' => 1],
            ['permission' => 'DefaultRekeningController::delete', 'role' => role('it'), 'access' => 1],

            // Transaksi
            ['permission' => 'KomisiController::index', 'role' => role('it'), 'access' => 1],
            ['permission' => 'WithdrawalController::index', 'role' => role('it'), 'access' => 1],
            ['permission' => 'PelatihanController::transaction', 'role' => role('it'), 'access' => 1],
            ['permission' => 'KomisiController::index', 'role' => role('trainer'), 'access' => 1],
            ['permission' => 'WithdrawalController::index', 'role' => role('trainer'), 'access' => 1],
            ['permission' => 'PelatihanController::transaction', 'role' => role('trainer'), 'access' => 1],
            ['permission' => 'KomisiController::index', 'role' => role('student'), 'access' => 1],
            ['permission' => 'WithdrawalController::index', 'role' => role('student'), 'access' => 1],
            ['permission' => 'PelatihanController::transaction', 'role' => role('student'), 'access' => 1],

            // Email
            ['permission' => 'EmailController::index', 'role' => role('it'), 'access' => 1],
            ['permission' => 'EmailController::create', 'role' => role('it'), 'access' => 1],
            ['permission' => 'EmailController::detail', 'role' => role('it'), 'access' => 1],
            ['permission' => 'EmailController::delete', 'role' => role('it'), 'access' => 1],

            // File Manager
            ['permission' => 'FileController::index', 'role' => role('it'), 'access' => 1],
            ['permission' => 'FileController::create', 'role' => role('it'), 'access' => 1],
            ['permission' => 'FileController::detail', 'role' => role('it'), 'access' => 1],
            ['permission' => 'FileController::edit', 'role' => role('it'), 'access' => 1],
            ['permission' => 'FileController::delete', 'role' => role('it'), 'access' => 1],
            ['permission' => 'FolderController::create', 'role' => role('it'), 'access' => 1],
            ['permission' => 'FolderController::edit', 'role' => role('it'), 'access' => 1],
            ['permission' => 'FolderController::delete', 'role' => role('it'), 'access' => 1],
            ['permission' => 'FolderKategoriController::index', 'role' => role('it'), 'access' => 1],
            ['permission' => 'FolderKategoriController::create', 'role' => role('it'), 'access' => 1],
            ['permission' => 'FolderKategoriController::edit', 'role' => role('it'), 'access' => 1],
            ['permission' => 'FolderKategoriController::delete', 'role' => role('it'), 'access' => 1],
            ['permission' => 'FileController::index', 'role' => role('trainer'), 'access' => 1],
            ['permission' => 'FileController::detail', 'role' => role('trainer'), 'access' => 1],
            ['permission' => 'FileController::index', 'role' => role('student'), 'access' => 1],
            ['permission' => 'FileController::detail', 'role' => role('student'), 'access' => 1],

            // Halaman
            ['permission' => 'HalamanController::index', 'role' => role('it'), 'access' => 1],
            ['permission' => 'HalamanController::create', 'role' => role('it'), 'access' => 1],
            ['permission' => 'HalamanController::edit', 'role' => role('it'), 'access' => 1],
            ['permission' => 'HalamanController::delete', 'role' => role('it'), 'access' => 1],

            // Artikel
            ['permission' => 'BlogController::index', 'role' => role('it'), 'access' => 1],
            ['permission' => 'BlogController::create', 'role' => role('it'), 'access' => 1],
            ['permission' => 'BlogController::edit', 'role' => role('it'), 'access' => 1],
            ['permission' => 'BlogController::delete', 'role' => role('it'), 'access' => 1],

            // Kategori Artikel
            ['permission' => 'KategoriArtikelController::index', 'role' => role('it'), 'access' => 1],
            ['permission' => 'KategoriArtikelController::create', 'role' => role('it'), 'access' => 1],
            ['permission' => 'KategoriArtikelController::edit', 'role' => role('it'), 'access' => 1],
            ['permission' => 'KategoriArtikelController::delete', 'role' => role('it'), 'access' => 1],

            // Tag Artikel
            ['permission' => 'TagController::index', 'role' => role('it'), 'access' => 1],
            ['permission' => 'TagController::create', 'role' => role('it'), 'access' => 1],
            ['permission' => 'TagController::edit', 'role' => role('it'), 'access' => 1],
            ['permission' => 'TagController::delete', 'role' => role('it'), 'access' => 1],

            // Kontributor Artikel
            ['permission' => 'KontributorController::index', 'role' => role('it'), 'access' => 1],
            ['permission' => 'KontributorController::create', 'role' => role('it'), 'access' => 1],
            ['permission' => 'KontributorController::edit', 'role' => role('it'), 'access' => 1],
            ['permission' => 'KontributorController::delete', 'role' => role('it'), 'access' => 1],

            // Pelatihan
            ['permission' => 'PelatihanController::index', 'role' => role('it'), 'access' => 1],
            ['permission' => 'PelatihanController::create', 'role' => role('it'), 'access' => 1],
            ['permission' => 'PelatihanController::detail', 'role' => role('it'), 'access' => 1],
            ['permission' => 'PelatihanController::edit', 'role' => role('it'), 'access' => 1],
            ['permission' => 'PelatihanController::delete', 'role' => role('it'), 'access' => 1],
            ['permission' => 'PelatihanController::participant', 'role' => role('it'), 'access' => 1],
            ['permission' => 'PelatihanController::trainer', 'role' => role('it'), 'access' => 1],
            ['permission' => 'PelatihanController::index', 'role' => role('trainer'), 'access' => 1],
            ['permission' => 'PelatihanController::detail', 'role' => role('trainer'), 'access' => 1],
            ['permission' => 'PelatihanController::participant', 'role' => role('trainer'), 'access' => 1],
            ['permission' => 'PelatihanController::trainer', 'role' => role('trainer'), 'access' => 1],
            ['permission' => 'PelatihanController::index', 'role' => role('student'), 'access' => 1],
            ['permission' => 'PelatihanController::detail', 'role' => role('student'), 'access' => 1],

            // Kategori Pelatihan
            ['permission' => 'KategoriPelatihanController::index', 'role' => role('it'), 'access' => 1],
            ['permission' => 'KategoriPelatihanController::create', 'role' => role('it'), 'access' => 1],
            ['permission' => 'KategoriPelatihanController::edit', 'role' => role('it'), 'access' => 1],
            ['permission' => 'KategoriPelatihanController::delete', 'role' => role('it'), 'access' => 1],

            // Pop-Up
            ['permission' => 'PopupController::index', 'role' => role('it'), 'access' => 1],
            ['permission' => 'PopupController::create', 'role' => role('it'), 'access' => 1],
            ['permission' => 'PopupController::detail', 'role' => role('it'), 'access' => 1],
            ['permission' => 'PopupController::edit', 'role' => role('it'), 'access' => 1],
            ['permission' => 'PopupController::delete', 'role' => role('it'), 'access' => 1],

            // Deskripsi
            ['permission' => 'DeskripsiController::index', 'role' => role('it'), 'access' => 1],

            // E-Sertifikat
            ['permission' => 'SertifikatController::indexTrainer', 'role' => role('it'), 'access' => 1],
            ['permission' => 'SertifikatController::indexParticipant', 'role' => role('it'), 'access' => 1],
            ['permission' => 'SertifikatController::detailTrainer', 'role' => role('it'), 'access' => 1],
            ['permission' => 'SertifikatController::detailParticipant', 'role' => role('it'), 'access' => 1],
            ['permission' => 'SertifikatController::indexTrainer', 'role' => role('trainer'), 'access' => 1],
            ['permission' => 'SertifikatController::indexParticipant', 'role' => role('trainer'), 'access' => 1],
            ['permission' => 'SertifikatController::detailTrainer', 'role' => role('trainer'), 'access' => 1],
            ['permission' => 'SertifikatController::detailParticipant', 'role' => role('trainer'), 'access' => 1],
            ['permission' => 'SertifikatController::indexTrainer', 'role' => role('student'), 'access' => 1],
            ['permission' => 'SertifikatController::indexParticipant', 'role' => role('student'), 'access' => 1],
            ['permission' => 'SertifikatController::detailTrainer', 'role' => role('student'), 'access' => 1],
            ['permission' => 'SertifikatController::detailParticipant', 'role' => role('student'), 'access' => 1],

            // Tandatangan Digital
            ['permission' => 'SignatureController::index', 'role' => role('it'), 'access' => 1],
            ['permission' => 'SignatureController::input', 'role' => role('it'), 'access' => 1],
            ['permission' => 'SignatureController::input', 'role' => role('manager'), 'access' => 1],
            ['permission' => 'SignatureController::input', 'role' => role('trainer'), 'access' => 1],
            ['permission' => 'SignatureController::delete', 'role' => role('it'), 'access' => 1],
        ];

        foreach($array as $key=>$data){
            // Get permission
            $permission = Permission::where('key_permission','=',$data['permission'])->first();

            // Get role permission or create
            if($permission){
                RolePermission::firstOrCreate(['id_permission' => $permission->id_permission, 'id_role' => $data['role'], ['access' => $data['access']]]);
            }
        }
    }
}
