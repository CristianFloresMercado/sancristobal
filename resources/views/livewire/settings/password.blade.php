<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component {
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');
            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');
        $this->dispatch('password-updated');
    }
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Update password')" :subheading="__('Ensure your account is using a long, random password to stay secure')">
        <form wire:submit="updatePassword" class="my-4">
            <div class="mb-3">
                <label for="current_password" class="form-label fw-semibold">{{ __('Current password') }}</label>
                <input type="password" wire:model="current_password" id="current_password" class="form-control form-control-lg" required autocomplete="current-password" />
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">{{ __('New password') }}</label>
                <input type="password" wire:model="password" id="password" class="form-control form-control-lg" required autocomplete="new-password" />
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="form-label fw-semibold">{{ __('Confirm Password') }}</label>
                <input type="password" wire:model="password_confirmation" id="password_confirmation" class="form-control form-control-lg" required autocomplete="new-password" />
            </div>

            <div class="d-flex align-items-center gap-3">
                <button type="submit" class="btn rounded-pill fw-semibold px-4" style="background:#1a237e;color:#fff;">
                    <i class="bx bx-save me-1"></i> {{ __('Save') }}
                </button>

                <x-action-message class="text-success" on="password-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>
    </x-settings.layout>
</section>
