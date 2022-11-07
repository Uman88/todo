// JavaScript

const sidebar = document.getElementById('sidebar');
const content = document.getElementById('content');
const burgerBtn = document.getElementById('burger-menu-toggle');
const subMenu = document.getElementById('subMenu');
const modal = document.querySelector(".modal");
const btnTask = document.getElementById("taskBtn");
const closeButton = document.getElementById('close-button')
const taskInput = document.getElementById('task-input');
const btnDisable = document.getElementById('btn-disable');

// Show/Hidden modal
function toggleModal() {
    modal.classList.toggle("show-modal");
}

function windowOnClick(event) {
    if (event.target === modal) {
        toggleModal();
    }
}

btnTask.addEventListener("click", toggleModal);
closeButton.addEventListener("click", toggleModal);
window.addEventListener("click", windowOnClick);

// Close/Open sidebar and offset content left/right
burgerBtn.addEventListener('click', function () {
    sidebar.classList.toggle('close')
    content.classList.toggle('mg-left-content');
})

// Open/Close dropdown profile
function toggleProfile() {
    subMenu.classList.toggle('open-menu')
}

// Enable/Disable a button if empty input
taskInput.addEventListener("input", function () {
    if (taskInput.value !== '') {
        btnDisable.disabled = (this.value === '');
        btnDisable.classList.remove('add-task-disabled');
        btnDisable.classList.add('add-task');
    } else {
        btnDisable.classList.remove('add-task');
        btnDisable.classList.add('add-task-disabled');
    }
})

// Jquery

// Remove task
$(".radioTask").click(function () {
    var val = $(".radioTask:checked").val();
    $.ajax({
        type: "GET",
        url: "/index.php?route=handler",
        data: {val: val},
    });
    // FadeOut task
    $('.task').click(function () {
        $(this).fadeOut(500)
        //$(this).remove();
    });
});

// Sortable Tasks
$(function () {
    $("#sortable").sortable({
        handle: '.ri-list-check',
        cursor: 'move',
        update: function () {
            $.ajax({
                url: "/index.php?route=handler",
                type: "POST",
                data: {order: $('#sortable').sortable("toArray")},
            });
        }
    });
});