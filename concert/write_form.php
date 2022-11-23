<? 
	session_start(); 

	/* 새글 쓰기
	$table = 'concert'; 만 넘어옴
	*/

	/* 수정하기
	$table = 'concert';
	$num;
	$mode == 'modify';
	*/

	@extract($_POST);
	@extract($_GET);
	@extract($_SESSION);
	
	include "../lib/dbconn.php";
	
	if(!$scale)
		$scale=10;			// 한 화면에 표시되는 글 수

    if ($mode=="search") //검색
	{
		if(!$search)
		{
			echo("
				<script>
				 window.alert('검색할 단어를 입력해 주세요!');
			     history.go(-1);
				</script>
			");
			exit;
		}

		$sql = "select * from greet where $find like '%$search%' order by num desc";
	}
	else
	{
		$sql = "select * from greet order by num desc";
	}
	if ($mode=="modify")  //수정글쓰기 - 레코드 가져오기
	{
		$sql = "select * from $table where num=$num";
		$result = mysql_query($sql, $connect);

		$row = mysql_fetch_array($result);       
	
		$item_subject     = $row[subject];
		$item_content     = $row[content];

		$item_file_0 = $row[file_name_0];
		$item_file_1 = $row[file_name_1];
		$item_file_2 = $row[file_name_2];

		$copied_file_0 = $row[file_copied_0];
		$copied_file_1 = $row[file_copied_1];
		$copied_file_2 = $row[file_copied_2];
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head> 
<meta charset="utf-8">
<title>PR센터-PR자료실</title>
<link rel="stylesheet" href="../common/css/common.css">
    <link rel="stylesheet" href="../sub4/common/css/sub4common.css">
    <link rel="stylesheet" href="./pr.css">
	<link rel="stylesheet" href="../greet/sub4_content2_1.css">
	<script src="https://kit.fontawesome.com/6c4383a4e3.js" crossorigin="anonymous"></script>
<script>
  function check_input()
   {
      if (!document.board_form.subject.value)
      {
          alert("제목을 입력하세요!");    
          document.board_form.subject.focus();
          return;
      }

      if (!document.board_form.content.value)
      {
          alert("내용을 입력하세요!");    
          document.board_form.content.focus();
          return;
      }
      document.board_form.submit();
   }
</script>
</head>

<body>
<? include "../common/sub_header.html" ?>
<div class="main">
        <img src="../sub4/common/imgaes/main.jpg" alt="메인이미지">
        <h3>PR센터</h3>
    </div>

    <div class="subNav">
        <ul>
			<li class="current"><a href="./concert/list.php">PR자료실</a></li>
            <li ><a href="../greet/list.php">회사소식</a></li>
            <li><a href="../sub4/sub4_3.html">FAQ</a></li>
            <li ><a href="../sub4/sub4_4.html">문의하기</a></li>

        </ul>
    </div>
	<article id="content">
	<div class="titleArea">
            <div class="lineMap">
                <span><i class="fa-solid fa-house"></i></span>&gt; <span>PR센터</span>&gt;
                <strong>PR자료실</strong>
            </div>
            <h2>PR자료실</h2>
			<p>롯데정밀화학 PR자료실 입니다.</p>
        </div>
		<div class="contentArea">

<?
	if($mode=="modify") //수정
	{

?>
		<!-- *enctype 첨부될 파일이 있을 때 꼭 써줘야 함 -->
		<form  name="board_form" method="post" action="insert.php?mode=modify&num=<?=$num?>&page=<?=$page?>&scale=<?=$scale?>&table=<?=$table?>" enctype="multipart/form-data"> 
<?
	}
	else //그냥 글쓰기
	{
?>
		<form  name="board_form" method="post" action="insert.php?table=<?=$table?>&page=<?=$page?>&scale=<?=$scale?>" enctype="multipart/form-data"> 
<?
	}
?>
		<div id="write_form">
			<div class="write_line"></div>
			<div id="write_row1"><div class="col1"> 별명 </div><div class="col2"><?=$usernick?></div>
<?
	if( $userid && ($mode != "modify") ) //로그인되어있고, 새글쓰기 클릭 시 
	{
?>
				<!-- html_ok는 새글쓰기에만 보이게 -->
				<div class="col3"><input type="checkbox" name="html_ok" value="y"> HTML 쓰기</div>
<?
	}
?>						
			</div>
			<div class="write_line"></div>
			<div id="write_row2"><div class="col1"> 제목   </div>
			                     <div class="col2"><input type="text" name="subject" value="<?=$item_subject?>" ></div>
			</div>
			<div class="write_line"></div>
			<div id="write_row3"><div class="col1"> 내용   </div>
			                     <div class="col2"><textarea rows="15" cols="79" name="content"><?=$item_content?></textarea></div>
			</div>
			<div class="write_line"></div>
			<div id="write_row4">
				<div class="col1"> 이미지파일1   </div>
				<div class="col2"><input type="file" name="upfile[]"></div> 
				<!-- 배열로 처리, for문 돌리려고 -->
			</div>
			<div class="clear"></div>
<? 	if ($mode=="modify" && $item_file_0) //수정모드이고, 1번째 첨부파일이 있으면,
	{
?>
			<div class="delete_ok"><?=$item_file_0?> 파일이 등록되어 있습니다. 
			<input type="checkbox" name="del_file[]" value="0"> 삭제</div> 
			<!-- 배열로 처리 -->
			<div class="clear"></div>
<?
	}
?>
			<div class="write_line"></div>
			<div id="write_row5"><div class="col1"> 이미지파일2  </div>
			                     <div class="col2"><input type="file" name="upfile[]"></div>
			</div>
<? 	if ($mode=="modify" && $item_file_1)
	{
?>
			<div class="delete_ok"><?=$item_file_1?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="1"> 삭제</div>
			<div class="clear"></div>
<?
	}
?>
			<div class="write_line"></div>
			<div class="clear"></div>
			<div id="write_row6"><div class="col1"> 이미지파일3   </div>
			                     <div class="col2"><input type="file" name="upfile[]"></div>
			</div>
<? 	if ($mode=="modify" && $item_file_2)
	{
?>
			<div class="delete_ok"><?=$item_file_2?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="2"> 삭제</div>
			<div class="clear"></div>
<?
	}
?>
			<div class="write_line"></div>

			<div class="clear"></div>
		</div>

		<div id="write_button"><input type="submit">

								<a href="list.php?page=<?=$page ?>&scale=<?=$scale ?>">취소</a>
		</div>

		</form>

	</div> <!-- end of col2 -->
  </div> <!-- end of content -->
</div> <!-- end of wrap -->
</article>
<? include "../common/sub_footer.html" ?>
</body>
</html>
