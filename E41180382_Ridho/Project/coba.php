<html>
    <head>
        <title>title</title>
    </head>
    <body>
        <div id="pesan"></div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>
            var url = "hapustransaksi.php"; // url tujuan
            var count = 100; // dalam detik
            function countDown() {
                if (count > 0) {
                    count--;
                    var waktu = count + 1;
                    $('#pesan').html('Pesanan ini akan ' + url + ' dalam ' + waktu + ' detik.');
                    setTimeout("countDown()", 100);
                } else {
                    window.location.href = url;
                }
            }
            countDown();
        </script>
    </body>
</html>

<!-- <?php
$tanggal= mktime(date("m"),date("d"),date("Y"));
echo "Tanggal : <b>".date("d-M-Y", $tanggal)."</b> ";
date_default_timezone_set('Asia/Jakarta');
$jam=date("H:i:s");
echo "| Pukul : <b>". $jam." "."</b>";
$a = date ("H");
if (($a>=6) && ($a<=11)){
echo "<b>, Selamat Pagi !!</b>";
}
else if(($a>11) && ($a<=15))
{
echo ", Selamat Pagi !!";}
else if (($a>15) && ($a<=18)){
echo ", Selamat Siang !!";}
else { echo ", <b> Selamat Malam </b>";}
?>  -->