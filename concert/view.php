<? 
	session_start(); 

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
	$sql = "select * from $table where num=$num";
	$result = mysql_query($sql, $connect);

    $row = mysql_fetch_array($result);       
      // 하나의 레코드 가져오기
	
	$item_num     = $row[num];
	$item_id      = $row[id];
	$item_name    = $row[name];
  	$item_nick    = $row[nick];
	$item_hit     = $row[hit];

	//null값 허용
	//image_name 배열안에 담아둠
	$image_name[0]   = $row[file_name_0];
	$image_name[1]   = $row[file_name_1];
	$image_name[2]   = $row[file_name_2];

	//image_copied 배열안에 담아둠
	$image_copied[0] = $row[file_copied_0];
	$image_copied[1] = $row[file_copied_1];
	$image_copied[2] = $row[file_copied_2];

    $item_date    = $row[regist_day];
	$item_subject = str_replace(" ", "&nbsp;", $row[subject]);

	$item_content = $row[content];
	$is_html      = $row[is_html];

	if ($is_html!="y")
	{
		$item_content = str_replace(" ", "&nbsp;", $item_content);
		$item_content = str_replace("\n", "<br>", $item_content);
	}

	//첨부된 이미지 가져오기
	for ($i=0; $i<3; $i++) //0,1,2
	{
		if ($image_copied[$i]) //존재 여부는 그냥 변수자체를 넣어주면됨 //첨부된 이미지가 있으면
		{
			$imageinfo = GetImageSize("./data/".$image_copied[$i]);
			 //배열로 사이즈 리턴([0] 이미지너비, [1] 이미지높이, [2] 이미지타입/종류(jpg..))
			 //왜 사이즈를 가져오나?

			$image_width[$i] = $imageinfo[0]; //이미지너비
			$image_height[$i] = $imageinfo[1]; //이미지높이
			$image_type[$i]  = $imageinfo[2]; //이미지종류

			if ($image_width[$i] > 785) //785를 max-width로 쓰겠다.(이미지 너비 제한)
				$image_width[$i] = 785;
		}
		else //첨부된 이미지가 없으면
		{
			$image_width[$i] = "";
			$image_height[$i] = "";
			$image_type[$i]  = "";
		}
	}

	$new_hit = $item_hit + 1;

	$sql = "update $table set hit=$new_hit where num=$num";   // 글 조회수 증가시킴
	mysql_query($sql, $connect);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PR센터-PR자료실</title>
<meta charset="utf-8">
<link rel="stylesheet" href="../common/css/common.css">
    <link rel="stylesheet" href="../sub4/common/css/sub4common.css">
    <link rel="stylesheet" href="./pr.css">
	<link rel="stylesheet" href="../greet/sub4_content2_2.css">
<script src="https://kit.fontawesome.com/6c4383a4e3.js" crossorigin="anonymous"></script>
<script>
    function del(href) 
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

	<div id="col2">
		<div id="view_title">

			<ul>
				<li><div id="view_title1"><?= $item_subject ?></div></li>
				<li><div id="view_title2"><?= $item_nick ?> | 조회 : <?= $item_hit ?> | <?= $item_date ?> </div>	</li>
			</ul>
		</div>

		<div id="view_content">
<?
	for ($i=0; $i<3; $i++)
	{
		if ($image_copied[$i])
		{
			$img_name = $image_copied[$i];  //2022_11_21_10_20_15_0.jpg
			$img_name = "./data/".$img_name; // ./data/2022_11_21_10_20_15_0.jpg (경로생성)
			$img_width = $image_width[$i];
			
			
			echo "<img src='$img_name' width='$img_width'>"."<br><br>";
		}
	}
?>
			<?= $item_content ?>
		</div>

		<div id="view_button">
				<a href="list.php?table=<?=$table?>&page=<?=$page?>&scale=<?=$scale?>">목록</a>
<? 
	if($userid==$item_id || $userid=="admin" || $userlevel==1 )
	{
?>
				<a href="write_form.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>&scale=<?=$scale?>">수정</a>
				<!-- 테이블 넘기고 삭제할 넘버값 전달 -->
				<a href="javascript:del('delete.php?table=<?=$table?>&num=<?=$num?>')">삭제</a> 
<?
	}
?>
<? 
	if($userid)
	{
?>
				<a href="write_form.php?table=<?=$table?>&page=<?=$page?>&scale=<?=$scale?>">글쓰기</a>
<?
	}
?>
		</div>



	</div> <!-- end of col2 -->
  </div> <!-- end of content -->
</div> <!-- end of wrap -->
</article>
<? include "../common/sub_footer.html" ?>
</body>
</html>
