
const url = 'http://localhost/tiendita/server/public/index.php'

const getProducts = async() =>{
    await $.ajax({
        type: 'GET',
        url: url+'/product'
    }).done(res => {
        console.log(res.listProducts)
        let listProducts = res.listProducts;
        let table = $("#table");
    
        table.append(
        "<tr class='bg-dark text-light'>"+
        +"<th scope='col'></th>"
        +"<th scope='col'>#</th>"
        +"<th scope='col'>Nombre</th>"
        +"<th scope='col'>Precio</th>"
        +"<th scope='col'>Estado</th>"
        +"<th scope='col'>Editar</th>"
        +"<th scope='col'>Borrar</th>"
        +"</tr>")
    
        for(let i = 0; i < listProducts.length; i++){
            table.append("<tr>"
            +"<td>"+listProducts[i].idproduct + "</td>"
            +"<td>"+listProducts[i].name + "</td>"
            +"<td>"+listProducts[i].precio+ "</td>"
            +"<td>"+listProducts[i].status + "</td>"
            +"<td><button class='btn btn-warning' onclick='findById("+listProducts[i].idproduct+")'>Editar</button></td>"
            +"<td><button class='btn btn-danger' onclick='remove("+listProducts[i].idproduct+")'>Borrar</button></td>"
            +"</tr>")
        }
    })
}

const getById = async (id) => {
    await $.ajax({
        type: 'GET',
        url: url+'/product/'+id
    }).done(res => {
        console.log(res);
    });
}

const create = () => {
    let name = document.getElementById("name").value;
    let precio = document.getElementById("precio").value;

    let object = {name, precio};
    console.log(object);

    $.ajax({
        type: 'POST',
        url: url+'/product/create',
        data: object
    }).done(res => {
        console.log(res);
    });
}