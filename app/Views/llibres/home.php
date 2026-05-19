<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">
    <title>Mi Biblioteca - Colección Personal</title>
</head>

<body>
    <header class="header">
        <div class="header-content">
            <div class="logo">
                <span class="logo-icon">📚</span>
                <h1 class="logo-text">Mi Biblioteca</h1>
            </div>

            <nav class="nav">
                <div class="add_book">

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>
                    <a href="/add_by_ISBN" class="add_book_link">Añadir Libro</a>
                </div>
                <div class="search-container">
                    <form action="/search" method="GET" class="search-form">
                        <input type="text" name="search" placeholder="Buscar libros...">
                        <button type="submit" class="search-btn">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.35-4.35"></path>
                            </svg>
                            <!-- TODO - Acabar de veure com i on ficar un filtre per any -->
                            <select name="year" class="search-year">
                                <option value=""> Filtrar por año</option>
                                <?php

                                ?>
                            </select>
                    </form>
                    <!-- <input type="text" class="search-input" placeholder="Buscar libros...">
                    <button type="submit" class="search-btn">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                    </button> -->
                </div>

                <a href="/admin" class="nav-link">Administrar Libros</a>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h2 class="hero-title">Bienvenido a tu Biblioteca Personal</h2>
            <p class="hero-subtitle">Explora tu colección de libros y descubre nuevas historias</p>
        </div>
    </section>

    <main class="main-content">
        <div class="section-header">
            <h2 class="section-title">Libros Leídos</h2>
            <div class="section-divider"></div>
        </div>

        <div class="books-grid">
            <?php foreach ($llibres as $llibre): ?>
                <a href="/llibre/<?php echo urlencode($llibre['titol']); ?>" class="book-card">
                    <div class="book-image-container">
                        <img src="<?php echo $llibre['imagen']; ?>" alt="<?php echo $llibre['titol']; ?>" class="book-image">
                        <div class="book-overlay">
                            <span class="view-details">Ver detalles</span>
                        </div>
                    </div>
                    <div class="book-info">
                        <h3 class="book-title"><?php echo $llibre['titol']; ?></h3>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </main>

    <footer class="footer">
        <p>&copy; 2025 Mi Biblioteca Personal. Todos los derechos reservados.</p>
    </footer>
</body>

</html>