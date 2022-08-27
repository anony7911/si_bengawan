<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pelanggan;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class DataPelanggan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    use WithFileUploads;

    public $search = '';
    public $perPage = 10;

    protected $updatesQueryString = ['search'];
    protected $pelanggans;

    public $nama_lengkap, $asal_instansi, $no_telp, $email, $alamat, $foto_pelanggan, $user_id;

    public function resetInput()
    {
        $this->nama_lengkap = '';
        $this->asal_instansi = '';
        $this->no_telp = '';
        $this->email = '';
        $this->alamat = '';
        $this->foto_pelanggan = '';
        $this->user_id = '';
    }
    public function render()
    {
        $this->pelanggans = Pelanggan::where('nama_lengkap', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);
        return view('livewire.data-pelanggan', [
            'pelanggans' => $this->pelanggans,
        ])->extends('layouts.template');
    }

    public function detail($id){
        $this->pelangganId = $id;
        $pelanggan = Pelanggan::find($id);
        $this->nama_lengkap = $pelanggan->nama_lengkap;
        $this->asal_instansi = $pelanggan->asal_instansi;
        $this->no_telp = $pelanggan->no_telp;
        $this->email = $pelanggan->email;
        $this->alamat = $pelanggan->alamat;
        $this->foto_pelanggan = $pelanggan->foto_pelanggan;
        $this->user_id = $pelanggan->user_id;
    }

    public function delete($id)
    {
        $pelanggan = Pelanggan::find($id);
        $pelanggan->delete();
        session()->flash('message', 'Data berhasil dihapus');
        return redirect()->back();
    }
}
