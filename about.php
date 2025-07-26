<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - FileShare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
</head>
<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-300">
    <!-- Navigation -->
    <nav class="bg-white dark:bg-gray-800 shadow-lg border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <h1 class="text-2xl font-bold text-blue-600 dark:text-blue-400">FileShare</h1>
                    </div>
                    <div class="hidden md:ml-6 md:flex md:space-x-8">
                        <a href="index.php" class="text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-white px-1 pt-1 text-sm font-medium">Home</a>
                        <a href="about.php" class="text-blue-600 dark:text-blue-400 border-b-2 border-blue-600 dark:border-blue-400 px-1 pt-1 text-sm font-medium">About Us</a>
                        <a href="contact.php" class="text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-white px-1 pt-1 text-sm font-medium">Contact</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <button id="theme-toggle" class="p-2 rounded-lg bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2L13.09 8.26L20 9L14 14.74L15.18 21.02L10 17.77L4.82 21.02L6 14.74L0 9L6.91 8.26L10 2Z"></path>
                        </svg>
                    </button>
                    <a href="login.php" class="text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-white px-3 py-2 text-sm font-medium">Login</a>
                    <a href="register.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- About Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">About FileShare</h1>
            <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
                We're dedicated to providing a secure, fast, and user-friendly file sharing platform 
                that makes collaboration effortless.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-12 items-center mb-16">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Our Mission</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-4">
                    At FileShare, we believe that sharing files should be simple, secure, and accessible to everyone. 
                    Our platform is designed to eliminate the complexity of file sharing while maintaining the highest 
                    standards of security and privacy.
                </p>
                <p class="text-gray-600 dark:text-gray-400 mb-4">
                    Whether you're a student sharing assignments, a professional collaborating on projects, or a 
                    business managing documents, FileShare provides the tools you need to work efficiently and securely.
                </p>
                <p class="text-gray-600 dark:text-gray-400">
                    We're committed to continuous improvement and innovation, always listening to our users' feedback 
                    to enhance their experience.
                </p>
            </div>
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg p-8 text-white">
                <h3 class="text-2xl font-bold mb-4">Why Choose Us?</h3>
                <ul class="space-y-3">
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Enterprise-grade security
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Lightning-fast uploads
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        User-friendly interface
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        24/7 customer support
                    </li>
                </ul>
            </div>
        </div>

        <!-- Technology Stack -->
        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-8 mb-16">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8 text-center">Technology Stack</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Frontend</h3>
                    <p class="text-gray-600 dark:text-gray-400">HTML5, CSS3, JavaScript, Tailwind CSS</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Backend</h3>
                    <p class="text-gray-600 dark:text-gray-400">PHP 8.0+, Apache/Nginx</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Security</h3>
                    <p class="text-gray-600 dark:text-gray-400">SSL/TLS, File Encryption, Secure Authentication</p>
                </div>
            </div>
        </div>

        <!-- Developer Section -->
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">Meet the Developer</h2>
            <div class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
                <div class="w-24 h-24 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl font-bold text-white">JD</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Dev Prakash Singh</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4">Full Stack Developer</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Passionate about creating secure and user-friendly web applications. 
                    Specialized in PHP, JavaScript, and modern web technologies.
                </p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 dark:bg-gray-900 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; 2024 FileShare. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Dark mode toggle functionality
        const themeToggle = document.getElementById('theme-toggle');
        const darkIcon = document.getElementById('theme-toggle-dark-icon');
        const lightIcon = document.getElementById('theme-toggle-light-icon');

        const currentTheme = localStorage.getItem('theme') || 'light';
        
        if (currentTheme === 'dark') {
            document.documentElement.classList.add('dark');
            darkIcon.classList.remove('hidden');
        } else {
            lightIcon.classList.remove('hidden');
        }

        themeToggle.addEventListener('click', function() {
            document.documentElement.classList.toggle('dark');
            
            if (document.documentElement.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
                darkIcon.classList.remove('hidden');
                lightIcon.classList.add('hidden');
            } else {
                localStorage.setItem('theme', 'light');
                lightIcon.classList.remove('hidden');
                darkIcon.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
