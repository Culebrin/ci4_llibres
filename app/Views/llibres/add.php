<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar libro por ISBN</title>
</head>
<body>
    <form action="add_by_ISBN" method="POST">
        <label for="isbn">ISBN:</label>
        <input type="text" id="isbn" name="isbn" required>
        <button type="submit">Agregar libro</button>
    </form>
</body>
</html>