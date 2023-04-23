<?php
    print_r($_POST);

    function validate($input, &$errors) {
        if (filter_var($input['bool'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) === NULL) {
            $errors[] = 'bool is not boolean';
        }

        if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Incorrect e-mail address!';
        }

        if (!filter_var($input['email'], FILTER_VALIDATE_REGEXP, [
                "options" => [
                        "regexp" => "/^a(.+)/"
                ]
        ])) {
            $errors[] = 'The e-mail address MUST start with an \'a\'.';
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

    <input type="text" name="email" value="<?= $_POST && $_POST['email'] ? $_POST['email'] : '' ?>" />
    <button type="submit">Validate</button>
</form>

<?php
    if ($errors) :
        foreach ($errors as $error) : ?>
            <div style="color: red"><?= $error ?></div>
        <?php endforeach; ?>
    <?php elseif (!empty($_POST)): ?>
        <div style="color: green">The form is valid!</div>
    <?php endif; ?>
