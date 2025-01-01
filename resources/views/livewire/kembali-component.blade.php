<div>
    <div class="card">
        <div class="card-header">
            Book retrun
        </div>
        <div class="card-body">
            @if (session()->has('success'))
                <div id="flash-message" class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <input type="text" wire:model.live="cari" class="form-control w-50" placeholder="search...">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Book Title</th>
                            <th scope="col">Member</th>
                            <th scope="col">Date Of Borrowing</th>
                            <th scope="col">Date Of Returning</th>
                            <th scope="col">Status</th>
                            <th>Process</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pinjam as $data)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $data->buku->judul }}</td>
                                <td>{{ $data->user->nama }}</td>
                                <td>{{ $data->tgl_peminjaman }}</td>
                                <td>{{ $data->tgl_pengembalian }}</td>
                                <td>
                                    <a href="#" wire:click="pilih({{ $data->id }})"
                                        class="btn btn-sm btn-success"> data-toggle="modal"
                                        data-target="#pilih">pilih</a>
                                    {{--<a href="#" wire:click="edit({{ $data->id }})"class="btn btn-sm btn-info" 
                                        data-toggle="modal"#data-target="#editpage">Edit</a>
                                    <a href="#" wire:click="confirm({{ $data->id }})"data-toggle="modal" 
                                        data-target="#deletepage" class="btn btn-sm btn-danger">Delete</a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $pinjam->links() }}
            </div>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addpage">Add New Load</a>
        </div>
         <div class="card">
        <div class="card-header">
            book return history
        </div>
        <div class="card-body">
            @if (session()->has('success'))
                <div id="flash-message" class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <input type="text" wire:model.live="cari" class="form-control w-50" placeholder="search...">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">ID Borrow</th>
                            <th scope="col">Date Of Returning</th>
                            <th scope="col">Fine</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengembalian as $data)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $data->pinjam_id }}</td>
                                <td>{{ $data->tgl_kembali }}</td>
                                <td>{{ $data->Denda }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $pinjam->links() }}
            </div>
    </div>
     <!-- TAMBAH -->
    <div wire:ignore.self class="modal fade" id="addpage" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form return Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            Book Title:
                        </div>
                        <div class="col-mb-8">
                            : {{ $title }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            Member:
                        </div>
                        <div class="col-mb-8">
                           : {{ $member }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            Return date:
                        </div>
                        <div class="col-mb-8">
                           : {{ $return_date }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            Day Date:
                        </div>
                        <div class="col-mb-8">
                          : {{ date('Y-m-d') }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            Denda:
                        </div>
                        <div class="col-mb-8">
                           : @if ($this->Status == true)
                                ya
                            @else
                                tidak
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            Lama Terlambat:
                        </div>
                        <div class="col-mb-8">
                           : {{ $lama }} hari
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            Jumlah Denda:
                        </div>
                        <div class="col-mb-8">
                           : {{ $lama * 1000}} hari
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" wire:click="store" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

</div>