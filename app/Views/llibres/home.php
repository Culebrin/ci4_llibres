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
                    <!-- <a href="/add_by_ISBN" class="add_book_link">Añadir Libro</a> -->
                    <!-- Poner un boton que me abra un popup donde me pida el ISBN,
                        una vez lo ponga, con JS verificar en local el regex del input
                        y luego mandar la petición a la API de open library -->
                    <!-- <button onclick="openPopup()">Añadir Libro</button> -->
                    <input type="text" id="isbn" placeholder="Introduce el ISBN">
                    <button id="buscar">Buscar</button>
                    <div id="pre-preview"></div>

                </div>
                <div class="search-container">
                    <form action="/search" method="GET" class="search-form">
                        <input type="text" name="search" placeholder="Buscar libros...">
                        <button type="submit" class="search-btn">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.35-4.35"></path>
                            </svg>
                        </button>
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

    <div id="popup-preview" class="modal" style="display: none;">
        <div class="modal-content">
            <span id="close-popup" class="close-btn">&times;</span>

            <div id="estado"></div>

            <div id="info-libro" style="display: none;">
                <img id="portada" src="" alt="Portada del libro">
                <h3 id="titulo"></h3>
                <p id="autor"></p>

                <button id="guardar-libro">Guardar en Biblioteca</button>
            </div>
        </div>
    </div>

    <script>
        const ISBN = document.getElementById("isbn");
        const button = document.getElementById("buscar");

        const portada = document.getElementById("portada");
        const titulo = document.getElementById("titulo");
        const autor = document.getElementById("autor");

        const preview = document.getElementById("popup-preview");
        const estado = document.getElementById("estado");
        const prePreview = document.getElementById("pre-preview");
        const infoLibro = document.getElementById("info-libro");

        const saveBook = document.getElementById("guardar-libro");

        button.addEventListener("click", async function() {
            prePreview.innerHTML = "";      // Para no mostrar mensajes de error anteriores
            estado.innerHTML = "";
            // const response = await
            // let urlISBN = url + ISBN.value;  
            // estado.textContent = "Buscando...";
            let urlISBN = "https://openlibrary.org/api/books?bibkeys=ISBN:" + ISBN.value + "&format=json&jscmd=data";

            const respuesta = await fetch(urlISBN);
            // estado.textContent = "Buscando..."
            const datos = await respuesta.json();

            const claveLibro = "ISBN:" + ISBN.value;
            if (!datos[claveLibro]) {
                prePreview.innerHTML = `<p style="color: red;">No se ha encontrado el libro </p>`;
            } else {
                // estado.innerHTML = `<p>Titulo: ${datos[claveLibro].title}</p> <p> Autor: ${datos[claveLibro].authors[0].name} </p>`;
                console.log(claveLibro);
                titulo.textContent = datos[claveLibro].title;
                console.log(datos[claveLibro].title)
                autor.textContent = datos[claveLibro].authors[0].name;
                console.log(datos[claveLibro].authors[0].name)
                portada.src = datos[claveLibro].cover["medium"];
                preview.style.display = "block";
                infoLibro.style.display = "block";
            }

        })

        saveBook.addEventListener("click", function(){
            try {
                if (!titulo.textContent.trim() || !autor.textContent.trim()) {
                    throw new Error("Error al guardar el libro");
                }else{
                    const libro = {
                        titol: titulo.textContent,
                        autor: autor.textContent,
                        imagen: portada.src,
                        // sinopsis: sinopsis.textContent,  TODO: Terminar de ver como y de donde coger la sinopsis
                        ISBN: ISBN.value,
                        estat: 0,
                        prioritat: 0,
                        comprat: 0,
                        spicy: 0
                    }
                    console.log(libro);
                    alert("Libro guardado correctamente");
                    // fetch("/add_book", {
                    //     method: "POST",
                    //     body: JSON.stringify(libro)
                    // })
                    // .then(response => response.json())
                    // .then(data => {
                    //     console.log(data);
                    // })
                }
            } catch (error) {
                estado.innerHTML = `<p>Error al guardar el libro: ${error.message}</p>`;
            }
        })
    </script>
</body>

</html>