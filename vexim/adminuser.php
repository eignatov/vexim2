<?
  include_once dirname(__FILE__) . "/config/variables.php";
  include_once dirname(__FILE__) . "/config/authpostmaster.php";
?>
<html>
  <head>
    <title>Virtual Exim: Manage Users</title>
    <link rel="stylesheet" href="style.css" type="text/css">
  </head>
  <body>  
    <? include dirname(__FILE__) . "/config/header.php"; ?>
    <div id="Menu">
      <a href="adminuseradd.php">Add User</a><br>
      <a href="admin.php">Main Menu</a><br>
      <br><a href="logout.php">Logout</a><br>
    </div>
    <div id="Content">
      <table align="center">
	<tr><th>&nbsp;</th><th>User</th><th>Email address</th><th>Admin</th></tr>
	<?
	  $query = "SELECT localpart,realname,admin,enabled FROM users
			WHERE domain_id='" .$_COOKIE[vexim][2]. "' AND (type='local' OR type='piped')
			ORDER BY realname";
	  $result = $db->query($query);
	  while ($row = $result->fetchRow()) {
	    print "\t<tr>";
	    print "<td class='trash'><a href=\"adminuserdelete.php?localpart=" . $row[localpart] . "\">";
	    print "<img style='border:0;width:10px;height:16px' title='Delete " . $row[realname] . "' src='images/trashcan.gif' alt='trashcan'></a></td>\n";
	    print "\t<td><a href=\"adminuserchange.php?localpart=" . $row[localpart] . "\" title='Click to modify " . $row[realname] . "'>" . $row[realname] . "</a></td>\n";
	    print "\t<td>" . $row[localpart] . "@" . $_COOKIE[vexim][1] . "</td>\n";
	    print "\t<td class='check'>";
	    if ($row[admin] == 1) print "<img style='border:0;width:13px;height:12px' src='images/check.gif' title='" . $row[realname] . " is an administrator'>";
	    print "</td></tr>\n";
	  }
	?>
      </table>
      </div>
      <?
	include "status.php";
      ?>
  </body>
</html>
<!-- Layout and CSS tricks obtained from http://www.bluerobot.com/web/layouts/ -->