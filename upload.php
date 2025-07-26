<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$success = $error = '';

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['files'])) {
    $uploadDir = 'uploads/';
    
    // Create uploads directory if it doesn't exist
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    $files = $_FILES['files'];
    $uploadedCount = 0;
    
    // Handle multiple files
    for ($i = 0; $i < count($files['name']); $i++) {
        if ($files['error'][$i] === UPLOAD_ERR_OK) {
            $fileName = $files['name'][$i];
            $fileSize = $files['size'][$i];
            $fileTmp = $files['tmp_name'][$i];
            
            // Generate unique filename to prevent conflicts
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
            $uniqueName = uniqid() . '.' . $fileExtension;
            $uploadPath = $uploadDir . $uniqueName;
            
            if (move_uploaded_file($fileTmp, $uploadPath)) {
                // Save file info to JSON
                $dataFile = __DIR__ . '/data.json';
                $data = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : ['users' => [], 'contacts' => [], 'files' => []];
                
                $data['files'][] = [
                    'original_name' => $fileName,
                    'stored_name' => $uniqueName,
                    'size' => $fileSize,
                    'upload_date' => date('Y-m-d H:i:s'),
                    'uploaded_by' => $_SESSION['user'],
                    'path' => $uploadPath
                ];
                
                file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT));
                $uploadedCount++;
            }
        }
    }
    
    if ($uploadedCount > 0) {
        $success = "Successfully uploaded $uploadedCount file(s)!";
    } else {
        $error = "Failed to upload files. Please try again.";
    }
}

// Handle file deletion
if (isset($_POST['delete_file'])) {
    $fileIndex = $_POST['delete_file'];
    $dataFile = __DIR__ . '/data.json';
    $data = json_decode(file_get_contents($dataFile), true);
    
    if (isset($data['files'][$fileIndex])) {
        $file = $data['files'][$fileIndex];
        
        // Delete physical file
        if (file_exists($file['path'])) {
            unlink($file['path']);
        }
        
        // Remove from JSON
        array_splice($data['files'], $fileIndex, 1);
        file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT));
        
        $success = "File deleted successfully!";
    }
}

// Get user's files
$dataFile = __DIR__ . '/data.json';
$data = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : ['users' => [], 'contacts' => [], 'files' => []];
$userFiles = array_filter($data['files'], function($file) {
    return $file['uploaded_by'] === $_SESSION['user'];
});

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - FileShare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-300">
    <!-- Navigation -->
    <nav class="bg-white dark:bg-gray-800 shadow-lg border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <h1 class="text-2xl font-bold text-blue-600 dark:text-blue-400">FileShare</h1>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600 dark:text-gray-300">Welcome, <?= htmlspecialchars($_SESSION['user']) ?></span>
                    <button id="theme-toggle" class="p-2 rounded-lg bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2L13.09 8.26L20 9L14 14.74L15.18 21.02L10 17.77L4.82 21.02L6 14.74L0 9L6.91 8.26L10 2Z"></path>
                        </svg>
                    </button>
                    <a href="?logout=1" class="text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-white px-3 py-2 text-sm font-medium">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Welcome Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Welcome back, <?= htmlspecialchars($_SESSION['user']) ?>!</h1>
            <p class="text-gray-600 dark:text-gray-400">Upload and manage your files securely.</p>
        </div>

        <?php if ($success): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <!-- File Upload Section -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4">Upload Files</h2>
            <form method="POST" enctype="multipart/form-data">
                <div id="drop-zone" class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-8 text-center hover:border-blue-500 dark:hover:border-blue-400 transition-colors cursor-pointer">
                    <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500 mb-4" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <p class="text-lg text-gray-600 dark:text-gray-400 mb-2">Drag and drop files here</p>
                    <p class="text-sm text-gray-500 dark:text-gray-500 mb-4">or</p>
                    <input type="file" name="files[]" id="file-input" class="hidden" multiple required>
                    <button type="button" onclick="document.getElementById('file-input').click()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                        Browse Files
                    </button>
                </div>
                <div class="mt-4">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                        Upload Files
                    </button>
                </div>
            </form>
        </div>

        <!-- Files Table -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-semibold">Your Files</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">File Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Size</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Upload Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        <?php if (empty($userFiles)): ?>
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No files uploaded yet. Upload your first file above!
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($userFiles as $index => $file): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <svg class="h-5 w-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            <span class="text-sm font-medium text-gray-900 dark:text-white"><?= htmlspecialchars($file['original_name']) ?></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400"><?= number_format($file['size'] / 1024, 2) ?> KB</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400"><?= date('Y-m-d', strtotime($file['upload_date'])) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <a href="<?= htmlspecialchars($file['path']) ?>" download class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">Download</a>
                                        <button type="button" class="copy-btn text-gray-600 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded px-2 py-1 ml-2" data-link="<?= htmlspecialchars((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/' . $file['path']) ?>">Copy Link</button>
                                        <form method="POST" class="inline">
                                            <input type="hidden" name="delete_file" value="<?= $index ?>">
                                            <button type="submit" onclick="return confirm('Are you sure you want to delete this file?')" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

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

        // Drag and drop functionality
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('file-input');

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('border-blue-500', 'dark:border-blue-400');
        });

        dropZone.addEventListener('dragleave', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-blue-500', 'dark:border-blue-400');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-blue-500', 'dark:border-blue-400');
            const files = e.dataTransfer.files;
            handleFiles(files);
        });

        function handleFiles(files) {
            console.log('Files dropped:', files);
            // Handle file upload logic here
        }

        // Copy link functionality
        const copyBtns = document.querySelectorAll('.copy-btn');
        copyBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const link = this.getAttribute('data-link');
                navigator.clipboard.writeText(link).then(() => {
                    this.textContent = 'Copied!';
                    setTimeout(() => { this.textContent = 'Copy Link'; }, 1500);
                });
            });
        });
    </script>
</body>
</html>
