function alterProfile() {
    // Pobierz dane z formularza
    const username = document.getElementById('editUsername').value;
    const email = document.getElementById('editEmail').value;
    const password = document.getElementById('editPassword').value;

    // Sprawdź, czy wszystkie pola są wypełnione
    if (!username || !email || !password) {
        alert('Wszystkie pola formularza są wymagane!');
        return;
    }

    // Utwórz obiekt z danymi do wysłania
    const data = {
        username: username,
        email: email,
        password: password
    };

    // Wywołaj funkcję fetch, aby wysłać dane do backendu
    fetch('/alterProfile', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
        .then(response => response.json())
        .then(data => {
            // Sprawdź, czy operacja zakończyła się sukcesem
            if (data.status === 'success') {
                // Wstrzyknij tag <h2> z informacją o sukcesie
                const resultContainer = document.getElementById('resultContainer');
                resultContainer.innerHTML = '<h2>Edycja danych zakończona sukcesem!</h2>';

                // Wyczyść pola formularza po sukcesie
                document.getElementById('editUsername').value = '';
                document.getElementById('editEmail').value = '';
                document.getElementById('editPassword').value = '';

                // Przeładuj dane na stronie, aby pokazać zaktualizowane dane
                // Możesz użyć odpowiednich funkcji do wczytania i wyświetlenia danych na nowo
            } else {
                // Wstrzyknij tag <h2> z informacją o błędzie
                const resultContainer = document.getElementById('resultContainer');
                resultContainer.innerHTML = '<h2>Edycja danych nie powiodła się. Spróbuj ponownie.</h2>';
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
}
