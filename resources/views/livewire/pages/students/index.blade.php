@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Siswa</h3>
                    <div class="card-tools">
                        <div class="btn-group">
                            <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Tambah Siswa
                            </a>
                            <a href="{{ route('students.export') }}" class="btn btn-success btn-sm">
                                <i class="fas fa-download"></i> Ekspor Excel
                            </a>
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#importModal">
                                <i class="fas fa-upload"></i> Impor Excel
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>JK</th>
                                    <th>Email</th>
                                    <th>Kelas</th>
                                    <th>Jurusan</th>
                                    <th>Tahun</th>
                                    <th style="width: 200px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($students as $student)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <strong>{{ $student->nis }}</strong>
                                        </td>
                                        <td>{{ $student->name }}</td>
                                        <td>
                                            <span class="badge {{ $student->gender == 'L' ? 'badge-primary' : 'badge-pink' }}">
                                                {{ $student->gender == 'L' ? 'L' : 'P' }}
                                            </span>
                                        </td>
                                        <td>{{ $student->email }}</td>
                                        <td>
                                            <span class="badge badge-secondary">{{ $student->classRoom->name }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-info">{{ $student->classRoom->major->short_name }}</span>
                                        </td>
                                        <td>{{ $student->year }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('students.show', $student) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('students.edit', $student) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus siswa ini? Akun pengguna juga akan dihapus.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Tidak ada data siswa</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Impor Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file">File Excel/CSV</label>
                        <input type="file" class="form-control" id="file" name="file" accept=".xlsx,.xls,.csv" required>
                        <small class="form-text text-muted">
                            Format file: Excel (.xlsx, .xls) atau CSV (.csv)<br>
                            Maksimal ukuran file: 10MB<br>
                            <strong>Header yang diperlukan:</strong> nis, nama, jenis_kelamin, email, kelas, alamat, no_hp, tahun
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-upload"></i> Impor
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection