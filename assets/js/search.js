document.addEventListener("DOMContentLoaded", () => {

    // --- STUDENTS SEARCH ---
    const studentInput = document.getElementById("studentSearch");
    const studentTable = document.getElementById("studentTable");
    if (studentInput && studentTable) {
        studentInput.addEventListener("keyup", () => {
            fetch("../ajax/search_students.php?q=" + encodeURIComponent(studentInput.value))
                .then(res => res.text())
                .then(html => studentTable.innerHTML = html)
                .catch(err => console.error("Students search error:", err));
        });
    }

    // --- COURSES SEARCH ---
    const courseInput = document.getElementById("courseSearch");
    const courseTable = document.getElementById("courseTable");
    if (courseInput && courseTable) {
        courseInput.addEventListener("keyup", () => {
            fetch("../ajax/search_courses.php?q=" + encodeURIComponent(courseInput.value))
                .then(res => res.text())
                .then(html => courseTable.innerHTML = html)
                .catch(err => console.error("Courses search error:", err));
        });
    }

    // --- INSTRUCTORS SEARCH ---
    const instructorInput = document.getElementById("instructorSearch");
    const instructorTable = document.getElementById("instructorTable");
    if (instructorInput && instructorTable) {
        instructorInput.addEventListener("keyup", () => {
            fetch("../ajax/search_instructors.php?q=" + encodeURIComponent(instructorInput.value))
                .then(res => res.text())
                .then(html => instructorTable.innerHTML = html)
                .catch(err => console.error("Instructors search error:", err));
        });
    }

});
