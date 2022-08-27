<div>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Barang</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Barang</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#modalTambah">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Data Barang
                                </button>
                            </div>
                            <div class="card-body">
                                @include('layouts._alert')
                                
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center>No</center>
                                                </th>
                                                <th>
                                                    <center>Foto</center>
                                                </th>
                                                <th>
                                                    <center>Nama Barang</center>
                                                </th>
                                                <th>
                                                    <center>Merk</center>
                                                </th>
                                                <th>
                                                    <center>Harga</center>
                                                </th>
                                                <th>
                                                    <center>Status Barang</center>
                                                </th>
                                                <th>
                                                    <center>Aksi</center>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $key = 1;
                                            @endphp
                                            @foreach($barangs as $data)
                                            <tr>
                                                <td>
                                                    <center>{{ $key++ }}</center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <img src="{{ asset($data->foto_barang) }}" alt="{{ $data->nama_barang }}" width="100px" height="100px">
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>{{ $data->nama_barang }}</center>
                                                </td>
                                                <td>
                                                    <center>{{ $data->merk }}</center>
                                                </td>
                                                <td>
                                                    <center> @currency($data->harga) / {{ $data->satuan }}</center>
                                                </td>
                                                <td>
                                                    <center>
                                                        @if($data->status_barang == true)
                                                        <span class="badge badge-success">Tersedia</span>
                                                        @else
                                                        <span class="badge badge-warning text-white">Tidak Tersedia</span>
                                                        @endif
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        @if($data->status_barang == true)
                                                        <button wire:click="nonaktifkan({{ $data->id }})" class="btn btn-sm btn-warning text-white" data-toggle="tooltipe" title="Nonaktifkan">
                                                            <i class="fa fa-ban" aria-hidden="true"></i>
                                                        </button>
                                                        @else
                                                        <button wire:click="aktifkan({{ $data->id }})" class="btn btn-sm btn-success" data-toggle="tooltipe" title="Aktifkan">
                                                            <i class="fa fa-check" aria-hidden="true"></i>
                                                        </button>
                                                        @endif
                                                        <button wire:click="barangId({{ $data->id }})" class="btn btn-sm btn-info text-white" data-toggle="modal" data-target="#modalEdit" title="Update">
                                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                                        </button>
                                                        <button wire:click="delete({{ $data->id }})" class="btn btn-sm btn-danger" data-toggle="tooltipe" title="Hapus">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </button>
                                                    </center>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $barangs->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div wire:ignore.self class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <form wire:submit.prevent="store" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label>Nama Barang</label>
                            <input wire:model="nama_barang" type="text" class="form-control @error('nama_barang') is-invalid @enderror">
                            @error('nama_barang')<div class="invalid-feedback">{{ $message }}
                            </div>@enderror
                        </div>
                        <div class="form-group mb-2">
                            <label>Merk</label>
                            <input wire:model="merk" type="text" class="form-control @error('merk') is-invalid @enderror">
                            @error('merk')<div class="invalid-feedback">{{ $message }}
                            </div>@enderror
                        </div>
                        <div class="form-group mb-2">
                            <label>Harga Satuan</label>
                            <input wire:model="harga" type="number" class="form-control @error('harga') is-invalid @enderror">
                            @error('harga')<div class="invalid-feedback">{{ $message }}
                            </div>@enderror
                        </div>
                        <div class="form-group mb-2">
                            <label>Satuan</label>
                            <input wire:model="satuan" type="text" class="form-control @error('satuan') is-invalid @enderror">
                            @error('satuan')<div class="invalid-feedback">{{ $message }}
                            </div>@enderror
                        </div>
                        <div class="form-group mb-2">
                            <label>Deskripsi</label>
                            <textarea wire:model="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">
                        </textarea>
                            @error('deskripsi')<div class="invalid-feedback">{{ $message }}
                            </div>@enderror
                        </div>
                        <div class="form-group mb-2">
                            <label>Gambar</label>
                            <input type="file" wire:model="foto_barang" class="form-control @error('foto_barang') is-invalid @enderror">
                            @error('foto_barang')<div class="invalid-feedback">{{ $message }}
                            </div>@enderror
                        </div>
                        <div class="form-group mb-2">
                            @if($foto_barang)
                            <label for="">
                                <img src="{{ $foto_barang->temporaryUrl() }}" width="200px">
                            </label>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal" data-dismiss="modal">Close</button>
                            <button type="submit" wire:click.prevent="store()" class="btn btn-success close-modal" data-dismiss="modal">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Data Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <form wire:submit.prevent="update" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label>Nama Barang</label>
                            <input wire:model="nama_barang" type="text" class="form-control @error('nama_barang') is-invalid @enderror">
                            @error('nama_barang')<div class="invalid-feedback">{{ $message }}
                            </div>@enderror
                        </div>
                        <div class="form-group mb-2">
                            <label>Merk</label>
                            <input wire:model="merk" type="text" class="form-control @error('merk') is-invalid @enderror">
                            @error('merk')<div class="invalid-feedback">{{ $message }}
                            </div>@enderror
                        </div>
                        <div class="form-group mb-2">
                            <label>Harga Satuan</label>
                            <input wire:model="harga" type="number" class="form-control @error('harga') is-invalid @enderror">
                            @error('harga')<div class="invalid-feedback">{{ $message }}
                            </div>@enderror
                        </div>
                        <div class="form-group mb-2">
                            <label>Satuan</label>
                            <input wire:model="satuan" type="text" class="form-control @error('satuan') is-invalid @enderror">
                            @error('satuan')<div class="invalid-feedback">{{ $message }}
                            </div>@enderror
                        </div>
                        <div class="form-group mb-2">
                            <label>Deskripsi</label>
                            <textarea wire:model="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">
                        </textarea>
                            @error('deskripsi')<div class="invalid-feedback">{{ $message }}
                            </div>@enderror
                        </div>
                        <div class="form-group mb-2">
                            <label>Gambar</label>
                            <input type="file" wire:model="foto_barang" class="form-control @error('foto_barang') is-invalid @enderror">
                            @error('foto_barang')<div class="invalid-feedback">{{ $message }}
                            </div>@enderror
                        </div>
                        <div class="form-group mb-2">
                            @if($foto_barang)
                            <label for="">
                                <img src="{{ $foto_barang->temporaryUrl() }}" width="200px">
                        </label>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal" data-dismiss="modal">Close</button>
                        <button type="submit" wire:click.prevent="update()" class="btn btn-info close-modal" data-dismiss="modal">Update</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
