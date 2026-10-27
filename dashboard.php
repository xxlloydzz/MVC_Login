<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="card">
    <h2>Hai, <?= htmlspecialchars($_SESSION['user']) ?></h2>
    <p class="sub">Kamu berhasil login</p>
    <a class="btn" href="index.php?logout=1">Logout</a>
  </div>
</body>
</html>