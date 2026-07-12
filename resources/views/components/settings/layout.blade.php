<div class="row g-0">
    <div class="col-md-3 border-end pe-4">
        <div class="list-group list-group-flush">
            <a href="{{ route('settings.profile') }}" wire:navigate
                class="list-group-item list-group-item-action d-flex align-items-center gap-2 py-3 {{ request()->routeIs('settings.profile') ? 'active' : '' }}">
                <i class="bx bx-user"></i> {{ __('Profile') }}
            </a>
            <a href="{{ route('settings.password') }}" wire:navigate
                class="list-group-item list-group-item-action d-flex align-items-center gap-2 py-3 {{ request()->routeIs('settings.password') ? 'active' : '' }}">
                <i class="bx bx-lock-alt"></i> {{ __('Password') }}
            </a>
            <a href="{{ route('settings.appearance') }}" wire:navigate
                class="list-group-item list-group-item-action d-flex align-items-center gap-2 py-3 {{ request()->routeIs('settings.appearance') ? 'active' : '' }}">
                <i class="bx bx-palette"></i> {{ __('Appearance') }}
            </a>
        </div>
    </div>

    <div class="col-md-9 ps-md-4">
        <div class="py-2">
            {{ $slot }}
        </div>
    </div>
</div>
