<?php
    print_r($_POST);

    // Filters: https://www.php.net/manual/en/filter.filters.validate.php
    function validate($input, &$errors) {
        if (!isset($input['bool']) || filter_var($input['bool'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) === NULL) {
            $errors['bool'] = 'bool is not boolean';
        }

        if (!isset($input['categories']) || count($input['categories']) < 2) {
            $errors['categories'] = 'Choose at least 2 categories!';
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

        return count($errors) == 0;
    }

    $errors = [];
    if (!empty($_POST)) {
        validate($_POST, $errors);
    }
?>

<form method="post" action="validation.php">
    <div>
        <input type="radio" name="bool"
               value="true" <?= $_POST && isset($_POST['bool']) && $_POST['bool'] == "true" ? 'checked' : '' ?> > True
        <input type="radio" name="bool"
               value="false" <?= $_POST && isset($_POST['bool']) && $_POST['bool'] == "false" ? 'checked' : '' ?> > False
        <input type="radio" name="bool"
               value="other" <?= $_POST && isset($_POST['bool']) && $_POST['bool'] == "other" ? 'checked' : '' ?> > Other
        <?php if (isset($errors['bool'])): ?>
            <div style="color: red">
                <?= $errors['bool'] ?>
            </div>
        <?php endif; ?>
    </div>

    <div>
        Choose at least two:
        <input type="checkbox" name="categories[]"
               value="1" <?= $_POST && isset($_POST['categories']) && in_array("1", $_POST['categories']) ? 'checked' : '' ?>> Cat1
        <input type="checkbox" name="categories[]"
               value="2" <?= $_POST && isset($_POST['categories']) && in_array("2", $_POST['categories']) ? 'checked' : '' ?>> Cat2
        <input type="checkbox" name="categories[]"
               value="3" <?= $_POST && isset($_POST['categories']) && in_array("3", $_POST['categories']) ? 'checked' : '' ?>> Cat3
        <?php if (isset($errors['categories'])): ?>
            <div style="color: red">
                <?= $errors['categories'] ?>
            </div>
        <?php endif; ?>
    </div>

    <div>
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
    </div>


    <button type="submit">Validate</button>
</form>

