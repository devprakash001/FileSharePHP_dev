<?php
$success = $error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm-password'] ?? '';

    if (!$fullname || !$email || !$password || !$confirm) {
        $error = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email address.';
    } elseif ($password !== $confirm) {
        $error = 'Passwords do not match.';
    } else {
        $dataFile = __DIR__ . '/data.json';
        $data = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : ['users' => [], 'contacts' => []];
        // Check if email already exists
        foreach ($data['users'] as $user) {
            if (strtolower($user['email']) === strtolower($email)) {
                $error = 'Email already registered.';
                break;
            }
        }
        if (!$error) {
            $data['users'][] = [
                'fullname' => $fullname,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ];
            file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT));
            $success = 'Registration successful! You can now <a href="login.php" class="text-blue-600 underline">login</a>.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - FileShare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-300">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <div class="text-center">
                    <h1 class="text-3xl font-bold text-blue-600 dark:text-blue-400 mb-2">FileShare</h1>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Create your account</h2>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Already have an account?
                        <a href="login.php" class="font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400">
                            Sign in here
                        </a>
                    </p>
                </div>
            </div>
            <form class="mt-8 space-y-6" action="#" method="POST">
                <?php if ($success): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        <?= $success ?>
                    </div>
                <?php elseif ($error): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <?= $error ?>
                    </div>
                <?php endif; ?>
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8">
                    <div class="space-y-4">
                        <div>
                            <label for="fullname" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Full Name
                            </label>
                            <input id="fullname" name="fullname" type="text" required 
                                   class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-white bg-white dark:bg-gray-700 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                                   placeholder="Enter your full name">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Email address
                            </label>
                            <input id="email" name="email" type="email" required 
                                   class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-white bg-white dark:bg-gray-700 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                                   placeholder="Enter your email">
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Password
                            </label>
                            <input id="password" name="password" type="password" required 
                                   class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-white bg-white dark:bg-gray-700 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                                   placeholder="Create a password">
                        </div>
                        <div>
                            <label for="confirm-password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Confirm Password
                            </label>
                            <input id="confirm-password" name="confirm-password" type="password" required 
                                   class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-white bg-white dark:bg-gray-700 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                                   placeholder="Confirm your password">
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" 
                                class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            Create Account
                        </button>
                    </div>
                </div>
            </form>
            <div class="text-center">
                <a href="index.php" class="text-blue-600 hover:text-blue-500 dark:text-blue-400 text-sm">
                    ← Back to home
                </a>
            </div>
        </div>
    </div>

    <script>
        // Dark mode functionality
        const currentTheme = localStorage.getItem('theme') || 'light';
        if (currentTheme === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
</body>
</html>
