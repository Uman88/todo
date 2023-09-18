const xhr = new XMLHttpRequest();
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
const btnEdit = document.querySelectorAll('#edit');
const btnDelete = document.querySelectorAll('#btn-delete');
const taskText = document.querySelectorAll('#task-text');
const tasks = document.querySelectorAll('.task');
const sortableList = document.querySelector('.sortable-list');
const items = document.querySelectorAll('.item');
const checkboxTasks = document.querySelectorAll('.checkbox-task');
const textInput = document.querySelectorAll('.text');
const dropTitleCat = document.querySelector('.drop-title-cat');
const dropDownList = document.querySelector('#dropdownListCat');
const dropItems = document.querySelectorAll('#drop-item');
const dropTitlePrio = document.querySelector('.drop-title-prio');
const dropDownListPrio = document.querySelector('#dropdownListPrio');
const dropItemsPrio = document.querySelectorAll('#drop-item-prio');
const circles = document.querySelectorAll('.circle');

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
                    let data = "value=" + task.value + '&id=' + task.dataset.id
                    xhr.open("POST", "handler.php");
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.send(data);
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
                    let data = "deltask=" + del.dataset.id;
                    xhr.open("POST", "handler.php");
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.send(data);
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

    let data = "arrid=" + sortedIds;
    xhr.open("POST", "handler.php");
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send(data);
}

sortableList.addEventListener('dragover', initSortableList);
sortableList.addEventListener('dragenter', e => e.preventDefault())

// Click by checkbox or click uncheck. Also remove crossed out task
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

                                    let data = "removeCrossedOut=" + 1 + "&id=" + checkboxTask.id;
                                    xhr.open("POST", "handler.php");
                                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                                    xhr.send(data);
                                } else if (circle.classList[2] == 'circle-gray') {
                                    circle.classList.remove('circle-gray');
                                    checkboxTask.removeAttribute('checked');
                                    text.classList.remove('text-line-through');

                                    let data = "removeCrossedOut=" + 0 + "&id=" + checkboxTask.id;
                                    xhr.open("POST", "handler.php");
                                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                                    xhr.send(data);
                                }
                            }
                        }
                    }
                });
            });
        });
    });
});

// Dropdown lists for category
dropTitleCat.addEventListener('click', function () {
    dropDownList.classList.toggle('show-list-cat');
    dropDownList.classList.remove('close-list-cat');

    dropItems.forEach(function (dropItem) {
        dropItem.addEventListener('click', e => {
            dropTitleCat.dataset.id = dropItem.dataset.id;
            dropTitleCat.innerHTML = e.target.innerHTML;
            dropDownList.classList.add('close-list-cat');
            dropDownList.classList.remove('show-list-cat');
        });
    });
});

// Dropdown lists for priority
dropTitlePrio.addEventListener('click', function () {
    dropDownListPrio.classList.toggle('show-list-prio');
    dropDownListPrio.classList.remove('close-list-prio');

    dropItemsPrio.forEach(function (dropItem) {
        dropItem.addEventListener('click', e => {
            dropTitlePrio.dataset.id = dropItem.dataset.id;
            if (dropItem.dataset.id == 1) {
                dropTitlePrio.innerHTML = `<span class="wrapper-circle dropdown-circle-red"></span>
                    <span class="dropdown-content-title">${e.target.innerHTML}</span>`;
            } else if (dropItem.dataset.id == 2) {
                dropTitlePrio.innerHTML = `<span class="wrapper-circle dropdown-circle-blue"></span>
                    <span class="dropdown-content-title">${e.target.innerHTML}</span>`;
            } else if (dropItem.dataset.id == 3) {
                dropTitlePrio.innerHTML = `<span class="wrapper-circle dropdown-circle-yellow"></span> 
                    <span class="dropdown-content-title">${e.target.innerHTML}</span>`;
            }

            dropDownListPrio.classList.add('close-list-prio');
            dropDownListPrio.classList.remove('show-list-prio');
        });
    });
});

// Task form
taskForm.addEventListener('submit', () => {
    let resultCat = dropTitleCat.dataset.id ? dropTitleCat.dataset.id : 2;
    let resultPrio = dropTitlePrio.dataset.id ? dropTitlePrio.dataset.id : 1;
    let url = "todo.php";
    let data = 'title=' + taskInputField.value + '&category=' + resultCat + '&priority=' + resultPrio;
    xhr.open("POST", url);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send(data);
});