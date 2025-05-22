<form method="post" action="{{ route('password.update') }}">
    @csrf
    @method('put')

    <!-- Kata Sandi Sekarang -->
    <div class="row mb-3 align-items-center">
        <div class="col-md-4">
            <label for="update_password_current_password" class="form-label fw-semibold field">Kata Sandi
                Sekarang</label>
        </div>
        <div class="col-md-8">
            <input id="update_password_current_password" name="current_password" type="password" class="form-control"
                autocomplete="current-password">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1 text-danger" />
        </div>
    </div>

    <!-- Kata Sandi Baru -->
    <div class="row mb-3 align-items-center">
        <div class="col-md-4">
            <label for="update_password_password" class="form-label fw-semibold field">Kata Sandi Baru</label>
        </div>
        <div class="col-md-8">
            <input id="update_password_password" name="password" type="password" class="form-control"
                autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1 text-danger" />
        </div>
    </div>

    <!-- Konfirmasi Kata Sandi -->
    <div class="row mb-4 align-items-center">
        <div class="col-md-4">
            <label for="update_password_password_confirmation" class="form-label fw-semibold field">Konfirmasi Kata
                Sandi</label>
        </div>
        <div class="col-md-8">
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="form-control" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1 text-danger" />
        </div>
    </div>

    <!-- Tombol -->
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn text-white px-4 py-2"
                style="background-color: #f29142; font-weight: 600; border-radius: 10px;">
                Ubah Kata Sandi
            </button>
            @if (session('status') === 'password-updated')
                <p class="text-success mt-2">Berhasil diubah.</p>
            @endif
        </div>
    </div>

</form>
