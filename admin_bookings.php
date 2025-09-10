<?php

session_start();
include "connect.php";

$result = $conn->query("SELECT * FROM bookings ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - View Bookings</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen">
 
  <header class="bg-gray-800 shadow-md p-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-teal-400"> Bookings Dashboard</h1>
    <a href="logout.php" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white">Logout</a>
  </header>

 
  <main class="max-w-6xl mx-auto p-6">
    <div class="bg-gray-800 shadow-lg rounded-lg overflow-hidden">
      <table class="min-w-full text-sm text-left">
        <thead class="bg-teal-600 text-white">
          <tr>
            <th class="px-4 py-3">ID</th>
            <th class="px-4 py-3">Full Name</th>
            <th class="px-4 py-3">Email</th>
            <th class="px-4 py-3">Service</th>
            <th class="px-4 py-3">Date</th>
            <th class="px-4 py-3">Time</th>
            <th class="px-4 py-3">Created At</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr class="border-b border-gray-700 hover:bg-gray-700 transition">
              <td class="px-4 py-2"><?= htmlspecialchars($row['id']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['fullname']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['email']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['service']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['date']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['time']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['created_at']) ?></td>
            </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan="7" class="px-4 py-4 text-center text-gray-400">No bookings found</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </main>
</body>
</html>
