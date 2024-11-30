<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joinformulir</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../css/joinformulir.css">
</head>
<body>
    <div class="form-container">
        <form action="#" method="POST">
          <div class="form-group">
            <label for="full-name">Full name</label>
            <input type="text" id="full-name" name="full-name" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
          </div>
          <div class="form-group">
            <label for="state">County / state</label>
            <input type="text" id="state" name="state" required>
          </div>
          <div class="form-group">
            <label for="telephone">Telephone</label>
            <input type="tel" id="telephone" name="telephone" required>
          </div>
          <div class="form-group">
            <label for="store-name">Store name</label>
            <input type="text" id="store-name" name="store-name" required>
          </div>
          <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" required>
          </div>
          <button type="button" class="submit-btn" onclick="window.location.href='signsucces.html'">Submit</button>

        </form>
    </div>
</body>
</html>