var baseApiUrl="http://localhost:8000/api" ;
var ApiUrl="http://localhost:8000/api/users" ;
var limitPerPage=5 ;


async function getUsers(url=ApiUrl+"/search?limit="+limitPerPage) {
    let response = await fetch(url);
    if (response.status == 200) {
        let json = await response.json();
        return json;
    }
    throw new Error(response.status);
}

async function getUser(id) {
    let url=ApiUrl+"/"+id;

    let response = await fetch(url);
    if (response.status == 200) {
        let json = await response.json();

        return json;
    }

    throw new Error(response.status);
}


async function delUser(id) {
    let url=ApiUrl+"/"+id;
    let response = await fetch(url,{
        method: 'DELETE'
     });
}



async function updateUser(id,form) {
    let url=ApiUrl+"/"+id;
    var formData = new FormData(form);

    let response = await fetch(url,{
        method: 'post',
        body: formData,
      });

    if (response.status == 200) {
        return response.json();
    } else {
        throw new Error(response.status);
    }

    let json = await response.json();
    return json;
}


async function createUser(form) {
    let url=ApiUrl;
    var formData = new FormData(form);

    let response = await fetch(url,{
        method: 'POST',
        body:formData
      });

    let json = await response.json();
    return json;

}

const clearHtmlTable=()=> {
    document.querySelector("#table-list tbody").innerHTML = "";
}


const RenderHtmlTable=(items)=> {
    clearHtmlTable();
    let tbody = document.querySelector("#table-list tbody");
    let rows="";
    items.forEach( item=> {
        rows +=`<tr>
                <td>${item.id}</td>
                <td >${item.firstName + ' ' + item.lastName}</td>
                <td>${item.email}</td>
                <td>${item.created_at}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="users/edit/${item.id}" >Edit</a>
                    <a data-id="${item.id}" class="btn-delete btn btn-danger btn-sm" href="delete" >delete</a>
                </td>
              </tr>`;
    });

    tbody.insertAdjacentHTML("afterbegin", rows);

 }

const RenderPagination=(data)=> {
   console.log(data);
   document.querySelector("#search-result-tip").innerHTML="Number of found records: "+data.usersCount;
console.log(data.page);

    let pagination = document.querySelector("#pagination");
    let htm=`<nav aria-label="Page navigation example">
        <ul class="pagination">
          <li class="page-item ${data.page==0 ? 'disabled' : ''}"><a onclick="paginate(event);" class="page-link" href="${parseInt(data.page)-1}">Previous</a></li>
          <li class="page-item"><a class="page-link" href="#">${parseInt(data.page)+1} of ${ data.lastpage}</a></li>
          <li class="page-item ${data.lastpage==parseInt(data.page)+1 ? 'disabled' : ''}"><a onclick="paginate(event);" class="page-link" href="${parseInt(data.page)+ 1}">Next</a></li>
        </ul>
      </nav>`;
      pagination.innerHTML=htm;
 }



 const paginate=(event)=>{
    event.preventDefault();
    let page=event.target.getAttribute("href");
    searchUsers(ApiUrl+"/search?limit="+limitPerPage+"&page="+page)
        .catch(e=>console.log(e))
    .then(data=>{
        RenderPagination(data)
        return RenderHtmlTable( data.users)
    });
}

const RenderHtmlForm=(user)=> {
    const entries = Object.entries(user);
    let el;
    entries.forEach(entry => {
         el=document.getElementById(entry[0]);
         if(el){
             el.value=entry[1];
         }
    });
 }



 document.addEventListener('click', function (event) {

    if ( event.target.classList.contains( 'btn-delete' ) ) {
        event.preventDefault();
        var tr=(event.target.parentNode.parentNode);

        let id=(event.target.getAttribute('data-id'));
        if(confirm("Are You Sure ?")){
            delUser(id)
            .catch(e=>console.log(e))
            .then(data=>{
                  tr.parentNode.removeChild(tr);
              });
        }
    }
}, false);


const Validate =()=>{
    let valid=true;
    document.querySelectorAll('.required').forEach(el=>{
        if(!el.value){
            el.style.buserColor = "red";
            valid= false;
        };
     });
    return valid;
}


if(el=document.querySelectorAll('.required') ) {
    el.forEach(input=>{
        input.addEventListener('keyup', function (event) {
            (this.value.length) < 1 ? this.classList.add("buser-danger") : this.classList.remove("buser-danger") ;
          });
     });
}



if(el=document.getElementById('form-user') ) {
    el.addEventListener('submit', function(e){
        e.preventDefault();
        if(!Validate()) {
            notify("Plese fill the required fields.");
            return ;
        };

        var form = document.querySelector('form');
        var id= parseInt(document.getElementById('id').value);

       if(id) {
          updateUser(id,form)
            .catch(e=>{
              notify("Error while Saving :( ");
              throw e;
          })
            .then(data=>{
               console.log(e);
                notify("Form Saved !");
                   window.location.href = "/users";
            });
       }else {
        createUser(form)
        .catch(e=>console.log(e))
        .then(data=>{
            console.log(data);
            notify("New User Created !");
              window.location.href = "/users";

        });
       }

    })
}


notify=(txt,tp='info')=>{
    alert(txt);
}



if(el=document.getElementById('autocompleteUserFullName') ) {
    el.addEventListener('keyup', function(e){
        let val=e.target.value;
        if(val.length < 1 ) return;
        let autocomplete = document.getElementById('autocompleteUserFullNameList');
        autocomplete.innerHTML="";

        getUsersByName(val)
            .catch(e=>console.log(e))
    .then(data=>{
            console.log(data);
        data.users.forEach( item=> {
            var option = document.createElement('option');
            option.value = item.firstName;
            option.text = item.firstName + ' ' + item.lastName;
            autocomplete.appendChild(option);
            autocomplete.focus();
    })

    });
    })
}


async function getUsersByName(name) {
    var url=baseApiUrl+"/users/search?name="+name;

    let response = await fetch(url);
    if (response.status == 200) {
        let json = await response.json();
        return json;
    }
    throw new Error(response.status);
}



async function getUsersByName(name) {
    let url=ApiUrl+"/search?name="+name;

    let response = await fetch(url);
    if (response.status == 200) {
        let json = await response.json();
        return json;
    }
    throw new Error(response.status);
}



async function searchUsers(url=ApiUrl+"/search?limit="+limitPerPage) {
    var form = document.querySelector('form');
    var formData = new FormData(form);

    let response = await fetch(url,{
        method: 'post',
        body: formData,
    });

    let json = await response.json();
    return json;
}



if(el=document.getElementById('form-search') ) {
    el.addEventListener('submit', function(e){
        e.preventDefault();
        console.log('searching');
        var form = document.querySelector('form');
        searchUsers()
            .catch(e=>console.log(e))
    .then(data=>{
            RenderPagination(data)
            return RenderHtmlTable( data.users)
        });


    })
}
