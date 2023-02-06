<div>
    <form class="card-grid" method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
        <label class="label label-required" for="form_email">
            Email
        </label>

        <input autocomplete="email" type="email" name="form_email" id="form_email" required label="Email">

        <button type="submit" name="submit" id="submit">
            Subscribe
        </button>
    </form>
</div>
