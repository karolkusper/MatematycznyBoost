document.addEventListener("DOMContentLoaded", function () {
    const search = document.getElementById("search");
    const tasksContainer = document.querySelector(".tasks");
    const allTasks = Array.from(document.querySelectorAll('.task'));
    let timeoutId;

    search.addEventListener("input", function () {
        const searchValue = this.value.toLowerCase();

        // Zastosuj opóźnienie przed filtrowaniem
        clearTimeout(timeoutId);
        timeoutId = setTimeout(function () {
            // Wyświetl tylko pasujące zadania
            tasksContainer.innerHTML = "";

            if (searchValue === "") {
                // Jeśli fraza jest pusta, wyświetl wszystkie zadania
                allTasks.forEach(task => {
                    tasksContainer.appendChild(task.cloneNode(true));
                });
            } else {
                // Jeśli fraza nie jest pusta, wyświetl tylko pasujące zadania
                const matchingTasks = allTasks.filter(task => {
                    const title = task.getAttribute('data-title').toLowerCase();
                    const description = task.getAttribute('data-description').toLowerCase();
                    return title.includes(searchValue) || description.includes(searchValue);
                });

                matchingTasks.forEach(task => {
                    tasksContainer.appendChild(task.cloneNode(true));
                });
            }
        }, 500); // Opóźnienie 500 milisekund (0.5 sekundy)
    });
});
