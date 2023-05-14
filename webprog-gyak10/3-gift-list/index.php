<?php
include_once('memberstorage.php');
include_once('ideastorage.php');
# Task a
$ms = new MemberStorage();
$is = new IdeaStorage();

$members = $ms->findAll();

if (count($_POST) > 0) {
  $name = $_POST["name"];
  $member = [
    "name" => $name,
  ];
  $ms->add($member);
  header("Location: index.php");
  exit();
}
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
  <h2>My family members</h2>
  <form action="" method="post">
    Name: <input type="text" name="name" required>
    <button type="submit">Add</button>
  </form>
  <ul>
    <?php foreach($members as $member) : ?>
      <li>
        <!-- Task b -->
        <a href="member.php?id=<?= $member['id'] ?>">
          <?= $member['name'] ?>
        </a>
        <!-- Task h -->
        (
          <?=
            count($is->findAll(['member_id' => $member['id'], 'active' => true, 'ready' => true]))
          ?> /
          <?=
            count($is->findAll(['member_id' => $member['id'], 'active' => true]))
          ?>
        )
      </li>
    <?php endforeach ?>
  </ul>
</body>
</html>