<?php

namespace App\Http\Livewire;

use App\Models\Pesanan;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class DataPesanan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    use WithFileUploads;

    public $search = '';
    public $perPage = 10;

    protected $updatesQueryString = ['search'];
    protected $pesanans;

    public $detail_pesanan_id, $total_harga, $tanggal_konfirmasi, $catatan_pegawai;
    public $nama_lengkap, $asal_instansi, $no_telp, $email, $alamat, $foto_pelanggan, $user_id;
    public $nama_barang, $harga;
    public $jumlah, $harga_pesanan, $catatan_pelanggan;

    public function render()
    {
        $this->pesanans = Pesanan::join('detail_pesanans', 'detail_pesanans.id', '=', 'pesanans.detail_pesanan_id')
            ->join('barangs', 'barangs.id', '=', 'detail_pesanans.barang_id')
            ->join('users', 'users.id', '=', 'detail_pesanans.user_id')
            ->join('pelanggans', 'pelanggans.user_id', '=', 'users.id')
            ->select('pesanans.*', 'detail_pesanans.jumlah', 'detail_pesanans.created_at as createdat', 'detail_pesanans.harga as harga_pesanan', 'detail_pesanans.user_id', 'barangs.nama_barang', 'barangs.harga', 'pelanggans.nama_lengkap', 'pelanggans.asal_instansi', 'pelanggans.no_telp', 'pelanggans.email', 'pelanggans.alamat', 'pelanggans.foto_pelanggan')
            ->where('pelanggans.nama_lengkap', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'asc')
            ->paginate($this->perPage);

        // \dd($this->pesanans);
        return view('livewire.data-pesanan', [
            'pesanans' => $this->pesanans,
        ])->extends('layouts.template');
    }

    public function detail($id)
    {
        $this->detail_pesanan_id = $id;
        $pesanan = Pesanan::find($id);
        $this->total_harga = $pesanan->total_harga;
        $this->tanggal_konfirmasi = $pesanan->tanggal_konfirmasi;
        $this->catatan_pegawai = $pesanan->catatan_pegawai;
        $this->user_id = $pesanan->user_id;
        $this->catatan_pelanggan = $pesanan->catatan_pelanggan;
    }
}
