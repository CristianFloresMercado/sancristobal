<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {
    public string $password = '';

    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();
        $this->redirect('/', navigate: true);
    }
}; ?>

<section class="mt-5 pt-4 border-top">
    <div class="mb-4">
        <h5 class="fw-bold text-danger"><i class="bx bx-trash me-1"></i> {{ __('Delete account') }}</h5>
        <p class="text-muted mb-0">{{ __('Delete your account and all of its resources') }}</p>
    </div>

    <button type="button" class="btn btn-danger rounded-pill fw-semibold px-4" data-bs-toggle="modal" data-bs-target="#confirmUserDeletion">
        <i class="bx bx-trash me-1"></i> {{ __('Delete account') }}
    </button>

    <div class="modal fade" id="confirmUserDeletion" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius:12px;overflow:hidden;">
                <div class="modal-header border-0" style="background:#dc3545;color:#fff;">
                    <h5 class="modal-title fw-bold">{{ __('Are you sure you want to delete your account?') }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form wire:submit="deleteUser">
                    <div class="modal-body">
                        <p class="text-muted">
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                        </p>
                        <div class="mt-3">
                            <label for="delete_password" class="form-label fw-semibold">{{ __('Password') }}</label>
                            <input type="password" wire:model="password" id="delete_password" class="form-control" required autocomplete="current-password" />
                            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-danger rounded-pill fw-semibold px-4">
                            <i class="bx bx-trash me-1"></i> {{ __('Delete account') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
