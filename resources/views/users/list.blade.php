<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Users List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{url('/css/bootstrap.min.css')}}" />
</head>

<body>

<div class="container">

    <ul class="nav nav-tabs mt-5">
        <li class="nav-item">
            <a class="nav-link " href="{{url('/orders')}}">Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/products')}}">Products</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{url('/users')}}">Users</a>
        </li>

    </ul>

    <div class="card mt-1 mt-1">
        <div class="card-body">



            <form method="get" id="form-search" name="form-search" >
                <div class="row">

                    <div class="form-group col-md-3">
                        <label>user <small>name/last autocomplete</small></label>
                        <input autocomplete="off" list='autocompleteUserFullNameList' class="form-control" name="fullName" id="autocompleteUserFullName">
                        <datalist id="autocompleteUserFullNameList">
                        </datalist>
                    </div>


                    <div class="form-group col-md-3">
                        <button type="submit" class="mt-4 btn btn-info" id="btn-submit" >Search</button>
                        <a class="btn btn-success mt-4  " href="{{url('/users/create')}}" >Add New User</a>
                    </div>

                </div>
                <span id="search-result-tip"  class="bg-warning p-2"></span>
            </form>

        </div>
    </div>


    <div class="card mt-1 mb-5">

        <div class="card-header"> <h5> List all Users </h5></div>
        <div class="card-body">
            <div class="table-responsive ">
                <table id="table-list" class="table table-sm">
                    <thead>
                    <tr>
                        <th scope="col">UserId</th>
                        <th scope="col">fullName</th>
                        <th scope="col">date</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">#</th>
                        <td>fullName</td>
                        <td>date</td>
                        <td>
                            <a class=" btn btn-info btn-sm" href="edit" >Edit</a>
                            <a data-id="1"  class="btn-delete btn btn-danger btn-sm" href="delete" >delete</a>
                        </td>
                    </tr>

                    </tbody>
                </table>

                <div id="pagination"></div>
            </div>
        </div>
    </div>

    <script src="{{url('/js/users.js')}}"></script>
    <script>
        getUsers()
            .catch(e=>console.log(e))
        .then(data=>{
            RenderPagination(data)
        return RenderHtmlTable( data.users)
        });



    </script>
</body>
</html>
