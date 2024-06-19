@extends('layouts/main')

@section('content')
<div class="card text-bg-light shadow-lg">
    <div class="card-header">
        <div class="navbar">
            <h5 class="navbar-brand">Daftar Driver KPw BI Maluku Utara</h5>
        </div>
    </div>
    @foreach ($sopir as $aktifitas)
    <div class="card-body">
        <div class="card-profile d-flex flex-row">
            <div class="foto-driver me-4">
                <img src="#" alt="Foto Driver">
            </div>
            <div class="profile-driver">
                <table>
                    <tr>
                        <td class="baris">Nama Lengkap</td>
                        <td class="baris">:</td>
                        <td>{{ $aktifitas->nama }}</td>
                    </tr>
                    <tr>
                        <td class="baris">Alamat</td>
                        <td class="baris">:</td>
                        <td>{{ $aktifitas->alamat }}</td>
                    </tr>
                    <tr>
                        <td class="baris">Telepon</td>
                        <td class="baris">:</td>
                        <td>{{ $aktifitas->telepon }}</td>
                    </tr>
                    <tr>
                        <td>
                            <button type="button" id="status-button-{{ $aktifitas->id }}" class="badge-bs-primary-bg-subtle border-0 {{ $aktifitas->status === 'tersedia' ? 'available-status' : 'unavailable-status' }}" data-bs-toggle="modal" data-bs-target="#changeStatusModal-{{ $aktifitas->id }}">
                                {{ $aktifitas->status }}
                            </button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Change Status Modal -->
@foreach ($sopir as $aktifitas)
    <div class="modal fade" id="changeStatusModal-{{ $aktifitas->id }}" tabindex="-1" aria-labelledby="changeStatusModalLabel-{{ $aktifitas->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeStatusModalLabel-{{ $aktifitas->id }}">Change Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to change the status to "tersedia"?
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="changeStatusButton-{{ $aktifitas->id }}">Yes</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    @foreach ($sopir as $aktifitas)
        $('#changeStatusButton-{{ $aktifitas->id }}').click(function() {
            $.ajax({
                url: "{{ route('driver.updateStatus', $aktifitas->id) }}",
                type: 'PUT',
                data: {
                    _token: "{{ csrf_token() }}",
                    status: 'tersedia'
                    },
                success: function(response) {
                if (response.success) {
                    $('#status-button-{{ $aktifitas->id }}').removeClass('unavailable-status').addClass('available-status').text('tersedia');
                    $('#changeStatusModal-{{ $aktifitas->id }}').modal('hide');
                    }
                }
            });
        });
    @endforeach
});
</script>
@endsection