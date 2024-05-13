@extends('layouts.admin')
@section('content')
    <form method="POST" action="{{ route('admin.savePaymentKeys') }}">
        @csrf <!-- CSRF token untuk keamanan Laravel -->
        <div class="mb-3">
            <label for="serverKey" class="form-label">Server Key</label>
            <input type="text" class="form-control w-50" id="serverKey" name="server_key" placeholder="Masukkan Server Key"
                required>
            <div id="serverKeyHelp" class="form-text">Masukkan Server Key Dari Akun Midtrans Anda.</div>
        </div>
        <div class="mb-3">
            <label for="clientKey" class="form-label">Client Key</label>
            <input type="text" class="form-control w-50" id="clientKey" name="client_key"
                placeholder="Masukkan Client Key" required>
            <div id="clientKeyHelp" class="form-text">Masukkan Client Key Dari Akun Midtrans Anda..</div>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
