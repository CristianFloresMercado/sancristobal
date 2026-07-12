<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Appearance')" :subheading=" __('Update the appearance settings for your account')">
        <div x-data="{ appearance: $flux.appearance }" x-init="
            $watch('appearance', (val) => {
                $flux.appearance = val;
                var html = document.documentElement;
                html.classList.remove('light-theme', 'dark-theme', 'dark');
                if (val === 'dark') {
                    html.classList.add('dark-theme', 'dark');
                } else if (val === 'light') {
                    html.classList.add('light-theme');
                } else {
                    html.classList.add(window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark-theme dark' : 'light-theme');
                }
            })
        ">
            <div class="d-flex gap-3">
                <button type="button" class="btn flex-fill p-3 rounded-3 border-2 text-center"
                    :class="appearance === 'light' ? 'border-primary bg-primary bg-opacity-10' : 'border-light'"
                    @click="appearance = 'light'">
                    <i class="bx bx-sun fs-3 d-block mb-2" :class="appearance === 'light' ? 'text-primary' : 'text-muted'"></i>
                    <span class="fw-semibold">{{ __('Light') }}</span>
                </button>
                <button type="button" class="btn flex-fill p-3 rounded-3 border-2 text-center"
                    :class="appearance === 'dark' ? 'border-primary bg-primary bg-opacity-10' : 'border-light'"
                    @click="appearance = 'dark'">
                    <i class="bx bx-moon fs-3 d-block mb-2" :class="appearance === 'dark' ? 'text-primary' : 'text-muted'"></i>
                    <span class="fw-semibold">{{ __('Dark') }}</span>
                </button>
                <button type="button" class="btn flex-fill p-3 rounded-3 border-2 text-center"
                    :class="appearance === 'system' ? 'border-primary bg-primary bg-opacity-10' : 'border-light'"
                    @click="appearance = 'system'">
                    <i class="bx bx-desktop fs-3 d-block mb-2" :class="appearance === 'system' ? 'text-primary' : 'text-muted'"></i>
                    <span class="fw-semibold">{{ __('System') }}</span>
                </button>
            </div>
        </div>
    </x-settings.layout>
</section>
