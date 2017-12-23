
<!DOCTYPE html>
<html>
<head>
	
<script>
function showHint(str) {
     if (str.length == 0) { 
         document.getElementById("txtHint").innerHTML = "";
         return;
     } else {
         var xmlhttp = new XMLHttpRequest();
         xmlhttp.onreadystatechange = function() {
             if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                 document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
             }
         }
         xmlhttp.open("GET", "gethint.php?q="+str, true);
         xmlhttp.send();
     }
}
function add()
{

}
</script>
</head>
<body>

<p><b>Start typing a name in the input field below:</b></p>
<form> 
First name: <input type="text" onkeyup="showHint(this.value)">
</form>
<p>Suggestions: <span id="txtHint"></span></p>
</body>
</html>

<!--
<!DOCTYPEE html>
<html>
<head>
	<title>Javascript Addition</title>
</head>
<body>
	<form>
	First Number:
<input type="text" onkeyup="hint(this.value)">
Suggestions:<span id="txthint"></span><br/>
+
Second Number
<input type="text" id="second" name="second">
=
<input type="text" id="final" name="final">

<button onclick="add()" name="add">ADD</button>
</form>
<script>
function hint(str)
{
if(str.length == 0){
document.getElementById("txthint").innerHTML="";
return;
}
else
{
var xml=new XMLHttpRequest();
xml.onreadystatechange=function();
if(xml.readyState==4 && xml.status== 200){
document.getElementById("txthint").innerHTML=xml.responseText;
}
}
xml.open("GET","gethint.php?q="+str, true);
xml.send();



}
}

function add() {
//var x=
document.getElementById("final").value=parseInt(document.getElementById("one").value)+parseInt(document.getElementById("second").value);

}

</script>



</body>
</html>
-->

