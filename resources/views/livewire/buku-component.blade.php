<div>
    <div>
        <div>
            <div>
                <div class="card">
                    <div class="card-header">
                        Manage Books
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
                                        <th scope="col">Title</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">Publisher</th>
                                        <th scope="col">Year</th>
                                        <th scope="col">ISBN</th>
                                        <th scope="col">Number Of Books</th>
                                        <th>Process</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($buku as $data)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $data->judul }}</td>
                                            <td>{{ $data->kategori->nama ?? 'No Category' }}</td>
                                            <td>{{ $data->penulis }}</td>
                                            <td>{{ $data->penerbit }}</td>
                                            <td>{{ $data->tahun }}</td>
                                            <td>{{ $data->isbn }}</td>
                                            <td>{{ $data->jumlah }}</td>
                                            <td>
                                                <a href="#" wire:click="edit({{ $data->id }})"
                                                    class="btn btn-sm btn-info"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editpage">Edit</a>

                                                <!-- For Delete -->
                                                <a href="#" wire:click="confirm({{ $data->id }})"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="$('#deletepage').modal('show')">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $buku->links() }}
                        </div>
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addpage">Add
                            New Book</a>
                    </div>
                    <!-- TAMBAH -->
                    <div wire:ignore.self class="modal fade" id="addpage" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Book</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form wire:submit.prevent="store">
                                        <div class="form-group">
                                            <label>Book Title</label>
                                            <input type="text" class="form-control" wire:model="judul"
                                                value="{{ @old('judul') }}">
                                            @error('judul')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <!-- Category Select -->
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select wire:model="kategori" class="form-control">
                                                <option value="" disabled selected>Choose Category</option>
                                                @foreach ($category as $data)
                                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('kategori')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Author</label>
                                            <input type="text" class="form-control" wire:model="penulis"
                                                value="{{ @old('penulis') }}">
                                            @error('penulis')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Publisher</label>
                                            <input type="text" class="form-control" wire:model="penerbit"
                                                value="{{ @old('penerbit') }}">
                                            @error('penerbit')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Year</label>
                                            <input type="text" class="form-control" wire:model="tahun"
                                                value="{{ @old('tahun') }}">
                                            @error('tahun')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>ISBN</label>
                                            <input type="text" class="form-control" wire:model="isbn"
                                                value="{{ @old('isbn') }}">
                                            @error('isbn')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Number Of Books</label>
                                            <input type="text" class="form-control" wire:model="jumlah"
                                                value="{{ @old('jumlah') }}">
                                            @error('jumlah')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
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
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Book</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label>Book Title</label>
                                            <input type="text" class="form-control" wire:model="judul"
                                                value="{{ @old('judul') }}">
                                            @error('judul')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select wire:model="kategori" class="form-control">
                                                <option value="">Choose Category</option>
                                                @foreach ($category as $data)
                                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('kategori')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Author</label>
                                            <input type="text" class="form-control" wire:model="penulis"
                                                value="{{ @old('penulis') }}">
                                            @error('penulis')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Publisher</label>
                                            <input type="text" class="form-control" wire:model="penerbit"
                                                value="{{ @old('penerbit') }}">
                                            @error('penerbit')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Year</label>
                                            <input type="text" class="form-control" wire:model="tahun"
                                                value="{{ @old('tahun') }}">
                                            @error('tahun')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>ISBN</label>
                                            <input type="text" class="form-control" wire:model="isbn"
                                                value="{{ @old('isbn') }}">
                                            @error('isbn')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Number Of Books</label>
                                            <input type="text" class="form-control" wire:model="jumlah"
                                                value="{{ @old('jumlah') }}">
                                            @error('jumlah')
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
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Book</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Delete This Book?</p>
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

    document.addEventListener('livewire:initialized', function () {
        Livewire.on('showModal', (modalId) => {
            let modal = new bootstrap.Modal(document.getElementById(modalId));
            modal.show();
        });
    });
</script>