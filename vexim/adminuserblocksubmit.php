<?
  include_once dirname(__FILE__) . "/config/variables.php";
  include_once dirname(__FILE__) . "/config/authuser.php";
  include_once dirname(__FILE__) . "/config/functions.php";

  if ($_GET[action] == "delete") {
    $query = "DELETE FROM blocklists WHERE block_id={$_GET['block_id']}";
    $result = $db->query($query);
    if (!DB::isError($result)) {
      header ("Location: adminuser.php?updated={$_GET['user_id']}");
      die;
    } else {
      header ("Location: adminuser.php?failed={$_GET['user_id']}");
      die;
    }
  }

# Finally 'the rest' which is handled by the profile form
  if ($_POST[blockval] == "") { header("Location: adminuser.php"); die; }
  $query = "INSERT INTO blocklists (domain_id, user_id, blockhdr, blockval, color) values (
		{$_COOKIE['vexim'][2]},
		{$_POST['user_id']},
		'{$_POST['blockhdr']}',
		'{$_POST['blockval']}',
		'{$_POST['color']}')";
  $result = $db->query($query);
  if (!DB::isError($result)) {
    header ("Location: adminuser.php?updated={$_POST['user_id']}");
    die;
  } else {
    header ("Location: adminuser.php?failed={$_POST['user_id']}");
  }
?>
<!-- Layout and CSS tricks obtained from http://www.bluerobot.com/web/layouts/ -->