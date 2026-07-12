@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
@endphp

<x-layouts.public>

    <section class="nego-header" style="background:linear-gradient(135deg,#0d47a1 0%,#1565c0 40%,#1e88e5 100%);padding:30px 0;text-align:center;">
        <div class="container px-3">
            <h2 class="text-white mb-1" style="font-family:Georgia,'Times New Roman',serif;font-size:2rem;font-weight:700;">Negocios Locales</h2>
            <p class="text-white-50 mb-0" style="font-size:0.9rem;">Explorá negocios en el mapa interactivo</p>
        </div>
    </section>

    <section class="pt-30px pb-60px">

        <div class="container">

            <div class="row">

                <div class="col-lg-12 text-center">

                    <div class="d-flex flex-wrap justify-content-center gap-2 mt-4 mb-4 cat-btns-wrap">

                        <button class="btn btn-sm rounded-pill fw-semibold cat-btn active"
                            data-filter="todos"
                            style="background:#1a237e;color:#fff;border:none;padding:8px 18px;">
                            Todos
                        </button>

                        @foreach ($categorias as $categoria)
                            <button class="btn btn-sm rounded-pill fw-semibold cat-btn"
                                data-filter="{{ Str::slug($categoria->nombre) }}"
                                style="background:#e9ecef;color:#333;border:none;padding:8px 18px;">
                                {{ $categoria->nombre }}
                            </button>
                        @endforeach

                    </div>

                </div>

            </div>

            <div id="mapa" class="rounded-3 overflow-hidden shadow-sm" style="width:100%;height:50vh;min-height:300px;"></div>

            <div class="mt-4">

                <div id="listaNegocios" class="row"></div>

            </div>

        </div>

    </section>

    <div class="modal fade" id="negocioModal" tabindex="-1">

        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

            <div class="modal-content border-0 shadow-lg" style="border-radius:16px;overflow:hidden;">

                <div class="modal-header border-0 py-3 px-4" style="background:linear-gradient(135deg,#1a237e,#283593);color:#fff;">

                    <h5 class="modal-title fw-bold fs-5" id="modalNombre"></h5>

                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>

                </div>

                <div class="modal-body p-0" id="modalBody"></div>

            </div>

        </div>

    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        const sanCristobal = [-21.154317257395107, -67.16457366943361];

        const mapa = L.map('mapa', { maxZoom: 17, minZoom: 14 }).setView(sanCristobal, 16);

        L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: '',
            maxZoom: 17
        }).addTo(mapa);

        const negocios = [
            @foreach ($negocios as $n)
                @if ($n->latitud && $n->longitud)
                    {
                        id: {{ $n->id }},
                        nombre: @json($n->nombre),
                        slug: @json($n->slug),
                        descripcion: @json($n->descripcion ?? ''),
                        categoria: @json($n->categoria->nombre ?? 'Otros'),
                        categoriaSlug: @json(Str::slug($n->categoria->nombre ?? 'otros')),
                        subcategoria: @json($n->subcategoria->nombre ?? ''),
                        direccion: @json($n->direccion ?? ''),
                        telefono: @json($n->telefono ?? ''),
                        whatsapp: @json($n->whatsapp ?? ''),
                        correo: @json($n->correo ?? ''),
                        sitioWeb: @json($n->sitio_web ?? ''),
                        facebook: @json($n->facebook ?? ''),
                        instagram: @json($n->instagram ?? ''),
                        tiktok: @json($n->tiktok ?? ''),
                        horario: @json($n->horario ?? ''),
                        logo: @json($n->logo ? Storage::url($n->logo) : ''),
                        fotoPrincipal: @json($n->foto_principal ? Storage::url($n->foto_principal) : asset('images/default.jpg')),
                        imagenes: [@foreach ($n->imagenes as $img) @json(Storage::url($img->imagen)), @endforeach],
                        lat: {{ $n->latitud }},
                        lng: {{ $n->longitud }}
                    },
                @endif
            @endforeach
        ];

        function buildOwlCarousel(n, context, height) {
            height = height || 160;
            var fotos = [n.fotoPrincipal];
            if (n.imagenes && n.imagenes.length) {
                fotos = fotos.concat(n.imagenes);
            }
            var carouselId = 'owl_' + n.id + '_' + context;
            if (fotos.length <= 1) {
                return '<img src="' + n.fotoPrincipal + '" class="d-block w-100" style="object-fit:cover;height:' + height + 'px;">';
            }
            var items = '';
            fotos.forEach(function(f) {
                items += '<div class="item"><img src="' + f + '" class="d-block w-100" style="object-fit:cover;height:' + height + 'px;"></div>';
            });
            return '<div id="' + carouselId + '" class="owl-carousel owl-theme">' + items + '</div>';
        }

        function initOwl(carouselId, itemCount) {
            if (itemCount <= 1) return;
            var el = document.getElementById(carouselId);
            if (!el || el.classList.contains('owl-loaded')) return;
            jQuery('#' + carouselId).owlCarousel({
                loop: true,
                margin: 0,
                nav: false,
                dots: false,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                smartSpeed: 500,
                touchDrag: true,
                mouseDrag: true,
                items: 1,
                animateOut: 'fadeOut'
            });
        }

        let allMarkers = [];

        negocios.forEach(function(n) {
            const marker = L.marker([n.lat, n.lng]).addTo(mapa);

            marker.bindTooltip('<strong>' + n.nombre + '</strong>', { permanent: true, direction: 'top', offset: [0, -10], className: 'negocio-label' });

            const descShort = n.descripcion.length > 100 ? n.descripcion.substring(0, 100) + '...' : n.descripcion;

            var fotoCount = 1 + (n.imagenes ? n.imagenes.length : 0);
            var popupCarouselId = 'owl_' + n.id + '_popup';

            let popupHtml = '<div style="width:220px;">' +
                buildOwlCarousel(n, 'popup', 140) +
                '<div class="p-2">' +
                '<h6 class="fw-bold mb-1">' + n.nombre + '</h6>' +
                '<small class="text-muted">' + n.categoria + '</small>' +
                '<p class="small mt-1 mb-2">' + descShort + '</p>' +
                '<button class="btn btn-sm w-100 rounded-pill fw-semibold" style="background:#1a237e;color:#fff;" onclick="openModal(' + n.id + ')">Ver más</button>' +
                '</div></div>';

            marker.bindPopup(popupHtml);

            marker.on('popupopen', function() {
                setTimeout(function() { initOwl(popupCarouselId, fotoCount); }, 100);
            });

            allMarkers.push({ data: n, marker: marker, fotoCount: fotoCount });
        });

        function renderList(filter) {
            const container = document.getElementById('listaNegocios');
            container.innerHTML = '';
            let filtered = allMarkers;
            if (filter && filter !== 'todos') {
                filtered = allMarkers.filter(function(m) { return m.data.categoriaSlug === filter; });
            }
            if (filtered.length === 0) {
                container.innerHTML = '<div class="col-12 text-center"><p class="text-muted">No hay negocios en esta categoría.</p></div>';
                return;
            }
            filtered.forEach(function(m) {
                const col = document.createElement('div');
                col.className = 'col-12 col-sm-6 col-md-4 col-lg-3 mb-2';
                col.setAttribute('data-categoria', m.data.categoriaSlug);
                const link = document.createElement('a');
                link.href = '#';
                link.className = 'd-flex align-items-center gap-2 p-2 rounded text-decoration-none';
                link.style.cssText = 'background:#f8f9fa;transition:all .2s;';
                link.onmouseenter = function() { this.style.background='#e8eaf6'; this.style.transform='translateY(-1px)'; };
                link.onmouseleave = function() { this.style.background='#f8f9fa'; this.style.transform='translateY(0)'; };
                link.onclick = function(e) {
                    e.preventDefault();
                    mapa.setView([m.data.lat, m.data.lng], 17);
                    m.marker.openPopup();
                };
                link.innerHTML = '<div><div class="fw-semibold" style="font-size:14px;color:#1a237e;">' + m.data.nombre + '</div><small class="text-muted">' + m.data.categoria + '</small></div>';
                col.appendChild(link);
                container.appendChild(col);
            });
        }

        renderList('todos');

        function setFilterButtonStyles(activeBtn) {
            document.querySelectorAll('.cat-btn').forEach(function(b) {
                b.style.background = '#e9ecef';
                b.style.color = '#333';
                b.classList.remove('active');
            });
            activeBtn.style.background = '#1a237e';
            activeBtn.style.color = '#fff';
            activeBtn.classList.add('active');
        }

        document.querySelectorAll('.cat-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const filter = this.dataset.filter;
                setFilterButtonStyles(this);
                allMarkers.forEach(function(m) {
                    if (filter === 'todos' || m.data.categoriaSlug === filter) {
                        mapa.addLayer(m.marker);
                    } else {
                        mapa.removeLayer(m.marker);
                    }
                });
                renderList(filter);
            });
        });

        function openModal(id) {
            const n = negocios.find(function(item) { return item.id === id; });
            if (!n) return;

            var modalFotoCount = 1 + (n.imagenes ? n.imagenes.length : 0);
            var modalCarouselId = 'owl_' + n.id + '_modal';

            let socialLinks = '';
            if (n.whatsapp) socialLinks += '<a href="https://wa.me/' + n.whatsapp + '" target="_blank" class="btn btn-sm btn-success rounded-pill fw-semibold"><i class="la la-whatsapp me-1"></i>WhatsApp</a> ';
            if (n.facebook) socialLinks += '<a href="' + n.facebook + '" target="_blank" class="btn btn-sm btn-primary rounded-pill fw-semibold"><i class="la la-facebook me-1"></i>Facebook</a> ';
            if (n.instagram) socialLinks += '<a href="' + n.instagram + '" target="_blank" class="btn btn-sm btn-danger rounded-pill fw-semibold"><i class="la la-instagram me-1"></i>Instagram</a> ';
            if (n.tiktok) socialLinks += '<a href="' + n.tiktok + '" target="_blank" class="btn btn-sm btn-dark rounded-pill fw-semibold"><i class="la la-music me-1"></i>TikTok</a> ';
            if (n.sitioWeb) socialLinks += '<a href="' + n.sitioWeb + '" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill fw-semibold"><i class="la la-globe me-1"></i>Sitio web</a>';

            let infoItems = '';
            if (n.categoria) infoItems += '<div class="d-flex align-items-center gap-2 mb-2"><span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1"><i class="la la-tag me-1"></i>' + n.categoria + '</span></div>';
            if (n.subcategoria) infoItems += '<div class="d-flex align-items-center gap-2 mb-2"><span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3 py-1"><i class="la la-bookmark me-1"></i>' + n.subcategoria + '</span></div>';

            let detailRows = '';
            if (n.direccion) detailRows += '<div class="d-flex align-items-start gap-2 mb-2"><i class="la la-map-marker text-danger mt-1"></i><span>' + n.direccion + '</span></div>';
            if (n.telefono) detailRows += '<div class="d-flex align-items-center gap-2 mb-2"><i class="la la-phone text-success"></i><span>' + n.telefono + '</span></div>';
            if (n.correo) detailRows += '<div class="d-flex align-items-center gap-2 mb-2"><i class="la la-envelope text-primary"></i><span>' + n.correo + '</span></div>';
            if (n.horario) detailRows += '<div class="d-flex align-items-center gap-2 mb-2"><i class="la la-clock-o text-warning"></i><span>' + n.horario + '</span></div>';

            let logoHtml = '';
            if (n.logo) {
                logoHtml = '<div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom"><img src="' + n.logo + '" class="rounded-circle border border-2" style="width:56px;height:56px;object-fit:cover;"><div><h6 class="fw-bold mb-0" style="color:#1a237e;">' + n.nombre + '</h6><small class="text-muted">' + n.categoria + '</small></div></div>';
            }

            var modalCarouselHtml = buildOwlCarousel(n, 'modal', 380);

            document.getElementById('modalBody').innerHTML =
                '<div class="row g-0">' +
                    '<div class="col-md-7">' +
                        '<div class="position-relative">' +
                            modalCarouselHtml +
                            '<span class="position-absolute top-0 end-0 badge rounded-pill m-3" style="background:#1a237e;color:#fff;">' + modalFotoCount + ' foto' + (modalFotoCount > 1 ? 's' : '') + '</span>' +
                        '</div>' +
                    '</div>' +
                    '<div class="col-md-5 p-4">' +
                        logoHtml +
                        (n.descripcion ? '<p class="text-muted mb-3 lh-lg">' + n.descripcion + '</p>' : '') +
                        infoItems +
                        detailRows +
                        (socialLinks ? '<div class="d-flex flex-wrap gap-2 mt-3 pt-3 border-top">' + socialLinks + '</div>' : '') +
                    '</div>' +
                '</div>';

            const bsModal = new bootstrap.Modal(document.getElementById('negocioModal'));
            bsModal.show();

            document.getElementById('negocioModal').addEventListener('shown.bs.modal', function handler() {
                setTimeout(function() {
                    initOwl(modalCarouselId, modalFotoCount);
                }, 200);

                document.getElementById('negocioModal').removeEventListener('shown.bs.modal', handler);
            });
        }

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(pos) {
                L.marker([pos.coords.latitude, pos.coords.longitude])
                    .addTo(mapa)
                    .bindPopup('Tu ubicación')
                    .openPopup();
            });
        }
    </script>

    <style>
        .cat-btn.active { box-shadow: 0 2px 8px rgba(26,35,126,.35); }
        .cat-btn:hover { opacity:.85; }
        .leaflet-control-attribution { display: none !important; }
        .owl-carousel .owl-stage { display: flex; }
        .owl-carousel .item img { width: 100%; height: 100%; object-fit: cover; }
        .owl-carousel .owl-dots { display: none !important; }
        .owl-carousel .owl-nav { display: none !important; }
        .negocio-label {
            background: rgba(255,255,255,0.92);
            border: 1px solid #1a237e;
            border-radius: 6px;
            padding: 3px 8px;
            font-size: 12px;
            font-weight: 600;
            color: #1a237e;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            white-space: nowrap;
        }
        .negocio-label::before { border-top-color: rgba(255,255,255,0.92) !important; }
        #negocioModal .modal-body .owl-carousel .item img { height: 380px !important; }

        @media (max-width: 767.98px) {
            .nego-header { padding: 20px 0 !important; }
            .nego-header h2 { font-size: 1.5rem !important; }
            .nego-header p { font-size: 0.8rem !important; }
            #mapa { height: 35vh !important; min-height: 220px !important; }
            .cat-btn { padding: 6px 12px !important; font-size: 0.8rem !important; }
            #negocioModal .modal-dialog { margin: 0.5rem !important; }
            #negocioModal .modal-body .owl-carousel .item img { height: 220px !important; }
            #negocioModal .modal-body .row.g-0 { flex-direction: column; }
            #negocioModal .modal-body .col-md-7, #negocioModal .modal-body .col-md-5 { width: 100% !important; max-width: 100% !important; flex: 0 0 100% !important; }
            #negocioModal .modal-body .col-md-5 { border-top: 1px solid #eee; padding: 1rem !important; }
            #negocioModal .modal-body .d-flex.flex-wrap.gap-2 { gap: 6px !important; }
            #negocioModal .modal-body .btn { font-size: 0.75rem !important; padding: 4px 10px !important; }
        }

        @media (max-width: 575.98px) {
            #mapa { height: 30vh !important; min-height: 200px !important; }
            .negocio-label { font-size: 10px !important; padding: 2px 6px !important; }
            .cat-btns-wrap { gap: 6px !important; }
        }
    </style>

</x-layouts.public>
