const burgerMenu = document.querySelector('#burger-menu');
const sidebar = document.querySelector('#sidebar');
const offsetTaskList = document.querySelector('.task-list');
const userMenu = document.querySelector('#user-menu');
const userSettings = document.querySelector('.user-settings');
const addTask = document.querySelector('#add-task');
const taskForm = document.querySelector('#task-form');
const btnCancelTask = document.querySelector('#cancel-task');
const btnNewTask = document.querySelector('#add-new-task');
const taskInputField = document.querySelector('#task-form-input');
const btnEdit = document.querySelectorAll('.edit');
const btnDelete = document.querySelectorAll('.delete');
const taskText = document.querySelectorAll('#task-text');
const xhttp = new XMLHttpRequest();
const tasks = document.querySelectorAll('.task');

let ob = {
    'id': 2
}

// Toggle sidebar
burgerMenu.addEventListener('click', function () {
    if (window.innerWidth <= 992) {
        sidebar.classList.toggle('open-sidebar');
    } else {
        sidebar.classList.toggle('close-sidebar');
        offsetTaskList.classList.toggle('offset-task-list');
    }
});

// Toggle user menu
userMenu.addEventListener('click', function () {
    userSettings.classList.toggle('open-user-menu');
});

// Show task form
addTask.addEventListener('click', function () {
    taskForm.classList.remove('hidden-task-form');
});

// Hide task form, stopping action browser, clear input field for new input
btnCancelTask.addEventListener('click', function (e) {
    e.preventDefault();
    taskForm.classList.add('hidden-task-form');
    taskForm.reset();
});

// When in input field have text, btn active
taskInputField.addEventListener('keyup', () => {
    if (taskInputField.value.trim() === "") {
        btnNewTask.disabled = true;
    } else {
        btnNewTask.disabled = false;
    }
});

// Rename task
btnEdit.forEach(function (edit) {
    edit.addEventListener('click', () => {
        taskText.forEach(function (task) {
            if (task.dataset.id == edit.dataset.id) {
                if (edit.innerText.toLowerCase() == 'редактировать') {
                    edit.innerText = 'Сохранить';
                    task.removeAttribute('readonly');
                    task.focus();
                } else {
                    edit.innerText = 'Редактировать';
                    xhttp.open("GET", "handler.php?value=" + task.value + '&id=' + task.dataset.id, true);
                    xhttp.send();
                    task.setAttribute('readonly', 'readonly');
                }
            }
        });
    });
});

// Delete task
btnDelete.forEach(function (del) {
    del.addEventListener('click', () => {
        tasks.forEach(function (task) {
            task.addEventListener('click', () => {
                if (del.dataset.id == task.dataset.id) {
                    task.classList.add('fade-out');
                    xhttp.open("GET", "handler.php?delid=" + del.dataset.id, true);
                    xhttp.send();
                }
            });
        });
    });
});