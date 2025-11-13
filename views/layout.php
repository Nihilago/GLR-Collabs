<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? htmlspecialchars($title) : 'GLR Collabs' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .brand-green { color: #8FE507; }
        .bg-brand-green { background-color: #8FE507; }
    </style>
</head>
<body class="bg-white text-black font-sans">
    <!-- Header -->
    <header class="bg-black text-white p-4">
        <nav class="max-w-6xl mx-auto flex justify-between items-center">
            <a href="<?= BASE_PATH ?>" class="text-2xl font-bold brand-green">GLR Collabs</a>

            <div class="flex items-center space-x-4">
                <?php if (isset($isLoggedIn) && $isLoggedIn): ?>
                    <span class="text-sm">Welcome, <?= htmlspecialchars($userName ?? 'User') ?>!</span>
                    <a href="<?= BASE_PATH ?>/dashboard" class="bg-brand-green text-black px-4 py-2 rounded hover:bg-lime-400">Dashboard</a>
                    <a href="<?= BASE_PATH ?>/logout" class="text-white hover:text-gray-300">Logout</a>
                <?php else: ?>
                    <a href="<?= BASE_PATH ?>/login" class="text-white hover:text-gray-300">Login</a>
                    <a href="<?= BASE_PATH ?>/register" class="bg-brand-green text-black px-4 py-2 rounded hover:bg-lime-400">Sign Up</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <?= $content ?? '' ?>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-100 text-center py-4 mt-10">
        <p class="text-sm text-gray-600">&copy; 2025 GLR Collabs. All rights reserved.</p>
    </footer>
</body>
</html>