<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit/Create User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{url('/css/bootstrap.min.css')}}" />
</head>
<body>

<div class="container">

    <a class="mt-5 btn btn-success btn-sm" href="{{url('/users/')}}" >  <--return  </a>
    <div class="card mt-1 mb-5">

        <div class="card-header">
            <h4>Edit  User's  details </h1>
        </div>
        <div class="card-body">
            <form method="post" id="form-user" name="form-user"  enctype="multipart/form-data" >
                <input type="hidden" name="id" id="id" />

                <div class="form row">

                    <div class="form-group col-md-3">
                        <label>Email * </label>
                        <input type="text" class="form-control required" id="email"  name="email">
                    </div>

                    <div class="form-group col-md-3">
                        <label>firstName * </label>
                        <input type="text" class="form-control required" id="firstName"  name="firstName">
                    </div>

                    <div class="form-group col-md-3">
                        <label>lastName * </label>
                        <input type="text" class="form-control required" id="lastName"  name="lastName">
                    </div>



                    <div class="col-md-12">

                        <button type="submit" class="btn btn-lg btn-info" id="btn-submit">Submit</button>

                    </div>



                </div>
        </div>
        </form>
    </div>

</div>
<script src="{{url('/js/users.js')}}"></script>
<script>




    let url = window.location.pathname;
    let id = parseInt(url.substring(url.lastIndexOf('/') + 1));
    document.getElementById('id').value=id;

    if(id) { // edit user mode
        getUser(id)
        .catch(e=>console.log(e))
        .then(data=>{
            console.log(data.user);
            document.getElementById('firstName').value=data.user.firstName;
            document.getElementById('lastName').value=data.user.lastName;
            document.getElementById('email').value=data.user.email;
        });
    }


</script>
</body>
</html>
