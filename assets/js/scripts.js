const burgerMenu = document.querySelector('#burger-menu');
const sidebar = document.querySelector('#sidebar');
const offsetTaskList = document.querySelector('.task-list');
const userMenu = document.querySelector('#user-menu');
const userSettings = document.querySelector('.user-settings');
const addTask = document.querySelector('#add_task');
const taskForm = document.querySelector('#task-form');

// Toggle sidebar
burgerMenu.addEventListener('click', function () {
    if(window.innerWidth <= 992){
        sidebar.classList.toggle('open-sidebar');
    }else {
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



    taskForm.classList.remove('hidden-task-form')
});