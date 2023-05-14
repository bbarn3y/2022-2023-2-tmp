<?php
include_once('memberstorage.php');
include_once('ideastorage.php');
$ms = new MemberStorage();
$is = new IdeaStorage();

$id = $_GET['id'];
$member = $ms->findById($id);

if (count($_POST) > 0) {
  // Task d
  if (isset($_POST['function-add'])) {
    $is->add([
      'idea'      => $_POST['idea'],
      'active'    => true,
      'ready'     => false,
      'comments'  => [],
      'member_id' => $id,
    ]);
    header("Location: member.php?id=${id}");
    exit();
  }
  else if (isset($_POST['add-comment'])) {
    $idea_id = $_POST['idea-id'];
    $idea = $is->findById($idea_id);
    $idea['comments'][] = $_POST['comment'];
    $is->update($idea_id, $idea);
    header("Location: member.php?id=${id}");
    exit();
  }
  // Task g
  else if (isset($_POST['complete'])) {
    $idea_id = $_POST['idea-id'];
    $idea = $is->findById($idea_id);
    $idea['ready'] = true;
    $is->update($idea_id, $idea);
    header("Location: member.php?id=${id}");
    exit();
  }
  else if (isset($_POST['hide'])) {
    $idea_id = $_POST['idea-id'];
    $idea = $is->findById($idea_id);
    $idea['active'] = false;
    $is->update($idea_id, $idea);
    header("Location: member.php?id=${id}");
    exit();
  }
}

$ideas = $is->findAll([
  'member_id' => $id,
  'active'    => true,
]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task 3</title>
  <link rel="stylesheet" href="index.css">
</head>
<body>
  <h1>Task 3: Gift list</h1>
  <a href="index.php">Back to main page</a>
  <!-- Task c -->
  <h2>Ideas for <?= $member['name'] ?></h2>
  <form action="" method="post">
    <fieldset>
      <legend>New idea</legend>
      Idea: <input type="text" name="idea" required>
      <button name="function-add" type="submit">Add new idea</button>
    </fieldset>
  </form>
  <!-- Task e -->
  <?php foreach($ideas as $idea) : ?>
    <details>
      <summary>
        <?= $idea['idea'] ?>
        <?php if ($idea["ready"]) : ?>
          <span>✓</span>
        <?php endif ?>
      </summary>
      <!-- Task f -->
      <form action="" method="post">
        <input type="hidden" name="idea-id" value="<?= $idea["id"] ?>">
        Comment: <input type="text" name="comment" required>
        <button type="submit" name="add-comment">Add comment</button> <br>
      </form>
      <form action="" method="post">
        <input type="hidden" name="idea-id" value="<?= $idea["id"] ?>">
        <button type="submit" name="complete">Complete</button>
        <button type="submit" name="hide">Hide</button>
      </form>
      <ul>
        <?php foreach($idea["comments"] as $comment) : ?>
          <li><?= $comment ?></li>
        <?php endforeach ?>
      </ul>
    </details>
  <?php endforeach ?>

</body>
</html>