<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ $title ?? config('app.name') }} - Iniciar Sesión</title>
        <link rel="icon" href="{{ asset('image/imagenicono.png') }}">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @fluxAppearance
        <style>
            * { font-family: 'Inter', sans-serif; margin: 0; padding: 0; box-sizing: border-box; }
            body { min-height: 100vh; background: #f1f5f9; }

            .login-split { display: flex; min-height: 100vh; }

            /* Left side: image */
            .login-left {
                flex: 1;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 3rem;
                color: white;
                position: relative;
                overflow: hidden;
            }
            .login-left .bg-img {
                position: absolute;
                inset: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
                z-index: 0;
            }
            .login-left .bg-overlay {
                position: absolute;
                inset: 0;
                background: linear-gradient(135deg, rgba(26, 35, 126, 0.82), rgba(40, 53, 147, 0.88));
                z-index: 1;
            }
            .login-left-content { position: relative; z-index: 2; text-align: center; max-width: 400px; width: 100%; margin: 0 auto; }
            .login-left-content .logo {
                display: block;
                width: 100px;
                height: 100px;
                border-radius: 18px;
                margin-bottom: 1.5rem;
                margin-left: auto;
                margin-right: auto;
                object-fit: cover;
                background: #fff;
                padding: 6px;
                box-shadow: 0 4px 20px rgba(0,0,0,0.3);
            }
            .login-left-content h1 { font-size: 2.2rem; font-weight: 700; margin-bottom: 0.75rem; text-shadow: 0 2px 8px rgba(0,0,0,0.2); }
            .login-left-content p { font-size: 1rem; opacity: 0.9; line-height: 1.6; }

            /* Right side: form */
            .login-right {
                flex: 1;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 3rem;
                background: #fff;
            }
            .login-card {
                width: 100%;
                max-width: 420px;
                text-align: center;
            }
            .login-card h2 { font-size: 1.75rem; font-weight: 700; color: #1a237e; margin-bottom: 0.25rem; }
            .login-card .subtitle { color: #64748b; font-size: 0.9rem; margin-bottom: 2rem; }
            .form-group { margin-bottom: 1.25rem; }
            .form-group label { display: block; font-size: 0.85rem; font-weight: 600; color: #374151; margin-bottom: 0.4rem; }
            .form-group input {
                width: 100%;
                padding: 0.8rem 1rem;
                background: #f8fafc;
                border: 2px solid #e2e8f0;
                border-radius: 0.5rem;
                color: #1e293b;
                font-size: 0.95rem;
                transition: all 0.2s;
                outline: none;
            }
            .form-group input:focus { border-color: #1a237e; box-shadow: 0 0 0 3px rgba(26, 35, 126, 0.1); background: #fff; }
            .form-group input::placeholder { color: #94a3b8; }
            .btn-login {
                width: 100%;
                padding: 0.9rem;
                background: linear-gradient(135deg, #1a237e, #283593);
                color: white;
                border: none;
                border-radius: 0.5rem;
                font-size: 1rem;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s;
                margin-top: 0.5rem;
            }
            .btn-login:hover { transform: translateY(-1px); box-shadow: 0 4px 20px rgba(26, 35, 126, 0.35); }
            .btn-login:disabled { opacity: 0.7; cursor: not-allowed; transform: none; }
            .error-text { color: #dc2626; font-size: 0.8rem; margin-top: 0.3rem; }
            .back-link {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                color: #64748b;
                font-size: 0.85rem;
                text-decoration: none;
                margin-top: 1.5rem;
                transition: color 0.2s;
            }
            .back-link:hover { color: #1a237e; }

            @media (max-width: 768px) {
                .login-split { flex-direction: column; }
                .login-left { min-height: 220px; padding: 2rem; flex: none; }
                .login-left-content .logo { width: 60px; height: 60px; border-radius: 14px; margin-bottom: 1rem; }
                .login-left-content h1 { font-size: 1.4rem; }
                .login-left-content p { font-size: 0.85rem; }
                .login-right { flex: 1; padding: 2rem; }
            }
        </style>
    </head>
    <body>
        <div class="login-split">
            <div class="login-left">
                <img src="{{ asset('Frontend/images/slider-img1.jpg') }}" alt="San Cristobal" class="bg-img" height="100%" width="100%">
                <div class="bg-overlay"></div>
                <div class="login-left-content">
                    <img src="/image/imagenicono.png" alt="San Cristobal" class="logo">
                    <p>Portal de información comunitaria. Gestiona noticias, turismo, negocios y profesionales de la localidad.</p>
                </div>
            </div>
            <div class="login-right">
                <div class="login-card">
                    {{ $slot }}
                </div>
                <a href="{{ route('home') }}" class="back-link">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    Volver al inicio
                </a>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
