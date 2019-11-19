<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
  <meta name="author" content="Suckittrees">
  <title>Horizontal Dropdown Menu dengan CSS3 Suckittrees.com</title>
  <link rel="shortcut icon" href="http://suckittrees.com/favicon.png">
  <link rel="icon" href="http://suckittrees.com/favicon.png">
 </head>
<body>
<h1 align="center"><a href="suckittrees.com/artikel-121/membuat-menu-dropdown-dengan-css.html">Read Tutorial Suckittrees.com</a></h1>
<h3>Membuat Penjumlahan Otomatis Suckittrees.com</h3>
<input type="text" id="txt1"  onkeyup="sum();" />
<input type="text" id="txt2"  onkeyup="sum();" />=
<input type="text" id="txt3" />
</body>

<script>
function sum() {
      var txtFirstNumberValue = document.getElementById('txt1').value;
      var txtSecondNumberValue = document.getElementById('txt2').value;
      var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
      if (!isNaN(result)) {
         document.getElementById('txt3').value = result;
      }
}
</script>

</html>
