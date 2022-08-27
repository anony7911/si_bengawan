<div>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Pelanggan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item active">Data Pelanggan</li>
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
                                                    <center>Nama Pelanggan</center>
                                                </th>
                                                <th>
                                                    <center>Asal Instansi</center>
                                                </th>
                                                <th>
                                                    <center>No Telp</center>
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
                                            @foreach($pelanggans as $data)
                                            <tr>
                                                <td>
                                                    <center>{{ $key++ }}</center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <img src="{{ asset($data->foto_pelanggan) }}" alt="{{ $data->nama_lengkap }} | {{ $data->asal_instansi }}" width="100px" height="100px">
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>{{ $data->nama_lengkap }}</center>
                                                </td>
                                                <td>
                                                    <center>{{ $data->asal_instansi }}</center>
                                                </td>
                                                <td>
                                                    <center>{{ $data->no_telp }}</center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <button wire:click="detail({{ $data->id }})" class="btn btn-sm btn-info text-white" data-toggle="modal" data-target="#modalDetail" title="Detail">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
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
                                {{ $pelanggans->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div wire:ignore.self class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Data Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <div class="row">
                            <div class="col text-center">
                                <img src="{{ asset($data->foto_pelanggan) }}" alt="{{ $data->nama_lengkap }} | {{ $data->asal_instansi }}" width="200px">
                            </div>
                            <div class="w-100"></div>
                            <div class="col">Nama Pelanggan</div>
                            <div class="col">: {{ $nama_lengkap }}</div>
                            <div class="w-100"></div>
                            <div class="col">Asal Instansi</div>
                            <div class="col">: {{ $asal_instansi }}</div>
                            <div class="w-100"></div>
                            <div class="col">No Telp</div>
                            <div class="col">: {{ $no_telp }}</div>
                            <div class="w-100"></div>
                            <div class="col">Email</div>
                            <div class="col">: {{ $email }}</div>
                            <div class="w-100"></div>
                            <div class="col">Alamat</div>
                            <div class="col">: {{ ucfirst($alamat) }}</div>
                            <div class="w-100 mb-4"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-btn btn-block" data-dismiss="modal" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
