<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid">
        <h1>Products</h1>
        <button class="btn btn-primary btnAdd float-end">Add Product</button>
        <table class="table table-hover align-middle text-center " style="table-layout: fixed;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>QTY</th>
                    <th>Total</th>
                    <th>Discount</th>
                    <th>Payment</th>
                    <th>Thumbnail</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php include 'function.php';
                selectProduct();
            ?>
            </tbody>
        </table>
    </div>
    <div class="modals container-fluid">
        <form action="" method="post" enctype="multipart/form-data">
            <h2 class="text-center " id="title"></h2>
            <input type="hidden" name="hide_id" id="hide_id">
            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="price" class="form-label mt-2">Price</label>
                <input type="text" name="price" id="price" class="form-control">
            </div>
            <div class="form-group">
                <label for="qty" class="form-label mt-2">QTY</label>
                <input type="text" name="qty" id="qty" class="form-control">
            </div>
            <div class="form-group">
                <label for="thumbnail" class="form-label mt-2">Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                <input type="hidden" name="hide_image" id="hide_image">
            </div>
            <div class="form-group">
                <button type="submit" name="btnSave" class="btn mt-4 me-2 btn-primary btnSave">Save</button>
                <button type="submit" name="btnEdit" class="btn mt-4 me-2 btn-success btnEdit">Edit</button>
                <button type="button" class="btn mt-4 me-2 btn-danger btnCancel">Cancel</button>
            </div>
        </form>
       
    </div>
    <!-- Modal open delete-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete ?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" >
                <button type="submit" class="btn btn-primary" name="btnDelete">Yes, delete it.</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
            </form>
      </div>   
    </div>
  </div>
</div>
</body>
</html>

<script>
    $(document).ready(function(){
        $('.btnAdd').click(function(){
            $('.modals').slideDown(500);
            $('#title').html('Add Product')
            $('.btnSave').show();
            $('.btnEdit').hide();

        })
        $('.btnCancel').click(function(){
            $('.modals').slideUp(500);
        })
        $(document).on('click','.openDelete',function(){
            var proId=$(this).parents('tr').find('td:nth-child(1)').text();
            $('#id').val(proId) 
        })
        
        $(document).on('click','#btnEdit',function(){
            $('.modals').slideDown(500);
            $('#title').html('Edit Product')
            $('.btnSave').hide();
            $('.btnEdit').show();
            var tid=$(this).parents('tr').find('td').eq(0).text();
            var tname=$(this).parents('tr').find('td').eq(1).text();
            var tprice=$(this).parents('tr').find('td').eq(2).text();
            var tqty=$(this).parents('tr').find('td').eq(3).text();
            var tImage=$(this).parents('tr').find('img').attr('src');
            var nameImage=tImage.split('/').pop();
        
            
            $('#hide_id').val(tid)
            $('#name').val(tname)
            $('#price').val(tprice)
            $('#qty').val(tqty)
            $('#hide_image').val(nameImage)  
        })
    })
</script>