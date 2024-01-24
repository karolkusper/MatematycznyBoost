document.addEventListener('DOMContentLoaded', function () {
    // Ukryj formularz na początku
    const editProfileForm = document.getElementById('editProfileForm');

    // Ukryj formularz na początku
    editProfileForm.style.display = 'none';

    document.getElementById('changeProfilePictureForm').style.display = 'none';

    // Obsługa naciśnięcia przycisku "Zmień dane profilu"
    document.getElementById('changeProfileData').addEventListener('click', function () {
        // Pokaż formularz po naciśnięciu przycisku
        editProfileForm.style.display = 'flex';
    });

    document.getElementById('changeProfilePicture').addEventListener('click', function () {
        // Pokaż formularz po naciśnięciu przycisku
        document.getElementById('changeProfilePictureForm').style.display = 'flex';
    });

// Dodaj obsługę zdarzeń dla przycisku "Anuluj" w formularzu zmiany zdjęcia
    document.getElementById('cancelChangePicture').addEventListener('click', function () {
        // Schowaj formularz po naciśnięciu przycisku "Anuluj"
        document.getElementById('changeProfilePictureForm').style.display = 'none';
    });


    // Obsługa naciśnięcia przycisku "Zapisz zmiany"
    document.getElementById('saveChanges').addEventListener('click', alterProfile);

    // Obsługa naciśnięcia przycisku "Anuluj"
    document.getElementById('cancelEdit').addEventListener('click', cancelEdit)

    // Funkcja do wczytywania danych użytkownika do kontenera


});

function loadUserData(username, email) {
    // Pobierz dane z diva o klasie "content"
    const photoPath = document.querySelector('.profilePic').src;

    // Aktualizuj tytuł
    const title = document.getElementById('title');
    title.innerHTML = `Witaj ${username}! Oto Twój profil:`;

    // Aktualizuj kontener z danymi użytkownika
    const userDataContainer = document.querySelector('.content');
    userDataContainer.innerHTML = `
        <img class="profilePic" src="${photoPath}" alt="zdj profilowe"/>
        <div class="user_data">
            <h2>Username: ${username}</h2>
            <h2>Email: ${email}</h2>
        </div>
    `;
}

function updateSession(newUsername, newEmail) {
    // Wysyłaj zapytanie do serwera w celu zaktualizowania sesji
    fetch('/updateSession', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({newUsername, newEmail}),
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                console.log('Sesja użytkownika zaktualizowana.');
            } else {
                console.error('Nie udało się zaktualizować sesji użytkownika.');
            }
        })
        .catch(error => {
            console.error('Błąd:', error);
        });
}


function alterProfile() {
    const editProfileForm = document.getElementById('editProfileForm');
    // Sprawdź, czy formularz jest widoczny
    if (editProfileForm.style.display === 'flex') {
        // Pobierz dane z formularza
        const username = document.getElementById('editUsername').value;
        const email = document.getElementById('editEmail').value;
        const password = document.getElementById('editPassword').value;
        const resultContainer = document.getElementById('resultContainer');

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
                    resultContainer.innerHTML = '<h2>Edycja danych zakończona sukcesem!</h2>';

                    // Wyczyść pola formularza po sukcesie
                    document.getElementById('editUsername').value = '';
                    document.getElementById('editEmail').value = '';
                    document.getElementById('editPassword').value = '';

                    // Schowaj ponownie formularz
                    editProfileForm.style.display = 'none';

                    // Przeładuj dane na stronie, aby pokazać zaktualizowane dane
                    // Możesz użyć odpowiednich funkcji do wczytania i wyświetlenia danych na nowo

                    // Po zaktualizowaniu danych, wczytaj ponownie dane użytkownika
                    loadUserData(username, email);

                    // Zaktualizuj sesję użytkownika
                    updateSession(username, email);
                } else {
                    // Wstrzyknij tag <h2> z informacją o błędzie
                    resultContainer.innerHTML = '<h2>Edycja danych nie powiodła się. Spróbuj ponownie.</h2>';
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }
}

function cancelEdit() {
    const editProfileForm = document.getElementById('editProfileForm');
    // Schowaj formularz po naciśnięciu przycisku "Anuluj"
    editProfileForm.style.display = 'none';
}

function changeProfilePicture() {
    // Pobierz dane z formularza
    const fileInput = document.getElementById('profilePicture');
    const resultContainer = document.getElementById('resultContainer');
    const file = fileInput.files[0];

    // Utwórz obiekt FormData i dodaj plik
    const formData = new FormData();
    formData.append('file', file);


    // Wyślij żądanie AJAX za pomocą Fetch API
    fetch('/changeProfilePicture', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        },
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            // Handle success or failure based on the data received
            // Schowaj formularz po pomyślnym zmienieniu zdjęcia
            document.getElementById('changeProfilePictureForm').style.display = 'none';
            resultContainer.innerHTML = '<h2>Zaktualizowano zdjęcie. Odśwież stronę aby zobaczyć rezultat.</h2>';
        })
        .catch(error => {
            console.error('Error:', error);
            resultContainer.innerHTML = '<h2>Zmiana zdjęcia nie udała się (zły format lub za duży plik). Spróbuj ponownie.</h2>';
        });
}
