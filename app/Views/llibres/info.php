<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/info.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">
    <title><?php echo $llibre['titol']; ?> - Mi Biblioteca</title>
</head>
<body>
    <h1><?php echo $llibre['titol']; ?></h1>
    
    <div class="book-info">
        <img src="<?php echo $llibre['imagen']; ?>" alt="<?php echo $llibre['titol']; ?>" class="book-image">
        
        <div class="book-details">
            <p><strong>Autor:</strong> <?php echo $llibre['autor']; ?></p>
            <p><strong>ISBN:</strong> <?php echo $llibre['ISBN']; ?></p>
            <p><strong>Estado:</strong> <?php echo $llibre['estat'] ? '<span class="status-read">Leído</span>' : '<span class="status-unread">No leído</span>'; ?></p>
            <p><strong>Comprado:</strong> <?php echo $llibre['comprat'] ? 'Sí' : 'No'; ?></p>
            <p><strong>Sinopsis:</strong> <?php echo nl2br($llibre['sinopsis']); ?></p>
            
            <a href="/" class="back-button">← Volver a la biblioteca</a>
        </div>
    </div>
</body>
</html>
