document.querySelectorAll(".grade_tasks").forEach((task) => {
  task.addEventListener("mouseover", () => {
    document.querySelectorAll(".grade_tasks").forEach((otherTask) => {
      otherTask.classList.remove("active");
    });
    task.classList.add("active");
  });

  task.querySelectorAll(".grades li").forEach((grade) => {
    grade.addEventListener("click", () => {
      const isSelected = grade.classList.contains("selected");

      task.querySelectorAll(".grades li").forEach((otherGrade) => {
        otherGrade.classList.remove("selected");
      });

      grade.classList.toggle("selected", !isSelected);

      task
        .querySelectorAll(".grades li:not(.selected)")
        .forEach((otherGrade) => {
          otherGrade.style.display = isSelected ? "block" : "none";
        });

      task.querySelector(".grade h2").textContent = isSelected
        ? "Wystaw ocenę:"
        : "Wystawiono ocenę:";
    });
  });
});
