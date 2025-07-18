@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Kelas</h3>
                    <div class="card-tools">
                        <a href="{{ route('class-rooms.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('class-rooms.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="major_id">Jurusan <span class="text-danger">*</span></label>
                                    <select class="form-control @error('major_id') is-invalid @enderror" 
                                            id="major_id" name="major_id" required>
                                        <option value="">Pilih Jurusan</option>
                                        @foreach($majors as $major)
                                            <option value="{{ $major->id }}" {{ old('major_id') == $major->id ? 'selected' : '' }}>
                                                {{ $major->name }} ({{ $major->short_name }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('major_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nama Kelas <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name') }}" 
                                           placeholder="Masukkan nama kelas" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="grade">Tingkat <span class="text-danger">*</span></label>
                                    <select class="form-control @error('grade') is-invalid @enderror" 
                                            id="grade" name="grade" required>
                                        <option value="">Pilih Tingkat</option>
                                        <option value="1" {{ old('grade') == 1 ? 'selected' : '' }}>Tingkat 1</option>
                                        <option value="2" {{ old('grade') == 2 ? 'selected' : '' }}>Tingkat 2</option>
                                        <option value="3" {{ old('grade') == 3 ? 'selected' : '' }}>Tingkat 3</option>
                                        <option value="4" {{ old('grade') == 4 ? 'selected' : '' }}>Tingkat 4</option>
                                        <option value="5" {{ old('grade') == 5 ? 'selected' : '' }}>Tingkat 5</option>
                                        <option value="6" {{ old('grade') == 6 ? 'selected' : '' }}>Tingkat 6</option>
                                    </select>
                                    @error('grade')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                    <a href="{{ route('class-rooms.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Batal
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection