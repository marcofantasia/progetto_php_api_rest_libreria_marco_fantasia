document.addEventListener("DOMContentLoaded", function () {
    
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

    
    function displayBooks(libri) {
        const tableBody = document.getElementById("book-table");
        tableBody.innerHTML = ""; 

        
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

   
    fetchBooks();
});
