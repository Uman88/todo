// JavaScript

// Hide/Show Sidebar
const sidebar = document.getElementById('sidebar');
const content = document.getElementById('content');
const burgerBtn = document.getElementById('burger-menu-toggle');

burgerBtn.addEventListener('click', function () {
    sidebar.classList.toggle('close')
    content.classList.toggle('mg-left-content');
})

// Jquery

// Remove task
$(".radioTask").click(function () {
    var val = $(".radioTask:checked").val();
    $.ajax({
        type: "GET",
        url: "",
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
    $("#sortable-tasks").sortable({
        handle: '.ri-list-check',
        cursor: 'move',
        update: function () {
            $.ajax({
                url: "",
                type: "GET",
                data: {order: $('#sortable-tasks').sortable("toArray")},
            });
        }
    });
});