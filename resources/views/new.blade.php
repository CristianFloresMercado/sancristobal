<x-layouts.public>
    @foreach ($new as $item)
        <div class="news-item">
            <h2>{{ $item->titulo }}</h2>
            <p>{{ $item->resumen }}</p>
            <img src="{{ asset('storage/' . $item->imagen_destacada) }}" alt="{{ $item->titulo }}">
            <p>Estado: {{ $item->publicado ? 'Publicado' : 'Sin publicar' }}</p>
        </div>
    @endforeach
</x-layouts.public>