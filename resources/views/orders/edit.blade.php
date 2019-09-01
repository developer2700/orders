<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit/Create Order</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{url('/css/bootstrap.min.css')}}" />
</head>
<body>

<div class="container">

    <a class="mt-5 btn btn-success btn-sm" href="{{url('/orders/')}}" >  <--return  </a>
    <div class="card mt-1 mb-5">

        <div class="card-header">
            <h4>Edit  order's  details </h1>
        </div>
        <div class="card-body">
            <form method="post" id="form-order" name="form-order"  enctype="multipart/form-data" >
                <input type="hidden" name="id" id="id" />

                <div class="form row">
                    <div class="form-group col-md-3">
                        <label>Product*</label>
                        <select class="form-control" name="product_id" id="products">
                            <option></option>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label>User*</label>
                        <select class="form-control" name="user_id" id="users">
                            <option></option>
                        </select>
                    </div>



                    <div class="form-group col-md-3">
                        <label>Price<small> auto calculate</small></label>
                        <input type="number" class="form-control" readonly id="price"  name="price">
                    </div>
                    <div class="form-group col-md-3">
                        <label>quantity * </label>
                        <input type="number" class="form-control required" id="quantity"  name="quantity">
                    </div>

                    <div class="col-md-12">

                        <button type="submit" class="btn btn-lg btn-info" id="btn-submit">Submit</button>

                    </div>



                </div>
        </div>
        </form>
    </div>

</div>
<script src="{{url('/js/orders.js')}}"></script>
<script>




    let url = window.location.pathname;
    let id = parseInt(url.substring(url.lastIndexOf('/') + 1));
    document.getElementById('id').value=id;

    getProductsByName('')
    .catch(e=>console.log(e))
    .then(data=>{
        console.log(data);
        var products = document.getElementById('products');
        products.innerHTML="";
        data.products.forEach( item=> {
            var option = document.createElement('option');
            option.value = item.id;
            option.text = item.name;
            products.appendChild(option);
        })
    });

    getUsersByName('')
    .catch(e=>console.log(e))
    .then(data=>{
        var users = document.getElementById('users');
        users.innerHTML="";
        data.users.forEach( item=> {
            var option = document.createElement('option');
            option.value = item.id;
            option.text = item.firstName+' '+item.lastName;
            users.appendChild(option);
        })
    });


    if(id) { // edit order
        getOrder(id)
        .catch(e=>console.log(e))
        .then(data=>{
            console.log(data.order);
            document.getElementById('products').value=data.order.product.id;
            document.getElementById('users').value=data.order.user.id;
            document.getElementById('price').value=data.order.price;
            document.getElementById('quantity').value=data.order.quantity;
        });
    }


</script>
</body>
</html>
