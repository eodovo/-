<? 
	session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>회원가입</title>
	<!-- <link rel="stylesheet" href="./common/css/common.css"> -->
	<link rel="stylesheet" href="./css/member_check.css">
	
	
  <script src="./js/jquery-1.12.4.min.js"></script>
  <script src="./js/jquery-migrate-1.4.1.min.js"></script>

	
	<script>
	 $(document).ready(function() {
  
   
 
 //id 중복검사
 $("#id").keyup(function() {    // id입력 상자에 id값 입력시
    var id = $('#id').val(); //aaa

    $.ajax({
        type: "POST",
        url: "check_id.php",
        data: "id="+ id,  
        cache: false, 
        success: function(data)
        {
             $("#loadtext").html(data);
        }
    });
});
		 
//nick 중복검사		 
$("#nick").keyup(function() {    // id입력 상자에 id값 입력시
    var nick = $('#nick').val();

    $.ajax({
        type: "POST",
        url: "check_nick.php",
        data: "nick="+ nick,  
        cache: false, 
        success: function(data)
        {
             $("#loadtext2").html(data);
        }
    });
});		 


});
	
	
	
	</script>
	<script>
   

  
   function check_input()
   {
      if (!document.member_form.id.value)
      {
          alert("아이디를 입력하세요");    
          document.member_form.id.focus();
          return;
      }

      if (!document.member_form.pass.value)
      {
          alert("비밀번호를 입력하세요");    
          document.member_form.pass.focus();
          return;
      }

      if (!document.member_form.pass_confirm.value)
      {
          alert("비밀번호확인을 입력하세요");    
          document.member_form.pass_confirm.focus();
          return;
      }

      if (!document.member_form.name.value)
      {
          alert("이름을 입력하세요");    
          document.member_form.name.focus();
          return;
      }

      if (!document.member_form.nick.value)
      {
          alert("닉네임을 입력하세요");    
          document.member_form.nick.focus();
          return;
      }


      if (!document.member_form.hp2.value || !document.member_form.hp3.value )
      {
          alert("휴대폰 번호를 입력하세요");    
          document.member_form.nick.focus();
          return;
      }

      if (document.member_form.pass.value != 
            document.member_form.pass_confirm.value)
      {
          alert("비밀번호가 일치하지 않습니다.\n다시 입력해주세요.");    
          document.member_form.pass.focus();
          document.member_form.pass.select();
          return;
      }

      document.member_form.submit(); 
		   // insert.php 로 변수 전송
   }

   function reset_form()
   {
      document.member_form.id.value = "";
      document.member_form.pass.value = "";
      document.member_form.pass_confirm.value = "";
      document.member_form.name.value = "";
      document.member_form.nick.value = "";
      document.member_form.hp1.value = "010";
      document.member_form.hp2.value = "";
      document.member_form.hp3.value = "";
      document.member_form.email1.value = "";
      document.member_form.email2.value = "";
	  
      document.member_form.id.focus();

      return;
   }
   function characterCheck(obj){
var regExp = /[ \{\}\[\]\/?.,;:|\)*~`!^\-_+┼<>@\#$%&\'\"\\\(\=]/gi; 
if( regExp.test(obj.value) ){
	alert("특수문자는 입력하실수 없습니다.");
	obj.value = obj.value.substring( 0 , obj.value.length - 1 ); // 입력한 특수문자 한자리 지움
	}
   }

</script>
</head>
<body>
	 <? include "../common/subhead.html" ?>
	 
	<article id="content">  
	  
	  <h2>회원가입</h2>
	  <form  name="member_form" method="post" action="insert.php"> 
		<div class="intro">
            <p>회원정보입력</p>
            <p><span>*</span>는 필수입력사항입니다.</p>
        </div>
        <div class="intro2">
                <p>* ID는 변경할 수 없으니 신중하게 선택해주세요.</p>
                <p>* 연락처와 이메일은 가입시 사용되오니 실제 정보를 입력해주세요.</p>
        </div>
     <table>
      <caption class="hidden">회원가입</caption>
      <tr>
          <th scope="col"><label for="name">이름 <span>*</span></label></th>
          <td>
              <input type="text" name="name" id="name"  required placeholder="예) 홍길동" onkeypress="characterCheck(this)"> 
          </td>
      </tr>
     	<tr>
     		<th scope="col"><label for="id">아이디 <span>*</span></label></th>
     		<td>
     			 <input type="text" name="id" id="id" required placeholder="띄어쓰기 없이 영문, 대소문자로 입력해주세요." onkeypress="characterCheck(this)">
			     <span id="loadtext"></span>
     		</td>
     	</tr>
     	<tr>
     		<th scope="col"><label for="pass">비밀번호 <span>*</span></label></th>
     		<td>
     			 <input type="password" name="pass" id="pass" required placeholder="영문, 특수문자, 숫자조합">
     		</td>
     	</tr>
     	<tr>
     		<th scope="col"><label for="pass_confirm">비밀번호 확인 <span>*</span></label></th>
     		<td>
     			<input type="password" name="pass_confirm" id="pass_confirm"  required placeholder="비밀번호 확인을 위해 다시 한 번 더 입력해주세요.">
     		</td>
     	</tr>
     	<tr>
     		<th scope="col"><label for="nick">닉네임 <span>*</span></label></th>
     		<td>
     			 <input type="text" name="nick" id="nick"  required placeholder="닉네임은 변경이 불가하므로 신중하게 적어주세요.">
			     <span id="loadtext2"></span>
     		</td>
     	</tr>
     	<tr>
     		<th scope="col" class="add">휴대폰 <span>*</span></th>
     		<td class="phone">
<div>
         			<label class="hidden" for="hp1">전화번호앞3자리</label>
         			<select class="hp" name="hp1" id="hp1"> 
                  <option value='010'>010</option>
                  <option value='011'>011</option>
                  <option value='016'>016</option>
                  <option value='017'>017</option>
                  <option value='018'>018</option>
                  <option value='019'>019</option>
              </select>
                <span>-</span> 
              <label class="hidden" for="hp2">전화번호중간4자리</label>
              <input type="text" class="hp" name="hp2" id="hp2"  required maxlength="4" placeholder="0000">
              <span>-</span> 
              <label class="hidden" for="hp3">전화번호끝4자리</label>
              <input type="text" class="hp" name="hp3" id="hp3"  required maxlength="4" placeholder="0000">
</div>
     			
     		</td>
     	</tr>
     	<tr>
     		<th scope="col" class="add">이메일</th>
     		<td>
     		  <label class="hidden" for="email1">이메일아이디</label>
     			<input type="text" id="email1" name="email1"  required placeholder="이메일을 입력해주세요.">
                 <span>@</span> 
     			<label class="hidden" for="email2">이메일주소</label>
     			<input type="text" name="email2" id="email2"  required placeholder="이메일 주소">
     		</td>
     	</tr>
     	<tr>
     		<td colspan="2" class="save">
                 <a href="#" onclick="reset_form()">다시쓰기</a>
     			<a href="#" onclick="check_input()">저장하고 회원가입하기</a>
				 <a href="../index.html">취소</a>
                 
     		</td>
     	</tr>
     </table>

	 </form>
	  
	</article>
	 <? include "../common/subfoot.html" ?>
</body>
</html>


