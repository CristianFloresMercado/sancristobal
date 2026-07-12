<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component {
    public string $name = '';
    public string $email = '';

    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id)
            ],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));
            return;
        }

        $user->sendEmailVerificationNotification();
        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your name and email address')">
        <form wire:submit="updateProfileInformation" class="my-4">
            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">{{ __('Name') }}</label>
                <input type="text" wire:model="name" id="name" class="form-control form-control-lg" required autofocus autocomplete="name" />
            </div>

            <div class="mb-4">
                <label for="email" class="form-label fw-semibold">{{ __('Email') }}</label>
                <input type="email" wire:model="email" id="email" class="form-control form-control-lg" required autocomplete="email" />

                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                    <div class="alert alert-warning mt-3">
                        {{ __('Your email address is unverified.') }}
                        <a href="#" wire:click.prevent="resendVerificationNotification" class="alert-link fw-semibold">
                            {{ __('Click here to re-send the verification email.') }}
                        </a>
                        @if (session('status') === 'verification-link-sent')
                            <div class="text-success mt-2 fw-semibold">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <div class="d-flex align-items-center gap-3">
                <button type="submit" class="btn rounded-pill fw-semibold px-4" style="background:#1a237e;color:#fff;">
                    <i class="bx bx-save me-1"></i> {{ __('Save') }}
                </button>

                <x-action-message class="text-success" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>

        <hr class="my-4">

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
