<?php ob_start(); ?>
<div class="min-h-screen flex items-center justify-center py-12 px-4">
  <div class="max-w-md w-full space-y-8">
    <h2 class="text-center text-3xl font-extrabold text-gray-900">Sign Up for GLR Collabs</h2>
    <?php if (!empty($error)): ?>
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>
    <form class="mt-8 space-y-6" action="/collabs/register" method="POST">
      <div>
        <label for="fullname" class="block text-sm font-medium text-gray-700">Full Name</label>
        <input id="fullname" name="fullname" type="text" required class="appearance-none rounded w-full py-2 px-3 border border-gray-300 focus:outline-none focus:ring-brand-green focus:border-brand-green">
      </div>
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
        <input id="email" name="email" type="email" required class="appearance-none rounded w-full py-2 px-3 border border-gray-300 focus:outline-none focus:ring-brand-green focus:border-brand-green">
      </div>
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input id="password" name="password" type="password" required class="appearance-none rounded w-full py-2 px-3 border border-gray-300 focus:outline-none focus:ring-brand-green focus:border-brand-green">
      </div>
      <div>
        <button type="submit" class="w-full bg-brand-green text-black px-4 py-2 rounded hover:bg-lime-400 font-bold">Sign Up</button>
      </div>
    </form>
    <div class="text-center mt-4">
      <a href="/collabs/login" class="text-brand-green hover:underline">Already have an account? Login</a>
    </div>
  </div>
</div>
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>
