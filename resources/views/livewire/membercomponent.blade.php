<div>
    <div class="card">
        <div class="card-header">
            Manage Member
        </div>
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{session('success')}}
                </div>
            @endif
            <input type="text" wire:model.live="search" class="form-control w-50" placeholder="search...">
        <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">No.</th>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Email</th>
                <th>Process</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $member as $data )
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$data->nama}}</td>
                        <td>{{$data->alamat}}</td>
                        <td>{{$data->telepon}}</td>
                        <td>{{$data->email}}</td>       
                        <td>
                            <a href="#" wire:click="edit({{$data->id}})" class="btn btn-sm btn-info" 
                                data-bs-toggle="modal" data-bs-target="#editpage">Edit</a>
                            <a href="#" wire:click="confirm({{$data->id}})" 
                                data-bs-toggle="modal" data-bs-target="#deletepage" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$member->links()}}
        </div>
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addpage">Add New</a>
        </div>
        <!-- TAMBAH -->
        <div wire:ignore.self class="modal fade" id="addpage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" wire:model="nama" value="{{@old('nama')}}">
                            @error('nama')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" wire:model="telepon" value="{{@old('telepon')}}">
                            @error('telepon')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea wire:model="address" class="form-control" cols="30" rows="10">{{@old
                            ('address')}}"></textarea>
                            @error('address')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" wire:model="email" value="{{@old('email')}}">
                            @error('email')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click="resetInput" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                </div>
                </div>
            </div>
        </div>
        <!-- EDIT -->
        <div wire:ignore.self class="modal fade" id="editpage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" wire:model="nama" value="{{@old('nama')}}">
                            @error('nama')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" wire:model="address" value="{{@old('address')}}">
                            @error('address')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" wire:model="telepon" value="{{@old('telepon')}}">
                            @error('telepon')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" wire:model="email" value="{{@old('email')}}">
                            @error('email')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" wire:model="password" value="{{@old('password')}}">
                            @error('password')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click="update" class="btn btn-primary">Save</button>
                </div>
                </div>
            </div>
        </div>
        <!-- HAPUS -->
        <div wire:ignore.self class="modal fade" id="deletepage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda Yakin Untuk Hapus Data?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click="destroy" class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
                </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            For Management All Users
        </div>
    </div>
    
</div>