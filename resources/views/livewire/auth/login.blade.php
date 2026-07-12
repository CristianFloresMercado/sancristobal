<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth.split')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}; ?>

<div>
    <h2>Iniciar Sesión</h2>
    <p class="subtitle">Ingresa tus credenciales para acceder al panel</p>

    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="login">
        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input wire:model="email" type="email" id="email" required autofocus autocomplete="email" placeholder="tu@correo.com">
            @error('email') <p class="error-text">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input wire:model="password" type="password" id="password" required autocomplete="current-password" placeholder="••••••••">
            @error('password') <p class="error-text">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="btn-login" wire:loading.attr="disabled" wire:target="login">
            <span wire:loading.remove wire:target="login">Ingresar</span>
            <span wire:loading wire:target="login">Ingresando...</span>
        </button>
    </form>
</div>
