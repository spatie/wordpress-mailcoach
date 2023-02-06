<section class="flex-grow min-w-0 flex flex-col">
    <h1 class="">This file is just for demo</h1>
    <div>
        <form class="card-grid" method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
            <fieldset class="card form-grid">
                <div class="form-legend mt-8">
                </div>

                <div class="form-field">
                    <label class="label label-required" for="form_first_name">
                        First Name
                    </label>

                    <input autocomplete="given-name" type="text" name="form_first_name" id="form_first_name" required label="First Name">
                </div>

                <div class="form-field">
                    <label class="label label-required" for="form_email">
                        Email
                    </label>

                    <input autocomplete="email" type="email" name="form_email" id="form_email" required label="Email">
                </div>

                <input type="hidden" name="action" value="process_form">

                <div class="form-field mt-4">
                    <button type="submit" name="submit" id="submit" class="primary-button mt-1">
                        Subscribe
                    </button>
                </div>

            </fieldset>
        </form>
    </div>
</section>
