<?
	@extract($_GET); 
   @extract($_POST); 
   @extract($_SESSION); 

   session_start();

   include "../lib/dbconn.php";

   $sql = "delete from greet where num = $num";
   mysql_query($sql, $connect);

   mysql_close();

   echo "
	   <script>
      location.href = 'list.php?page=$page&scale=$scale';
	   </script>
	";
?>

