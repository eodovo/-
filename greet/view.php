<? 
	session_start();

		/*
	$num=1 => 게시글번호
	$
	*/


	@extract($_GET); 
  @extract($_POST); 
  @extract($_SESSION); 

	include "../lib/dbconn.php";

	$sql = "select * from greet where num=$num";
	$result = mysql_query($sql, $connect);

    $row = mysql_fetch_array($result);       
      // 하나의 레코드 가져오기
	
	$item_num     = $row[num];
	$item_id      = $row[id];
	$item_name    = $row[name];
  	$item_nick    = $row[nick];
	$item_hit     = $row[hit];

    $item_date    = $row[regist_day];

	$item_subject = str_replace(" ", "&nbsp;", $row[subject]);

	$item_content = $row[content];
	$is_html      = $row[is_html];

	if ($is_html!="y")
	{
		$item_content = str_replace(" ", "&nbsp;", $item_content);
		$item_content = str_replace("\n", "<br>", $item_content);
	}	

	$new_hit = $item_hit + 1;

	$sql = "update greet set hit=$new_hit where num=$num";   // 글 조회수 증가시킴
	mysql_query($sql, $connect);
?>
<!DOCTYPE HTML>
<html>
<head> 
<meta charset="utf-8">
<title>PR센터-회사소식</title>
<link rel="stylesheet" href="../common/css/common.css">
    <link rel="stylesheet" href="../sub4/common/css/sub4common.css">
    <link rel="stylesheet" href="./sub4_content2_2.css">
	<script src="https://kit.fontawesome.com/6c4383a4e3.js" crossorigin="anonymous"></script>
<script>
    function del(href) //delete.php?num=1
    {
        if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
                document.location.href = href;
        }
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
			<li ><a href="../concert/list.php">PR자료실</a></li>
            <li class="current"><a href="./list.php">회사소식</a></li>
<li><a href="../sub4/sub4_3.html">FAQ</a></li>
            <li ><a href="../sub4/sub4_4.html">문의하기</a></li>

        </ul>
    </div>
	<article id="content">
	<div class="titleArea">
            <div class="lineMap">
                <span><i class="fa-solid fa-house"></i></span>&gt; <span>PR센터</span>&gt;
                <strong>회사소식</strong>
            </div>
            <h2>회사소식</h2>
			<p>롯데정밀화학 공지사항을 알려드립니다.</p>
        </div>
		<div class="contentArea">

	<div id="col2">
        

		<div id="view_title">
			<ul>
			<li><div id="view_title1"><?= $item_subject ?></div></li>
			<li><div id="view_title2"><?= $item_nick ?> | 조회 : <?= $item_hit ?> | <?= $item_date ?> </div>	</li>
			</ul>
		</div>

		<div id="view_content">
			<?= $item_content ?>
		</div>

		<div id="view_button">
				<a href="list.php?page=<?=$page?>&scale=<?=$scale?>">목록</a>
<? 
	if($userid==$item_id || $userlevel==1 || $userid=="admin")
	{
?>
				<a href="modify_form.php?num=<?=$num?>&page=<?=$page?>&scale=<?=$scale?>">수정</a>
				<a href="javascript:del('delete.php?num=<?=$num?>')">삭제</a>
<?
	}
?>
<? 
	if($userid)
	{
?>
				<a href="write_form.php?page=<?=$page?>&scale=<?=$scale?>">글쓰기</a>
<?
	}
?>
		</div>


	</div> <!-- end of col2 -->
  </div> <!-- end of content -->
</div>

</article> <!-- end of wrap -->
<? include "../common/sub_footer.html" ?>
</body>
</html>
