<?php
/** @var \Spatie\WordPressMailcoach\Admin\ViewModel\CreateOrUpdateFormViewModel $view */
?>

<form
    method="POST"
    id="mailcoach-delete-form"
    action="<?php echo esc_url(admin_url('admin-post.php')); ?>"
>
    <input type="hidden" name="action" value="delete_form">
    <?php wp_nonce_field('delete_form', 'mailcoach_delete_form_nonce'); ?>

    <input type="hidden" name="shortcode" value=<?php echo esc_html($view->form?->shortcode ?? ''); ?>>

    <a class="menu-delete" style="color: #b32d2e; display: inline-block; margin-top: 5px; margin-left: auto;" href="#" onclick="clicked()">Delete</a>
</form>

<script>
    function clicked() {
        if (confirm('Are you sure?')) {
            document.getElementById("mailcoach-delete-form").submit();
        } else {
            return false;
        }
    }
</script>
