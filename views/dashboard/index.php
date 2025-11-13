<?php ob_start(); ?>
<div class="min-h-screen bg-gray-50">
  <div class="max-w-6xl mx-auto py-12 px-4">
    <h1 class="text-4xl font-bold mb-8">Dashboard</h1>

    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
      <h2 class="text-2xl font-bold mb-4">Welcome, <?php echo htmlspecialchars($userName); ?>!</h2>
      <p class="text-gray-600">This is your personal dashboard where you can manage your collaborations and projects.</p>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
      <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-xl font-bold mb-3">My Projects</h3>
        <p class="text-gray-600">View and manage your active projects</p>
        <button class="mt-4 bg-brand-green text-black px-4 py-2 rounded hover:bg-lime-400">View Projects</button>
      </div>

      <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-xl font-bold mb-3">Find Collaborators</h3>
        <p class="text-gray-600">Connect with students for group projects</p>
        <button class="mt-4 bg-brand-green text-black px-4 py-2 rounded hover:bg-lime-400">Find Students</button>
      </div>

      <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-xl font-bold mb-3">Help Requests</h3>
        <p class="text-gray-600">View and respond to help requests</p>
        <button class="mt-4 bg-brand-green text-black px-4 py-2 rounded hover:bg-lime-400">View Requests</button>
      </div>

      <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-xl font-bold mb-3">My Profile</h3>
        <p class="text-gray-600">Update your profile and preferences</p>
        <button class="mt-4 bg-brand-green text-black px-4 py-2 rounded hover:bg-lime-400">Edit Profile</button>
      </div>
    </div>
  </div>
</div>
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>
