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
const sortableList = document.querySelector('.sortable-list');
const items = document.querySelectorAll('.item');
const checkboxTasks = document.querySelectorAll('.checkbox-task');
const textInput = document.querySelectorAll('.text');


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
let save = '<span class="material-symbols-outlined">save</span>';
let edit = '<span class="material-symbols-outlined">edit</span>';
btnEdit.forEach(function (editBtn) {
    editBtn.addEventListener('click', () => {
        taskText.forEach(function (task) {
            if (task.dataset.id == editBtn.dataset.id) {
                if (editBtn.innerText.toLowerCase() == 'edit') {
                    editBtn.innerHTML = save;
                    task.removeAttribute('readonly');
                    task.focus();
                    task.selectionStart = task.value.length
                } else {
                    editBtn.innerHTML = edit;
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

// Sort tasks
items.forEach(item => {
    item.addEventListener('dragstart', () => {
        // Добавление класса перетаскивания к элементу после задержки
        setTimeout(() => item.classList.add('dragging'), 0);
    });
    // Удаление класса перетаскивания из элемента в событии dragend
    item.addEventListener('dragend', () => item.classList.remove('dragging'));
});

const initSortableList = (e) => {
    e.preventDefault();
    const draggingItem = sortableList.querySelector('.dragging');

    // Получение всех элементов, кроме текущего перетаскивания и создания массива из них
    const siblings = [...sortableList.querySelectorAll('.item:not(.dragging)')];

    // Поиск родственного элемента, после которого следует разместить
    let nextSibling = siblings.find(sibling => {
        return e.clientY <= sibling.offsetTop + sibling.offsetHeight / 2;
    });

    // Вставка перетаскиваемого элемента перед найденным родственным элементом
    sortableList.insertBefore(draggingItem, nextSibling);

    // Делаю всем дочерним элементам массивоподобным
    const elements = document.getElementsByClassName("item");

    // Создаю массив, также присваиваю ключ => значение
    const sortedIds = Array.from(elements).map(element => element.dataset.id);

    let url = "handler.php?arrid=" + sortedIds;
    xhttp.open("GET", url, true);
    xhttp.setRequestHeader('Content-Type', 'application/text/plain')
    xhttp.send();
}

sortableList.addEventListener('dragover', initSortableList);
sortableList.addEventListener('dragenter', e => e.preventDefault())

// Click by checkbox or click uncheck. Also remove crossed out task
const circles = document.querySelectorAll('.circle');
checkboxTasks.forEach(function (checkboxTask) {
    checkboxTask.addEventListener('click', () => {
        textInput.forEach(function (text) {
            circles.forEach(function (circle) {
                items.forEach(function (item) {
                    if (checkboxTask.id == text.dataset.id && checkboxTask.id == circle.dataset.id) {
                        if (circle.classList[1] != 'circle-gray') {
                            if (item.dataset.id == checkboxTask.id) {
                                if (circle.classList[2] != 'circle-gray') {
                                    checkboxTask.setAttribute('checked', '');
                                    circle.classList.add('circle-gray');
                                    text.classList.add('text-line-through');
                                    let url = "handler.php?crossedOut=" + 1 + "&id=" + checkboxTask.id;
                                    xhttp.open("GET", url, true);
                                    xhttp.setRequestHeader('Content-Type', 'application/text/plain')
                                    xhttp.send();
                                } else if (circle.classList[2] == 'circle-gray') {
                                    circle.classList.remove('circle-gray');
                                    checkboxTask.removeAttribute('checked');
                                    text.classList.remove('text-line-through');
                                    let url = "handler.php?removeCrossedOut=" + 0 + "&id=" + checkboxTask.id;
                                    xhttp.open("GET", url, true);
                                    xhttp.setRequestHeader('Content-Type', 'application/text/plain')
                                    xhttp.send();
                                }
                            }
                        }
                    }
                });
            });
        });
    });
});