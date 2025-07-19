<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - النظام السيبراني</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts - Inter for general text, IBM Plex Mono for code/hacker feel -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=IBM+Plex+Mono:wght@400;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0d1117;
            /* Dark background */
            display: flex;
            flex-direction: column;
            /* Allow vertical stacking for header and main content */
            justify-content: flex-start;
            /* Align content to the top */
            align-items: center;
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
            /* Prevent horizontal scrollbars */
            position: relative;
            /* For scanlines and particles */
            direction: rtl;
            /* Added for RTL support */
        }

        .hacker-text {
            font-family: 'IBM Plex Mono', monospace;
            color: #00ff00;
            /* Neon green */
            text-shadow: 0 0 5px #00ff00, 0 0 10px #00ff00, 0 0 20px #00ff00;
        }

        .hacker-subtext {
            font-family: 'IBM Plex Mono', monospace;
            color: #00ffff;
            /* Cyan */
            text-shadow: 0 0 3px #00ffff;
        }

        .hacker-card {
            background-color: #161b22;
            /* Slightly lighter dark */
            border: 1px solid #00ff00;
            /* Neon green border */
            box-shadow: 0 0 8px #00ff00;
            transition: all 0.3s ease-in-out;
        }

        .hacker-card:hover {
            border-color: #00ffff;
            /* Cyan on hover */
            box-shadow: 0 0 12px #00ffff, 0 0 20px #00ffff;
            transform: translateY(-2px);
        }

        .hacker-button {
            font-family: 'IBM Plex Mono', monospace;
            background-color: #00ff00;
            /* Neon green */
            color: #0d1117;
            /* Dark text */
            border: none;
            box-shadow: 0 0 10px #00ff00;
            transition: all 0.3s ease-in-out;
            position: relative;
            overflow: hidden;
            display: block;
            /* Ensure <a> behaves like a block for full width */
            text-align: center;
            /* Center text within the link */
            text-decoration: none;
            /* Remove default underline */
        }

        .hacker-button:hover {
            background-color: #00ffff;
            /* Cyan on hover */
            box-shadow: 0 0 15px #00ffff, 0 0 25px #00ffff;
            transform: translateY(-2px);
        }

        .hacker-button:active {
            transform: translateY(0);
            box-shadow: 0 0 5px #00ffff;
        }

        /* Glitch effect for button */
        .hacker-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 255, 255, 0.1);
            transform: translateX(-100%);
            transition: transform 0.5s ease-out;
        }

        .hacker-button:hover::before {
            transform: translateX(0);
        }

        /* Typing effect cursor */
        .typing-cursor::after {
            content: '|';
            animation: blink-caret 0.75s step-end infinite;
        }

        @keyframes blink-caret {

            from,
            to {
                border-color: transparent
            }

            50% {
                border-color: #00ff00;
            }
        }

        /* Scanline effect */
        .scanlines::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, transparent 50%, rgba(0, 0, 0, 0.3) 50%);
            background-size: 100% 4px;
            pointer-events: none;
            opacity: 0.2;
            animation: scanline-move 8s linear infinite;
            z-index: 0;
            /* Ensure it's behind content */
        }

        @keyframes scanline-move {
            0% {
                background-position: 0 0;
            }

            100% {
                background-position: 0 100%;
            }
        }

        /* Particle effect (simple CSS animation) */
        .particle {
            position: absolute;
            background-color: #00ff00;
            border-radius: 50%;
            opacity: 0;
            animation: particle-fade-move 5s infinite;
            z-index: 0;
            /* Ensure it's behind content */
        }

        @keyframes particle-fade-move {
            0% {
                transform: translate(0, 0) scale(0);
                opacity: 0;
            }

            10% {
                opacity: 0.8;
                transform: translate(var(--x1), var(--y1)) scale(1);
            }

            50% {
                opacity: 0.5;
                transform: translate(var(--x2), var(--y2)) scale(0.8);
            }

            100% {
                transform: translate(var(--x3), var(--y3)) scale(0);
                opacity: 0;
            }
        }

        /* Layout for sidebar and main content */
        .dashboard-layout {
            display: flex;
            flex-direction: column;
            /* Default to column for mobile */
            width: 100%;
            flex-grow: 1;
        }

        @media (min-width: 768px) {

            /* On medium screens and up, use row layout */
            .dashboard-layout {
                flex-direction: row;
                /* Flex items will naturally reverse order in RTL */
            }
        }

        /* Sidebar specific styles */
        .hacker-aside {
            background-color: #161b22;
            /* Darker background than cards */
            border: 1px solid #00ffff;
            /* Cyan border for distinction */
            box-shadow: 0 0 10px #00ffff;
            padding: 1.5rem;
            margin: 1rem;
            /* Margin around the sidebar */
            border-radius: 0.75rem;
            /* rounded-xl */
            min-width: 200px;
            /* Minimum width for sidebar */
            max-width: 250px;
            /* Maximum width for sidebar */
            flex-shrink: 0;
            /* Prevent sidebar from shrinking */
        }

        @media (max-width: 767px) {

            /* On small screens, sidebar takes full width */
            .hacker-aside {
                width: calc(100% - 2rem);
                /* Full width minus margin */
                max-width: none;
                margin-left: auto;
                margin-right: auto;
            }
        }
    </style>
</head>

<body class="scanlines">
    <!-- Particles container -->
    <div id="particles-container" class="absolute inset-0 pointer-events-none overflow-hidden"></div>

    <header class="w-full bg-gray-900 bg-opacity-90 py-4 px-6 md:px-12 shadow-lg border-b border-gray-700 relative z-10">
        <h1 class="text-3xl md:text-4xl font-bold text-center hacker-text">
            <span id="dashboard-title-typing"></span>
        </h1>
        <p class="text-center text-gray-400 text-sm md:text-base mt-2 hacker-subtext">
            لوحة تحكم نظام هدهد سباء
        </p>
    </header>

    <div class="dashboard-layout">
        <!-- Sidebar -->
        <aside class="hacker-aside relative z-10">
            <h3 class="text-xl font-semibold mb-6 hacker-text">القائمة</h3>
            <nav class="space-y-4">
                <a href="{{ route('dashboard') }}" class="hacker-button w-full py-2 text-base rounded-md">
                    الرئيسية
                </a>
                <a href="#" class="hacker-button w-full py-2 text-base rounded-md">
                    السجلات
                </a>
                <a href="#" class="hacker-button w-full py-2 text-base rounded-md">
                    مراقبة الشبكة
                </a>
                <a href="#" class="hacker-button w-full py-2 text-base rounded-md">
                    إدارة المستخدمين
                </a>
                <a href="#" class="hacker-button w-full py-2 text-base rounded-md">
                    تنبيهات الأمان
                </a>
                <a href="#" class="hacker-button w-full py-2 text-base rounded-md">
                    إعدادات النظام
                </a>
                <!-- New button for Entities Management -->
                <a href="{{ route('side-manage') }}" wire:navigate
                    class="hacker-button w-full py-2 text-base rounded-md">
                    إدارة الجهات
                </a>
            </nav>
        </aside>
        @yield('content')
        @if(isset($slot))       
         {{ $slot }}
        @endif
    </div>

    <script>
        // Typing effect for the dashboard title
        const dashboardTitleElement = document.getElementById('dashboard-title-typing');
        const dashboardTitleText = "لوحة التحكم";
        let i = 0;

        function typeDashboardTitle() {
            if (i < dashboardTitleText.length) {
                dashboardTitleElement.innerHTML += dashboardTitleText.charAt(i);
                i++;
                setTimeout(typeDashboardTitle, 100); // Adjust typing speed
            } else {
                dashboardTitleElement.classList.add('typing-cursor'); // Add blinking cursor
            }
        }

        // Particle effect generation (reused from previous code)
        const particlesContainer = document.getElementById('particles-container');

        function createParticle() {
            const particle = document.createElement('div');
            particle.classList.add('particle');
            const size = Math.random() * 3 + 1; // 1-4px
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.left = `${Math.random() * 100}vw`;
            particle.style.top = `${Math.random() * 100}vh`;

            // Random movement variables for CSS animation
            particle.style.setProperty('--x1', `${(Math.random() - 0.5) * 200}px`);
            particle.style.setProperty('--y1', `${(Math.random() - 0.5) * 200}px`);
            particle.style.setProperty('--x2', `${(Math.random() - 0.5) * 300}px`);
            particle.style.setProperty('--y2', `${(Math.random() - 0.5) * 300}px`);
            particle.style.setProperty('--x3', `${(Math.random() - 0.5) * 400}px`);
            particle.style.setProperty('--y3', `${(Math.random() - 0.5) * 400}px`);

            particle.style.animationDelay = `${Math.random() * 5}s`; // Stagger animation start
            particlesContainer.appendChild(particle);

            // Remove particle after animation to prevent DOM bloat
            particle.addEventListener('animationend', () => {
                particle.remove();
            });
        }

        // Generate a continuous stream of particles
        setInterval(createParticle, 200); // Create a new particle every 200ms

        // Start typing effect for the dashboard title when the window loads
        window.onload = typeDashboardTitle;
    </script>
</body>

</html>
