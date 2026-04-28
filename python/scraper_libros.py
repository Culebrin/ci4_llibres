import sys

import requests
from bs4 import BeautifulSoup
import time

cabeceras = {
    "user-agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36"
}
# PASO A: Capturar el ISBN que viene desde PHP
def iniciar_scraper():
    # Comprobamos si nos han pasado el ISBN por la terminal
    if len(sys.argv) < 2:
        print("Error: No se ha proporcionado un ISBN.")
        sys.exit(1) # Cerramos el programa con código de error

    # Si llegamos aquí, es que hay un argumento
    isbn = sys.argv[1]
    print(f"Buscando el libro con ISBN: {isbn}")
    
    # Aquí irá el Paso B (la conexión a la web)

    url = f"https://www.casadellibro.com/?query={isbn}"

    try:
        # Intentamos obtener la info
        respuesta = requests.get(url, headers=cabeceras)
        sopa = BeautifulSoup(respuesta.text, 'html.parser')
        # Buscaremos el nombre del libro que sale en la página
        book_name = sopa.find('span', class_='titleProducto').text.strip()
        print(f"Libro encontrado: {book_name}")      
    except Exception as e:
            # Si la web falla o no encuentra el precio, entra aquí
            print(f"⚠️ Error al conectar: {e}. Reintentando...")

if __name__ == "__main__":
    iniciar_scraper()