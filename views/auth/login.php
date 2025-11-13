<?php ob_start(); ?>
<div class="min-h-screen flex items-center justify-center py-12 px-4">
  <div class="max-w-md w-full space-y-8">
    <h2 class="text-center text-3xl font-extrabold text-gray-900">Login to GLR Collabs</h2>
    <?php if (!empty($error)): ?>
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <form class="mt-8 space-y-6" action="/collabs/controllers/authController.php" method="POST">
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
        <input id="email" name="email" type="email" autocomplete="email" required class="appearance-none rounded w-full py-2 px-3 border border-gray-300 focus:outline-none focus:ring-brand-green focus:border-brand-green">
      </div>
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none rounded w-full py-2 px-3 border border-gray-300 focus:outline-none focus:ring-brand-green focus:border-brand-green">
      </div>
      <div>
        <button type="submit" class="w-full bg-brand-green text-black px-4 py-2 rounded hover:bg-lime-400 font-bold">Login</button>
      </div>
    </form>
    <div class="text-center mt-4">
      <a href="/collabs/register" class="text-brand-green hover:underline">Don't have an account? Sign Up</a>
    </div>
  </div>
</div>
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>
