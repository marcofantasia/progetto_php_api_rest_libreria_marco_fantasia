
function displayBooks(libri) {
    const tableBody = document.getElementById("book5-table");
    tableBody.innerHTML = ""; 

    
    libri.forEach(function (libro) {
        const dataScadenza = new Date(libro.scadenza);
        const oggi = new Date();
        oggi.setDate(oggi.getDate() + 5); 

        
        if (dataScadenza <= oggi) {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${libro.id}</td>
                <td>${libro.titolo}</td>
                <td>${libro.autore}</td>
                <td>${libro.anno_pubblicazione}</td>
                <td style="color: red;">${libro.scadenza}</td>
                <td>
                    <button class="update-button" data-book-id="${libro.id}">Modifica</button>
                    <button class="delete-button" data-book-id="${libro.id}">Elimina</button>
                </td>
            `;

            tableBody.appendChild(row);
        }
    });
}


fetchBooks();
