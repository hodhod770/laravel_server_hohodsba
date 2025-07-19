<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الوصول إلى النظام - مرحبًا</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts - Inter for general text, IBM Plex Mono for code/hacker feel -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=IBM+Plex+Mono:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0d1117; /* Dark background */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            overflow: hidden; /* Prevent scrollbars from glow effects */
        }

        .hacker-text {
            font-family: 'IBM Plex Mono', monospace;
            color: #00ff00; /* Neon green */
            text-shadow: 0 0 5px #00ff00, 0 0 10px #00ff00, 0 0 20px #00ff00;
        }

        .hacker-button {
            font-family: 'IBM Plex Mono', monospace;
            background-color: #00ff00; /* Neon green */
            color: #0d1117; /* Dark text */
            border: none;
            box-shadow: 0 0 10px #00ff00;
            transition: all 0.3s ease-in-out;
            position: relative;
            overflow: hidden;
        }

        .hacker-button:hover {
            background-color: #00ffff; /* Cyan on hover */
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
            from, to { border-color: transparent }
            50% { border-color: #00ff00; }
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
        }

        @keyframes scanline-move {
            0% { background-position: 0 0; }
            100% { background-position: 0 100%; }
        }

        /* Particle effect (simple CSS animation) */
        .particle {
            position: absolute;
            background-color: #00ff00;
            border-radius: 50%;
            opacity: 0;
            animation: particle-fade-move 5s infinite;
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
    </style>
</head>
<body class="scanlines">
    <!-- Particles container -->
    <div id="particles-container" class="absolute inset-0 pointer-events-none overflow-hidden"></div>

    <!-- Welcome Screen -->
    <div id="welcome-screen" class="bg-gray-900 bg-opacity-80 p-8 md:p-12 rounded-xl shadow-lg border border-gray-700 max-w-md w-full relative z-10 text-center flex flex-col items-center justify-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-8 hacker-text">
            <span id="welcome-typing"></span>
        </h1>
        <a href="/login" wire:navigate  id="start-button" class="py-3 px-8 rounded-md font-semibold text-lg hacker-button">
            بدء الوصول
        </a>
    </div>

    <script>
        // Get elements
        const welcomeScreen = document.getElementById('welcome-screen');
        const welcomeTypingElement = document.getElementById('welcome-typing');
        const startButton = document.getElementById('start-button');

        // Text for typing effect
        const welcomeText = "جاري تهيئة النظام... مرحبا .";
        let welcomeTextIndex = 0;

        // Function for typing effect on welcome screen
        function typeWelcomeText() {
            if (welcomeTextIndex < welcomeText.length) {
                welcomeTypingElement.innerHTML += welcomeText.charAt(welcomeTextIndex);
                welcomeTextIndex++;
                setTimeout(typeWelcomeText, 70); // Adjust typing speed
            } else {
                welcomeTypingElement.classList.add('typing-cursor'); // Add blinking cursor
            }
        }

        // Particle effect generation
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

        // Event listener for the "Start Access" button
        startButton.addEventListener('click', () => {
            console.log("زر بدء الوصول تم النقر عليه. جاهز للتوجيه إلى شاشة تسجيل الدخول.");
            // هنا يمكنك إضافة منطق التوجيه الخاص بك (مثلاً، window.location.href = 'login.html';)
            // أو إظهار شاشة تسجيل الدخول التي ستقوم بإنشائها في مكان آخر.
            // For now, we'll just hide the welcome screen as a visual cue.
            // welcomeScreen.classList.add('hidden');
        });

        // Start typing effect for the welcome screen when the window loads
        window.onload = typeWelcomeText;
    </script>
</body>
</html>
