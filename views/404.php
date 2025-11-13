<?php ob_start(); ?>

<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full text-center">
        <div class="text-6xl mb-8">🔍</div>
        <h1 class="text-4xl font-bold text-gray-900 mb-4">404 - Page Not Found</h1>
        <p class="text-gray-600 mb-8">The page you're looking for doesn't exist or has been moved.</p>
        <a href="/collabs/" class="bg-brand-green text-black px-6 py-3 rounded-lg hover:bg-lime-400 inline-block">
            Go Home
        </a>
    </div>
</div>

<?php 
$content = ob_get_clean();
include 'views/layout.php';
?>