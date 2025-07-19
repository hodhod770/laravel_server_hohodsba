<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>شاشة تسجيل الدخول - النظام السيبراني</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts - Inter for general text, IBM Plex Mono for code/hacker feel -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=IBM+Plex+Mono:wght@400;600;700&display=swap" rel="stylesheet">
        @livewireStyles

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

        .hacker-input {
            font-family: 'IBM Plex Mono', monospace;
            background-color: #161b22; /* Slightly lighter dark */
            border: 1px solid #00ff00; /* Neon green border */
            color: #00ff00;
            box-shadow: 0 0 5px #00ff00;
            transition: all 0.3s ease-in-out;
        }

        .hacker-input:focus {
            outline: none;
            border-color: #00ffff; /* Cyan on focus */
            box-shadow: 0 0 8px #00ffff, 0 0 15px #00ffff;
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

    <div class="bg-gray-900 bg-opacity-80 p-8 md:p-12 rounded-xl shadow-lg border border-gray-700 max-w-md w-full relative z-10">
        <h1 class="text-3xl md:text-4xl font-bold text-center mb-6 hacker-text">
            <span id="title-typing"></span>
        </h1>

           {{ $slot }}


    </div>

    <script>
        // Typing effect for the title
        const titleElement = document.getElementById('title-typing');
        const titleText = "الوصول إلى النظام";
        let i = 0;

        function typeWriter() {
            if (i < titleText.length) {
                titleElement.innerHTML += titleText.charAt(i);
                i++;
                setTimeout(typeWriter, 100); // Adjust typing speed
            } else {
                titleElement.classList.add('typing-cursor'); // Add blinking cursor after typing
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

        // Message box display function (replaces alert)
        function showMessageBox(message, type = 'error') {
            const msgBox = document.getElementById('message-box');
            msgBox.textContent = message;
            msgBox.classList.remove('hidden');
            msgBox.classList.remove('bg-red-800', 'bg-green-800', 'text-red-300', 'text-green-300');

            if (type === 'success') {
                msgBox.classList.add('bg-green-800', 'text-green-300');
                msgBox.style.boxShadow = '0 0 10px #00ff00';
            } else { // default to error
                msgBox.classList.add('bg-red-800', 'text-red-300');
                msgBox.style.boxShadow = '0 0 10px #ff0000';
            }

            // Hide message after a few seconds
            setTimeout(() => {
                msgBox.classList.add('hidden');
            }, 5000);
        }

        // Form submission handler
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            // Simple client-side validation/simulation
            if (username === "admin" && password === "pass123") {
                showMessageBox("تم تسجيل الدخول بنجاح! الوصول ممنوح.", 'success');
                // In a real app, you would redirect or load dashboard
            } else {
                showMessageBox("خطأ في اسم المستخدم أو كلمة المرور. الوصول مرفوض.", 'error');
            }
        });

        // Start typing effect when the window loads
        window.onload = typeWriter;
    </script>
    @livewireScripts
</body>
</html>
