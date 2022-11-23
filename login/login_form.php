<? session_start(); ?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인</title>
    <link rel="stylesheet" href="./css/login.css">
    <script src="https://kit.fontawesome.com/f8a0f5a24e.js" crossorigin="anonymous"></script>
</head>
<body>
<header>
        <a class="logo" href="../index.html"><img src="../images/joinlogo.png" alt="logo"></a>
    </header>
    <form  name="member_form" method="post" action="login.php"> 
        
        <div id="id_pw_input">
        <h1 class="hidden">롯데정밀화학</h1>
        <h2>로그인</h2>
        <ul>
            <li>
            <label for="id">아이디</label>    
            <input type="text" name="id" class="login_input" required placeholder="아이디를 입력해주세요"></li>
            <li>
            <label for="pass">패스워드</label>    
            <input type="password" name="pass" class="login_input" required placeholder="비밀번호를 입력해주세요"></li>
        </ul>						
	</div>
    <div id="login_button">
		<button type="submit">로그인</button>
	</div>
    <ul>
        <li class="find">
            <span><a href="id_find.php">아이디 찾기</a></span>
            <span><a href="pw_find.php">비밀번호 찾기</a></span>
        </li>
	</ul>
    <div id="join_button">
        <a href="../member/member_form.php">회원가입</a>
    </div>
   


</form>

</body>
</html>