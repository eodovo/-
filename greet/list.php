<? 
	session_start(); 
	@extract($_POST);
	@extract($_GET);
	@extract($_SESSION);
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PR센터-회사소식</title>
    <link rel="stylesheet" href="../common/css/common.css">
    <link rel="stylesheet" href="../sub4/common/css/sub4common.css">
    <link rel="stylesheet" href="./sub4_content2.css">
    <script src="https://kit.fontawesome.com/6c4383a4e3.js" crossorigin="anonymous"></script>
    <!-- <script src="../common/js/prefixfree.min.js"></script> -->
</head>
<?
	include "../lib/dbconn.php";

	if(!$scale)
	$scale=10;			// 한 화면에 표시되는 글 수

	//1. 다 보이는 것 하나 2. 페이지네이션 클릭했을 때 보이는 것 하나 3. 검색을 통해 보이는 것(mode=search)
	
    if ($mode=="search")
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

		$sql = "select * from greet where $find like '%$search%' order by num desc"; //최신글이 맨 위에 있기 때문에(내림차순으로 배열)
	}
	else
	{
		$sql = "select * from greet order by num desc";
	}

	$result = mysql_query($sql, $connect);

	$total_record = mysql_num_rows($result); // 전체 글 수

	// 전체 페이지 수($total_page) 계산 
	if ($total_record % $scale == 0)     
		$total_page = floor($total_record/$scale);      
	else
		$total_page = floor($total_record/$scale) + 1; 
 
	if (!$page)                 // 페이지번호($page)가 0 일 때
		$page = 1;              // 페이지 번호를 1로 초기화
 
	// 표시할 페이지($page)에 따라 $start 계산  
	$start = ($page - 1) * $scale;      

	$number = $total_record - $start;
?>

<body>
<? include "../common/sub_header.html" ?>
<div class="main">
        <img src="../sub4/common/imgaes/main.jpg" alt="메인이미지">
        <h3>PR센터</h3>
    </div>

    <div class="subNav">
        <ul>
			<li><a href="../concert/list.php">PR자료실</a></li>
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
			<div id="col1">
				<div id="left_menu">
					<? include "../lib/left_menu.php";?>
				</div>
			</div>
			<div id="col2">

				<!-- mode=search는 get방식으로 -->
				<form name="board_form" method="post" action="list.php?mode=search">
					<div id="list_search">
						
<ul>
					<li>
								<div id="list_search1">
									<i class="fa-sharp fa-solid fa-file"></i> 총
									<span><?= $total_record ?></span> 개의 게시물이 있습니다.
								</div>
					</li>
<li>
								<div id="list_search2">
									<select name="find">
										<option value='subject'>제목</option>
										<option value='content'>내용</option>
										<option value='nick'>별명</option>
										<option value='name'>이름</option>
									</select>
								</div>
</li>
<li>
								<div id="list_search3"><input type="text" name="search" placeholder="검색어를 입력해주세요."></div>
								<!-- 역할은 submit -->
</li>
							<li><div id="list_search4"><input type="submit"></div></li>
</ul>
					</div>
				</form>
				
				<div class="list_count"> 
					<label for="scale">리스트개수</label>
					<select id="scale" name="scale" onchange="location.href='list.php?scale='+this.value">
						<option value=''>보기</option>
						<option value='1'>1</option>
						<option value='2'>2</option>
						<option value='3'>3</option>
						<option value='4'>4</option>
						<option value='5'>5</option>
					</select>
				</div>


				<div id="list_top_title">
					<ul>
						<li id="list_title1">
							<p>번호</p>
						</li>
						<li id="list_title2">
							<p>제목</p>
						</li>
						<li id="list_title3">
							<p>작성자</p>
						</li>
						<li id="list_title4">
							<p>작성일</p>
						</li>
						<li id="list_title5">
							<p>조회</p>
						</li>
					</ul>
				</div>

				<div id="list_content">
					<?		
   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)                    
   {
      mysql_data_seek($result, $i);       
      // 가져올 레코드로 위치(포인터) 이동  
      $row = mysql_fetch_array($result);       
      // 하나의 레코드 가져오기
	
	  $item_num     = $row[num];
	  $item_id      = $row[id];
	  $item_name    = $row[name];
  	  $item_nick    = $row[nick];
	  $item_hit     = $row[hit];

      $item_date    = $row[regist_day];
	  $item_date = substr($item_date, 0, 10);  

	  $item_subject = str_replace(" ", "&nbsp;", $row[subject]);

?>
					<div class="list_item">
						<div class="list_item1">
							<?= $number ?>
						</div>
						<div class="list_item2"><a href="view.php?num=<?=$item_num ?>&page=<?=$page ?>&scale=<?=$scale ?>">
								<?= $item_subject ?>
							</a></div>
						<div class="list_item3">
							<?= $item_nick ?>
						</div>
						<div class="list_item4">
							<?= $item_date ?>
						</div>
						<div class="list_item5">
							<?= $item_hit ?>
						</div>
					</div>
					<?
   	   $number--;
   }
?>
					<div id="page_button">
						<div id="page_num"> &lt; &nbsp;&nbsp;&nbsp;&nbsp;
							<?
   // 게시판 목록 하단에 페이지 링크 번호 출력
   for ($i=1; $i<=$total_page; $i++)
   {
		if ($page == $i)     // 현재 페이지 번호 링크 안함
		{
			echo "<b> $i </b>";
		}
		else
		{ 
			echo "<a href='list.php?page=$i&scale=$scale'> $i </a>"; //페이지 번호랑, 스케일도 같이 넘겨줘야함
		}      
   }
?>
							&nbsp;&nbsp;&nbsp;&nbsp; &gt;
						</div>
						<div id="button">
							<a href="list.php?page=<?=$page?>&scale=<?=$scale?>">목록</a>
							<? 
	if($userid) //세션변수 userid값이 들어오면 로그인 
	{
?>
							<a href="write_form.php?page=<?=$page?>&scale=<?=$scale?>">글쓰기</a>
							<?
	}
?>
						</div>
					</div> <!-- end of page_button -->

				</div> <!-- end of list content -->

				<div class="clear"></div>

			</div> <!-- end of col2 -->
</div>
	</article> <!-- end of wrap -->
	<? include "../common/sub_footer.html" ?>
</body>

</html>