document.addEventListener("DOMContentLoaded", function () {
    // Funzione per caricare i libri nella tabella
    function fetchBooks() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "read.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const libri = JSON.parse(xhr.responseText);
                displayBooks(libri);
            }
        };
        xhr.send();
    }

    // Funzione per visualizzare i libri nella tabella
    function displayBooks(libri) {
        const tableBody = document.getElementById("book-table");
        tableBody.innerHTML = ""; // Pulisce la tabella prima di riempirla con nuovi dati

        // Cicla attraverso i libri e li aggiunge alla tabella
        libri.forEach(function (libro) {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${libro.id}</td>
                <td>${libro.titolo}</td>
                <td>${libro.autore}</td>
                <td>${libro.anno_pubblicazione}</td>
                <td>${libro.scadenza}</td>
                
                <td>
                    <button class="update-button" data-book-id="${libro.id}">Modifica</button>
                    <button class="delete-button" data-book-id="${libro.id}">Elimina</button>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    // Inizialmente, carica i libri nella tabella
    fetchBooks();
});
