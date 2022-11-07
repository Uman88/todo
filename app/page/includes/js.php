<!-- Modal Window -->
<div class="modal">
    <div class="modal-content">
        <form action="/index.php?route=task" method="post">
            <div class="modal-header">
                <input type="text" name="task" id="task-input" class="content-input"
                       placeholder="Купить молоко или хлеб" required="required"/>
            </div>
            <div class="ghost-div"></div>
            <div class="modal-footer">
                <a href="#" id="close-button" class="btn btn-close">Отмена</a>
                <button type="submit" id="btn-disable" class="btn add-task-disabled" disabled>
                    Добавить задачу
                </button>
            </div>
        </form>
    </div>
</div>
<!--  End of Modal Window -->

<!-- JS Import -->
<!--<script src="assets/js/jquery-3.6.1.min.js"></script>-->
<script src="assets/js/jquery-2.2.4.js"></script>
<script src="assets/js/jquery-ui.js"></script>
<script src="assets/js/main.js"></script>
<!-- End of JS Import -->