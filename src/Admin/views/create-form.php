<?php /** @var array{uuid: string, name: string} $emailLists */ ?>

<section class="flex-grow min-w-0 flex flex-col">
    <div class="flex-none flex">
        <h1 class="mt-1 markup-h1 truncate text-xl font-bold">Create Form</h1>
    </div>

    <div>
        <label for="title">Title</label>
        <input type="text" name="title" size="30" value="" id="title" spellcheck="true" autocomplete="off">
    </div>

    <label for="email-list">Choose a list</label>
    <select name="email-list" id="email-list">

    <?php
    foreach ($emailLists as $list) {
        echo "<option value='{$list['uuid']}'>{$list['name']}</option>";
    }
?>

    <textarea cols="100" rows="24" class="large-text code" data-config-field="form.body">
    </textarea>

    <a href="">
        <button type="submit" name="submit" id="submit" class="primary-button mt-1">
            Save
        </button>
    </a>
</section>
