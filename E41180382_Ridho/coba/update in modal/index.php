<?php
    include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Updaten</title>
</head>
<body>
    
    <div class="container">
        <h2>Ajax Update</h2>
        <p>Update User Info With JQuery Ajax :</p>

        <table class="table">
            <thead>
                <tr>
                    <th>Kategori</th>
                    <th>Nama Bunga</th>
                    <th>Harga</th>
u                    <th>Stok</th>
                    <th>Deskripsi</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $tabel = mysqli_query($koneksi, 'SELECT * FROM bunga');
                    while($row = mysqli_fetch_array($tabel)){ ?>
                    <tr id="<?php echo $row['ID_BUNGA'];?>">
                        <td data-target="kategoriBunga"><?php echo $row['ID_KATEGORI'];?></td>
                        <td data-target="namaBunga"><?php echo $row['NAMA_BUNGA'];?></td>
                        <td data-target="hargaBunga"><?php echo $row['HARGA'];?></td>
                        <td data-target="stokBunga"><?php echo $row['STOK'];?></td>
                        <td data-target="deskripsiBunga"><?php echo $row['DESKRIPSI'];?></td>
                        <td><a href="#" data-role="update" data-id="<?php echo $row['ID_BUNGA'];?>">Updateee</a></td>
                    </tr>
                <?php    }
                ?>
            </tbody>
        
        </table>

            <!-- Modal -->
            <div id="myModal1" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kategori</label>
                        <input type="text" id="kategoriBunga" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nama Bunga</label>
                        <input type="text" id="namaBunga" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" id="hargaBunga" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="text" id="stokBunga" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <input type="text" id="deskripsiBunga" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" id="simpan" class="btn btn-primary pull-left">Updatan</a>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>

</body>

<script>
    $(document).ready(function(){
        $(document).on('click','a[data-role=update]',function(){
        var id = $(this).data('id');
        var kategoriBunga = $('#'+id).children('td[data-target=kategoriBunga]').text();
        var NamaBunga = $('#'+id).children('td[data-target=namaBunga]').text();
        var hargaBunga = $('#'+id).children('td[data-target=hargaBunga]').text();
        var stokBunga = $('#'+id).children('td[data-target=stokBunga]').text();
        var deskripsiBunga = $('#'+id).children('td[data-target=deskripsiBunga]').text();
        
        $('#kategoriBunga').val(kategoriBunga);
        $('#namaBunga').val(NamaBunga);
        $('#hargaBunga').val(hargaBunga);
        $('#stokBunga').val(stokBunga);
        $('#deskripsiBunga').val(deskripsiBunga);
        $('#myModal1').modal('toggle');
        
        })
    });
</script>
</html>