<?php
    print_r($_POST);

    function validate($input, &$errors) {
        if (filter_var($input['bool'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) === NULL) {
            $errors['bool'] = 'bool is not boolean';
        }

        if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email_format'] = 'Incorrect e-mail address!';
        }

        if (!filter_var($input['email'], FILTER_VALIDATE_REGEXP, [
                "options" => [
                        "regexp" => "/^a(.+)/"
                ]
        ])) {
            $errors['email_pattern'] = 'The e-mail address MUST start with an \'a\'.';
        }

        return !(bool)$errors;
    }

    $errors = [];
    if (!empty($_POST)) {
        validate($_POST, $errors);
    }
?>

<form method="post" action="validation.php">
    <input type="radio" name="bool" value="true" <?= $_POST && $_POST['bool'] == "true" ? 'checked' : '' ?> /> True
    <input type="radio" name="bool" value="false" <?= $_POST && $_POST['bool'] == "false" ? 'checked' : '' ?> /> False
    <input type="radio" name="bool" value="other" <?= $_POST && $_POST['bool'] == "other" ? 'checked' : '' ?> /> Other
    <?php if (isset($errors['bool'])): ?>
        <div style="color: red">
            <?= $errors['bool'] ?>
        </div>
    <?php endif; ?>

    <input type="text" name="email" value="<?= $_POST && $_POST['email'] ? $_POST['email'] : '' ?>" />
    <?php if (isset($errors['email_format'])): ?>
        <div style="color: red">
            <?= $errors['email_format'] ?>
        </div>
    <?php endif; ?>
    <?php if (isset($errors['email_pattern'])): ?>
        <div style="color: red">
            <?= $errors['email_pattern'] ?>
        </div>
    <?php endif; ?>


    <button type="submit">Validate</button>
</form>

