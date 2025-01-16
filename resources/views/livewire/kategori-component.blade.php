<div>
    <div>
        <div>
            <div>
                <div class="card">
                    <div class="card-header">
                        Manage Categories
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
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Description</th>
                                        <th>Process</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kategori as $data)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $data->nama }}</td>
                                            <td>{{ $data->deskripsi }}</td>
                                            <td>
                                                <a href="#" wire:click="edit({{ $data->id }})"
                                                    class="btn btn-sm btn-info"
                                                    onclick="$('#editpage').modal('show')">Edit</a>

                                                <!-- For Delete -->
                                                <a href="#" wire:click="confirm({{ $data->id }})"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="$('#deletepage').modal('show')">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $kategori->links() }}
                        </div>
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addpage"
                            wire:click="resetForm">Add New Category</a>
                    </div>

                    <!-- ADD Modal -->
                    <div wire:ignore.self class="modal fade" id="addpage" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label>Category Name</label>
                                            <input type="text" class="form-control" wire:model="nama">
                                            @error('nama')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" wire:model="deskripsi" cols="30" rows="10"></textarea>
                                            @error('deskripsi')
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

                    <!-- EDIT Modal -->
                    <div wire:ignore.self class="modal fade" id="editpage" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label>Category Name</label>
                                            <input type="text" class="form-control" wire:model="nama">
                                            @error('nama')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" wire:model="deskripsi" cols="30" rows="10"></textarea>
                                            @error('deskripsi')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" wire:click="update" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- DELETE Modal -->
                    <div wire:ignore.self class="modal fade" id="deletepage" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this category?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" wire:click="destroy" class="btn btn-danger"
                                        data-bs-dismiss="modal">Yes</button>
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