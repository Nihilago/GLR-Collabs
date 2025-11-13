<?php ob_start(); ?>
<div class="min-h-screen bg-gray-50">
  <div class="max-w-6xl mx-auto py-12 px-4">
    <div class="text-center mb-12">
      <h1 class="text-5xl font-bold mb-4">Welcome to <span class="brand-green">GLR Collabs</span></h1>
      <p class="text-xl text-gray-600">Connect with fellow students and collaborate on projects</p>
    </div>

    <div class="grid md:grid-cols-3 gap-8 mb-12">
      <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-bold mb-3">🤝 Collaborate</h3>
        <p class="text-gray-600">Work together with classmates on group projects and assignments</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-bold mb-3">💡 Get Help</h3>
        <p class="text-gray-600">Ask questions and get answers from experienced students</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-bold mb-3">📚 Share Knowledge</h3>
        <p class="text-gray-600">Share your expertise and help others succeed</p>
      </div>
    </div>

    <?php if (!$isLoggedIn): ?>
    <div class="text-center">
      <h2 class="text-2xl font-bold mb-4">Get Started Today</h2>
      <div class="space-x-4">
        <a href="/collabs/views/auth/register.php" class="bg-brand-green text-black px-6 py-3 rounded-lg hover:bg-lime-400 inline-block font-bold">Sign Up</a>
        <a href="/collabs/views/auth/login.php" class="border-2 border-brand-green text-black px-6 py-3 rounded-lg hover:bg-gray-100 inline-block font-bold">Login</a>
      </div>
    </div>
    <?php else: ?>
    <div class="text-center">
      <h2 class="text-2xl font-bold mb-4">Welcome back, <?php echo htmlspecialchars($userName); ?>!</h2>
      <a href="/collabs/dashboard" class="bg-brand-green text-black px-6 py-3 rounded-lg hover:bg-lime-400 inline-block font-bold">Go to Dashboard</a>
    </div>
    <?php endif; ?>
  </div>
</div>
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>
