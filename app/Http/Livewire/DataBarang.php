<?php

namespace App\Http\Livewire;

use App\Models\Barang;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class DataBarang extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    use WithFileUploads;

    public $search = '';
    public $perPage = 10;

    public $nama_barang, $harga, $merk, $satuan, $deskripsi, $foto_barang, $foto_barang1, $status_barang, $barangId;

    protected $updatesQueryString = ['search'];

    protected $barangs;

    public function resetInput()
    {
        $this->nama_barang = '';
        $this->merk = '';
        $this->harga = '';
        $this->satuan = '';
        $this->deskripsi = '';
        $this->foto_barang = '';
        $this->status_barang = '';
    }

    public function render()
    {
        $this->barangs = Barang::where('nama_barang', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);
        return view('livewire.data-barang', [
            'barangs' => $this->barangs,
        ])->extends('layouts.template');
    }

    public function barangId($id)
    {
        $this->barangId = $id;

        $barang = Barang::find($id);
        $this->nama_barang = $barang->nama_barang;
        $this->merk = $barang->merk;
        $this->harga = $barang->harga;
        $this->satuan = $barang->satuan;
        $this->deskripsi = $barang->deskripsi;
        // $this->foto_barang = $barang->foto_barang;
        $this->status_barang = $barang->status_barang;
    }

    public function store()
    {
        $this->validate([
            'nama_barang' => 'required',
            'merk' => 'required',
            'harga' => 'required|numeric',
            'satuan' => 'required',
            'deskripsi' => 'required',
            'foto_barang' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $nama_foto = 'barang_' . time() . '.' . $this->foto_barang->extension();

        Barang::create([
            'nama_barang' => $this->nama_barang,
            'merk' => $this->merk,
            'harga' => $this->harga,
            'satuan' => $this->satuan,
            'deskripsi' => $this->deskripsi,
            'foto_barang' => $this->foto_barang->storeAs('foto_barang', $nama_foto),
        ]);

        $this->resetInput();
        session()->flash('success', 'Data berhasil ditambahkan');
    }

    public function nonaktifkan($id)
    {
        $barang = Barang::find($id)->update([
            'status_barang' => false,
        ]);
        session()->flash('error', 'Data berhasil dinonaktifkan');
    }

    public function aktifkan($id)
    {
        $barang = Barang::find($id)->update([
            'status_barang' => true,
        ]);
        session()->flash('success', 'Data berhasil diaktifkan');
    }

    public function delete($id)
    {
        $barang = Barang::find($id)->delete();
        session()->flash('error', 'Data berhasil dihapus');
    }

    public function update()
    {
        $this->validate([
            'nama_barang' => 'required',
            'merk' => 'required',
            'harga' => 'required|numeric',
            'satuan' => 'required',
            'deskripsi' => 'required',
        ]);
        $barang = Barang::find($this->barangId);
        if ($this->foto_barang != '') {
            $nama_foto = 'barang_' . time() . '.' . $this->foto_barang->extension();
            $barang->update([
                'nama_barang' => $this->nama_barang,
                'merk' => $this->merk,
                'harga' => $this->harga,
                'satuan' => $this->satuan,
                'deskripsi' => $this->deskripsi,
                'foto_barang' => $this->foto_barang->storeAs('foto_barang', $nama_foto),
            ]);
        } else {
            $barang->update([
                'nama_barang' => $this->nama_barang,
                'merk' => $this->merk,
                'harga' => $this->harga,
                'satuan' => $this->satuan,
                'deskripsi' => $this->deskripsi,
            ]);
        }
        $this->resetInput();
        session()->flash('success', 'Data berhasil diubah');
    }
}
