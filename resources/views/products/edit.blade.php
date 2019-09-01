<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit/Create Product</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{url('/css/bootstrap.min.css')}}" />
</head>
<body>

<div class="container">

    <a class="mt-5 btn btn-success btn-sm" href="{{url('/products/')}}" >  <--return  </a>
    <div class="card mt-1 mb-5">

        <div class="card-header">
            <h4>Edit  Product's  details </h1>
        </div>
        <div class="card-body">
            <form method="post" id="form-product" name="form-product"  enctype="multipart/form-data" >
                <input type="hidden" name="id" id="id" />

                <div class="form row">

                    <div class="form-group col-md-3">
                        <label>Name * </label>
                        <input type="text" class="form-control required" id="name"  name="name">
                    </div>

                    <div class="form-group col-md-3">
                        <label>Price*</label>
                        <input type="number" class="form-control required"  id="price"  name="price">
                    </div>


                    <div class="col-md-12">

                        <button type="submit" class="btn btn-lg btn-info" id="btn-submit">Submit</button>

                    </div>



                </div>
        </div>
        </form>
    </div>

</div>
<script src="{{url('/js/products.js')}}"></script>
<script>




    let url = window.location.pathname;
    let id = parseInt(url.substring(url.lastIndexOf('/') + 1));
    document.getElementById('id').value=id;

    if(id) { // edit product mode
        getProduct(id)
        .catch(e=>console.log(e))
        .then(data=>{
            console.log(data.product);
            document.getElementById('name').value=data.product.name;
            document.getElementById('price').value=data.product.price;
        });
    }


</script>
</body>
</html>
