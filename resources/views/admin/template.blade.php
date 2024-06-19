@extends('layouts/main')

@section('content')
{{-- Tampilan utama --}}
    <img src="/img/grafis.png" class="position-fixed" style="margin-top: 350px; margin-left: 1000px" alt="">
    <ul class="mt-1 ms-3">
        <li>{{ $title }}</li>
    </ul>
    <div class="card text-bg-light shadow-lg">
        <div class="card-header">
            <div class="navbar">
            <h5 class="navbar-brand">Template Surat</h5>
            </div>
        </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Judul Template</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($templates as $item)
                        <tr>
                                
                            <td>{{ $loop->iteration }}.</td>
                            <td>{{ $item->template }}</td>
                            <td>
                                <a class="badge-bs-primary-bg-subtle border-0 me-1" href="{{ route('edittemplate', $item->id) }}"><i class="bi bi-pencil-square"></i></a>
                                <button class="badge-bs-primary-bg-subtle border-0 me-1"><i class="bi bi-download"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
@endsection