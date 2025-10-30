@extends('admin.Layout.partials.app')
@section('title', 'Create User')
@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header">Create User</div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="user" class="form-control" value="{{ old('user') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="idrole" class="form-control">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ (string) old('idrole') === (string) $role->id ? 'selected' : '' }}>
                                    {{ $role->name ?? ($role->role ?? ($role->title ?? 'Role ' . $role->id)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button class="btn btn-primary" type="submit">Create User</button>
                </form>
            </div>
        </div>
    </div>
@endsection
