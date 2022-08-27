<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#modalTambah"> <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    Data User</button>
            </h3>
        </div>
        <div class="card-body text-center">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts._alert')
                </div>
                <div class="col-md-6 form-inline mb-2 mt-2">
                    Per Page: &nbsp;
                    <select wire:model="perPage" class="form-control">
                        <option>2</option>
                        <option>5</option>
                        <option>10</option>
                        <option>15</option>
                        <option>25</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <input wire:model.debounce.300ms="search" class="form-control" type="text" placeholder="Search...">
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-12 table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($manajusers as $manajuser)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $manajuser->name }}</td>
                                <td>{{ $manajuser->email }}</td>
                                <td>{{ ucfirst($manajuser->role) }}</td>
                                <td>@if($manajuser->active == 1)
                                    <span class="badge badge-success">Aktif</span>
                                    @else
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                    @endif</td>
                                <td>
                                    @if($manajuser->active == 1)
                                    <button wire:click="nonaktif({{ $manajuser->id }})" class="btn btn-sm btn-warning text-white" data-toggle="tooltipe" title="Nonaktifkan"><i class="fa fa-ban" aria-hidden="true"></i></button>
                                    @else
                                    <button wire:click="aktif({{ $manajuser->id }})" class="btn btn-sm btn-success" data-toggle="tooltipe" title="Aktifkan"><i class="fa fa-check" aria-hidden="true"></i></button>
                                    @endif
                                    <button wire:click="manajuserId({{ $manajuser->id }})" class="btn btn-sm btn-info m-1" data-toggle="modal" data-target="#modalEdit" title="Update">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </button>
                                    <button wire:click="delete({{ $manajuser->id }})" class="btn btn-sm btn-danger" data-toggle="tooltipe" title="Hapus">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
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
    <div wire:ignore.self class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label>Nama Lengkap</label>
                        <input wire:model="name" type="text" class="form-control @error('name') is-invalid @enderror">
                        @error('name')<div class="invalid-feedback">{{ $message }}
                        </div>@enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Email</label>
                        <input wire:model="email" type="email" class="form-control @error('email') is-invalid @enderror">
                        @error('email')<div class="invalid-feedback">{{ $message }}
                        </div>@enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Password</label>
                        <input wire:model="password" type="text" class="form-control @error('password') is-invalid @enderror">
                        @error('password')<div class="invalid-feedback">{{ $message }}
                        </div>@enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Role</label>
                        <select wire:model="role" class="form-control">
                            <option value="admin">Karyawan</option>
                            <option value="pemilik">Pemilik</option>
                            <option value="pelanggan">Pelanggan</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal" data-dismiss="modal">Close</button>
                        <button type="submit" wire:click.prevent="store()" class="btn btn-info close-modal" data-dismiss="modal">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label>Nama Lengkap</label>
                        <input wire:model="name" type="text" class="form-control @error('name') is-invalid @enderror">
                        @error('name')<div class="invalid-feedback">{{ $message }}
                        </div>@enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Email</label>
                        <input wire:model="email" type="email" class="form-control @error('email') is-invalid @enderror">
                        @error('email')<div class="invalid-feedback">{{ $message }}
                        </div>@enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Password</label>
                        <input wire:model="password" type="text" class="form-control @error('password') is-invalid @enderror">
                        <span>*Kosongkan jika tidak ingin mengubah password.</span>
                        @error('password')<div class="invalid-feedback">{{ $message }}
                        </div>@enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Role</label>
                        <select wire:model="role" class="form-control">
                            <option value="karyawan" @if($manajuser->role == 'karyawan') selected @endif>Karyawan</option>
                            <option value="pemilik" @if($manajuser->role == 'pemilik') selected @endif>Pemilik</option>
                            <option value="pelanggan" @if($manajuser->role == 'pelanggan') selected @endif>Pelanggan</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal" data-dismiss="modal">Close</button>
                        <button type="submit" wire:click.prevent="update()" class="btn btn-info close-modal" data-dismiss="modal">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
