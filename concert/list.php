<? 
	session_start(); 
	$table = "concert"; //이부분만 변경해주면 됨(테이블 만든 후 테이블명만 바꿔줌)
?>


<!DOCTYPE html>
<html lang="ko">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PR센터-PR자료실</title>
	<link rel="stylesheet" href="../common/css/common.css">
	<link rel="stylesheet" href="../sub4/common/css/sub4common.css">
	<link rel="stylesheet" href="./pr.css">
	<script src="https://kit.fontawesome.com/6c4383a4e3.js" crossorigin="anonymous"></script>
</head>
<?
	@extract($_POST);
	@extract($_GET);
	@extract($_SESSION);

	include "../lib/dbconn.php";
	if(!$scale){
	$scale=10;	
	}						// 한 화면에 표시되는 글 수

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

		$sql = "select * from $table where $find like '%$search%' order by num desc";
	}
	else
	{
		$sql = "select * from $table order by num desc";
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
			<li class="current"><a href="./concert/list.php">PR자료실</a></li>
			<li><a href="../greet/list.php">회사소식</a></li>
			<li><a href="../sub4/sub4_3.html">FAQ</a></li>
			<li><a href="../sub4/sub4_4.html">문의하기</a></li>

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
			<div id="col2">


				<form name="board_form" method="post" action="list.php?table=<?=$table?>&mode=search">
					<div id="list_search">
						<ul>
							<li>
								<div id="list_search1">
									<i class="fa-sharp fa-solid fa-file"></i> 총
									<span>
										<?= $total_record ?>
									</span> 개의 게시물이 있습니다.
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
								<div id="list_search3"><input type="text" name="search" placeholder="검색어를 입력해주세요.">
								</div>
							</li>
							<li>
								<div id="list_search4"><input type="submit"></div>
							</li>
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
	  $item_content = $row[content];

	  if($row[file_copied_0]) { //file_copied_0에 뭐라도 있으면
	  $item_img = './data/'.$row[file_copied_0];
	} else {
	  $item_img = './data/default.jpg';
	}
?>
					<div class="list_item">
						<a href="view.php?table=<?=$table?>&num=<?=$item_num?>&page=<?=$page?>&scale=<?=$scale?>"
							class="prContent">

							<div class="list_item1"><img src="<?= $item_img ?>" style="width:350px; height:350px;"
									alt="섬네일 이미지"></div>
							<!-- 테이블이름 get방식으로 계속 넘겨줌 -->
							<div class="inner">
								<div class="list_item2">
									<?= $item_subject ?>
								</div>
								<div class="list_item3">
									<?= $item_content ?>
								</div>
								<div class="list_item4"><span>
										<?= $item_nick ?>
									</span></div>
								<div class="list_item5"><span>
										<?= $item_date ?>
									</span></div>
								<div class="list_item6"><span><i class="fas fa-eye"></i>
										<?= $item_hit ?>
									</span></div>
							</div>
						</a>
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
					</div>
				</div>
			</div>
		</div>
	</article>
	<? include "../common/sub_footer.html" ?>
</body>

</html>