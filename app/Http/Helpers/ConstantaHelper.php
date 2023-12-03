<?php

namespace App\Http\Helpers;

class ConstantaHelper
{
    const DataId = 'Data berdasarkan id ditemukan';
    const DataDiambil = 'Data berhasil diambil';
    const IdTidakDitemukan = 'Data id yang dicari tidak ditemukan';
    const TidakDitemukan = 'Data ini tidak ditemukan';
    const DataTersimpan = 'Berhasil menambahkan data baru';
    const DataTidakTersimpan = 'Kesalahan data, tidak dapat disimpan.';
    const DataDiperbaharui = 'Berhasil memperbaharui data';
    const DataTerhapus = 'Berhasil menghapus data';
    const DataTelahTerhapus = 'Data yang dimiliki sudah dihapus, ditemukan';

    const DataBerelasi = "Data ini telah berelasi, tidak dapat dihapus.";
    const ValidationError = 'Terjadi kesalahan validasi';
}
