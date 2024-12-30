<div>
    <div>
        <div>
            <div>
                <div class="card">
                    <div class="card-header">
                        Manage Borrowing Books
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
                                            <td>{{ $data->status }}</td>
                                            <td>
                                                <a href="#" wire:click="edit({{ $data->id }})"
                                                    class="btn btn-sm btn-info" data-toggle="modal"
                                                    data-target="#editpage">Edit</a>

                                                <a href="#" wire:click="confirm({{ $data->id }})"
                                                    data-toggle="modal" data-target="#deletepage"
                                                    class="btn btn-sm btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $pinjam->links() }}
                        </div>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addpage">Add New
                            Loan</a>
                    </div>
                    <!-- TAMBAH -->
                    <div wire:ignore.self class="modal fade" id="addpage" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Borrowing Book</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label>Book Title</label>
                                            <select wire:model='buku' class='form-control'>
                                                <option value="">Select Book</option>
                                                @foreach ($book as $data)
                                                    <option value="{{ $data->id }}">{{ $data->judul }}</option>
                                                @endforeach
                                            </select>
                                            @error('judul')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Member</label>
                                            <select wire:model='user' class='form-control'>
                                                <option value="">Select Book</option>
                                                @foreach ($member as $data)
                                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('user')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" wire:click="store" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- EDIT -->
                    <div wire:ignore.self class="modal fade" id="editpage" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Borrowing Book</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label>Book Title</label>
                                            <select wire:model='buku' class='form-control'>
                                                <option value="">Select Book</option>
                                                @foreach ($book as $data)
                                                    <option value="{{ $data->id }}">{{ $data->judul }}</option>
                                                @endforeach
                                            </select>
                                            @error('judul')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Member</label>
                                            <select wire:model='user' class='form-control'>
                                                <option value="">Select Book</option>
                                                @foreach ($member as $data)
                                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('user')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </form>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="button" wire:click="update"
                                            class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- DELETE -->
                    <div wire:ignore.self class="modal fade" id="deletepage" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Borrowing Book</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Delete This Borrowing Book Data?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Close</button>
                                    <button type="button" wire:click="destroy" class="btn btn-primary"
                                        data-dismiss="modal">Yes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const flashMessage = document.getElementById('flash-message');
        if (flashMessage) {
            setTimeout(() => {
                flashMessage.style.transition = 'opacity 0.5s';
                flashMessage.style.opacity = '0';
                setTimeout(() => flashMessage.remove(), 500);
            }, 1000);
        }
    });
</script>
