<div>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Pesanan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item active">Pesanan</li>
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
                                                <th class="text-center">No</th>
                                                <th class="text-center">Pemesan</th>
                                                <th class="text-center">Nama Barang</th>
                                                <th class="text-center">Jumlah</th>
                                                <th class="text-center">Harga</th>
                                                <th class="text-center">Tanggal Pesan</th>
                                                <th class="text-center">Tanggal Konfirmasi</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $key = 1;
                                            @endphp
                                            @foreach($pesanans as $data)
                                            <tr>
                                                <td class="text-center">{{ $key++ }}</td>
                                                <td class="text-center ">
                                                    {{ $data->nama_lengkap }} <br>
                                                   ({{ $data->asal_instansi }})
                                                </td>
                                                <td class="text-center">{{ $data->nama_barang }}</td>
                                                <td class="text-center">{{ $data->jumlah }}</td>
                                                <td class="text-center">{{ $data->harga }}</td>
                                                <td class="text-center">
                                                    {{ Carbon\Carbon::parse($data->createdat)->isoFormat('dddd, D MMMM YYYY') }}
                                                </td>
                                                <td class="text-center">
                                                    @if($data->tanggal_konfirmasi == null)
                                                    <span class="badge badge-danger">Belum Konfirmasi</span>
                                                    @else
                                                    {{ Carbon\Carbon::parse($data->tanggal_konfirmasi)->isoFormat('dddd, D MMMM Y') }}
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($data->tanggal_konfirmasi == null)
                                                    <button wire:click="konfirmasi({{ $data->id }})" class="btn btn-sm btn-success text-white" data-toggle="modal" data-target="#modalKonfirmasi" title="Konfirmasi">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                    </button>
                                                    @endif
                                                    <button wire:click="detail({{ $data->id }})" class="btn btn-sm btn-info text-white" data-toggle="modal" data-target="#modalDetail" title="Detail">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
