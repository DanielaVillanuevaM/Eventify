<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventify - Tu plataforma de eventos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #121212;
            color: #ffffff;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        }
        
        .floating {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.8; }
            100% { transform: scale(1); opacity: 1; }
        }
        
        .button-glow {
            position: relative;
            z-index: 1;
            overflow: hidden;
        }
        
        .button-glow::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 70%);
            opacity: 0;
            transform: scale(0.5);
            transition: transform 0.5s, opacity 0.5s;
            z-index: -1;
        }
        
        .button-glow:hover::after {
            opacity: 1;
            transform: scale(1);
        }
        
        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            opacity: 0;
        }
    </style>
</head>
<body>
    <div id="confetti-container" class="fixed inset-0 pointer-events-none"></div>
    
    <div class="min-h-screen flex flex-col">
        <header class="py-4 px-6 md:px-12">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-purple-500 to-pink-500">
                        Eventify
                    </div>
                </div>
                <div class="hidden md:flex space-x-4">
                </div>
                
            </div>
        </header>

        <main class="flex-grow">
            <section class="hero-gradient py-16 md:py-24 px-6 md:px-12 rounded-b-3xl">
                <div class="max-w-6xl mx-auto">
                    <div class="flex flex-col md:flex-row items-center">
                        <div class="md:w-1/2 mb-10 md:mb-0">
                            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                                Crea momentos <span class="bg-clip-text text-transparent bg-gradient-to-r from-purple-400 to-pink-500">inolvidables</span>
                            </h1>
                            <p class="text-lg md:text-xl text-gray-300 mb-8">
                                Planifica, organiza y disfruta de tus eventos con Eventify. La plataforma que transforma tus reuniones, fiestas y celebraciones en experiencias extraordinarias.
                            </p>
                            @if (Route::has('login'))
                                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                                    @auth
                                        <a href="{{ url('/dashboard') }}"
                                        class="button-glow bg-gradient-to-r from-purple-600 to-pink-600 text-white font-medium py-3 px-8 rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                                            Ir al Dashboard
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}"
                                        class="button-glow bg-gradient-to-r from-purple-600 to-pink-600 text-white font-medium py-4 px-8 rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                                            Iniciar Sesión
                                        </a>

                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}"
                                            class="button-glow bg-transparent border-2 border-purple-500 text-white font-medium py-4 px-8 rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                                                Registrarse
                                            </a>
                                        @endif
                                    @endauth
                                </div>
                        @endif

                        </div>
                        <div class="md:w-1/2 relative">
                            <div class="relative h-64 md:h-96">
                                <!-- Elementos decorativos animados -->
                                <div class="absolute top-10 left-10 w-32 h-32 bg-purple-500 rounded-full opacity-20 floating" style="animation-delay: 0s;"></div>
                                <div class="absolute top-20 right-20 w-24 h-24 bg-pink-500 rounded-full opacity-20 floating" style="animation-delay: 0.5s;"></div>
                                <div class="absolute bottom-10 left-20 w-20 h-20 bg-blue-500 rounded-full opacity-20 floating" style="animation-delay: 1s;"></div>
                                
                                <!-- Iconos de eventos -->
                                <div class="absolute top-1/4 left-1/4 transform -translate-x-1/2 -translate-y-1/2 pulse" style="animation-delay: 0.2s;">
                                    <svg class="w-12 h-12 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z" />
                                    </svg>
                                </div>
                                <div class="absolute top-1/2 right-1/4 transform translate-x-1/2 -translate-y-1/2 pulse" style="animation-delay: 0.5s;">
                                    <svg class="w-14 h-14 text-pink-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M6 3a1 1 0 011-1h.01a1 1 0 010 2H7a1 1 0 01-1-1zm2 3a1 1 0 00-2 0v1a2 2 0 00-2 2v1a2 2 0 00-2 2v.683a3.7 3.7 0 011.055.485 1.704 1.704 0 001.89 0 3.704 3.704 0 014.11 0 1.704 1.704 0 001.89 0 3.704 3.704 0 014.11 0 1.704 1.704 0 001.89 0A3.7 3.7 0 0118 12.683V12a2 2 0 00-2-2V9a2 2 0 00-2-2V6a1 1 0 10-2 0v1h-1V6a1 1 0 10-2 0v1H8V6zm10 8.868a3.704 3.704 0 01-4.055-.036 1.704 1.704 0 00-1.89 0 3.704 3.704 0 01-4.11 0 1.704 1.704 0 00-1.89 0A3.704 3.704 0 012 14.868V17a1 1 0 001 1h14a1 1 0 001-1v-2.132zM9 3a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1zm3 0a1 1 0 011-1h.01a1 1 0 110 2H13a1 1 0 01-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="absolute bottom-1/4 left-1/3 transform -translate-x-1/2 translate-y-1/2 pulse" style="animation-delay: 0.8s;">
                                    <svg class="w-16 h-16 text-purple-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 100 4v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2a2 2 0 100-4V6z" />
                                    </svg>
                                </div>
                                <div class="absolute bottom-1/3 right-1/3 transform translate-x-1/2 translate-y-1/2 pulse" style="animation-delay: 1.2s;">
                                    <svg class="w-10 h-10 text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M5 5a3 3 0 015-2.236A3 3 0 0114.83 6H16a2 2 0 110 4h-5V9a1 1 0 10-2 0v1H4a2 2 0 110-4h1.17C5.06 5.687 5 5.35 5 5zm4 1V5a1 1 0 10-1 1h1zm3 0a1 1 0 10-1-1v1h1z" clip-rule="evenodd" />
                                        <path d="M9 11H3v5a2 2 0 002 2h4v-7zM11 18h4a2 2 0 002-2v-5h-6v7z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-16 px-6 md:px-12">
                <div class="max-w-6xl mx-auto">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl md:text-4xl font-bold mb-4">¿Por qué elegir <span class="bg-clip-text text-transparent bg-gradient-to-r from-purple-400 to-pink-500">Eventify</span>?</h2>
                        <p class="text-gray-400 max-w-2xl mx-auto">Descubre cómo podemos ayudarte a crear eventos memorables con nuestras herramientas intuitivas y funciones exclusivas.</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="bg-gray-800 bg-opacity-50 p-8 rounded-xl hover:shadow-lg hover:shadow-purple-500/20 transition-all duration-300">
                            <div class="bg-purple-500 bg-opacity-20 p-3 rounded-full w-14 h-14 flex items-center justify-center mb-6">
                                <svg class="w-8 h-8 text-purple-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold mb-3">Planificación Sencilla</h3>
                            <p class="text-gray-400">Organiza tus eventos con facilidad utilizando nuestras herramientas intuitivas de planificación y gestión.</p>
                        </div>
                        
                        <div class="bg-gray-800 bg-opacity-50 p-8 rounded-xl hover:shadow-lg hover:shadow-pink-500/20 transition-all duration-300">
                            <div class="bg-pink-500 bg-opacity-20 p-3 rounded-full w-14 h-14 flex items-center justify-center mb-6">
                                <svg class="w-8 h-8 text-pink-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold mb-3">Invitaciones organizadas</h3>
                            <p class="text-gray-400">Envía invitaciones que mantengan a tus invitados informados.</p>
                        </div>
                        
                       <div class="bg-gray-800 bg-opacity-50 p-8 rounded-xl hover:shadow-lg hover:shadow-blue-500/20 transition-all duration-300">
                            <div class="bg-blue-500 bg-opacity-20 p-3 rounded-full w-14 h-14 flex items-center justify-center mb-6">
                                
                                <svg class="w-8 h-8 text-blue-400" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5A2.5 2.5 0 1112 6a2.5 2.5 0 010 5.5z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold mb-3">Ubicación del Evento</h3>
                            <p class="text-gray-400">Visualiza el lugar exacto del evento con integración de mapas.</p>
                        </div>

                    </div>
                </div>
            </section>
        </main>

        <footer class="bg-gray-900 py-8 px-6 md:px-12">
            <div class="max-w-6xl mx-auto">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-6 md:mb-0">
                        <div class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-purple-500 to-pink-500">
                            Eventify
                        </div>
                        <p class="text-gray-400 mt-2">Transformando eventos en experiencias</p>
                    </div>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-500 text-sm">
                    &copy; 2025 Eventify. Todos los derechos reservados.
                </div>
            </div>
        </footer>
    </div>

    <script>
        // Función para crear confeti cuando se hace hover en los botones
        document.querySelectorAll('.button-glow').forEach(button => {
            button.addEventListener('mouseenter', createConfetti);
        });

        function createConfetti() {
            const container = document.getElementById('confetti-container');
            const colors = ['#9C27B0', '#E91E63', '#3F51B5', '#00BCD4', '#4CAF50'];
            
            for (let i = 0; i < 30; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                
                const color = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.backgroundColor = color;
                
                const left = Math.random() * 100;
                const size = Math.random() * 8 + 6;
                
                confetti.style.left = left + '%';
                confetti.style.width = size + 'px';
                confetti.style.height = size + 'px';
                confetti.style.top = '0';
                confetti.style.opacity = '0';
                confetti.style.transform = 'rotate(' + (Math.random() * 360) + 'deg)';
                
                container.appendChild(confetti);
                
                // Animación
                setTimeout(() => {
                    confetti.style.transition = 'all ' + (Math.random() * 3 + 2) + 's ease-out';
                    confetti.style.transform = 'translateY(' + (Math.random() * 200 + 300) + 'px) rotate(' + (Math.random() * 360) + 'deg)';
                    confetti.style.opacity = '1';
                    
                    setTimeout(() => {
                        confetti.style.opacity = '0';
                        setTimeout(() => {
                            container.removeChild(confetti);
                        }, 1000);
                    }, 1000);
                }, 0);
            }
        }
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9446a64c940d2667',t:'MTc0ODAyNTI4OS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>