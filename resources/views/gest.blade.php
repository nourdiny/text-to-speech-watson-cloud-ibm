<x-app-layout>
    @if (Request::path() === 'register')
    <livewire:Register />
    @endif
    @if (Request::path() === 'login')
    <livewire:Login />
    @endif
</x-app-layout>
