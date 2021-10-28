
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
        +"<th scope='col' class='text-center'>Detalles</th>"
        +"<th scope='col' class='text-center'>Editar</th>"
        +"<th scope='col' class='text-center'>Borrar</th>"
        +"</tr>")
    
        for(let i = 0; i < listProducts.length; i++){
            table.append("<tr>"
            +"<td>"+listProducts[i].idproduct + "</td>"
            +"<td>"+listProducts[i].name + "</td>"
            +"<td>"+listProducts[i].precio+ "</td>"
            +"<td>"+listProducts[i].status + "</td>"
            +"<td class='text-center'><button class='btn btn-primary' data-toggle='modal' data-target='#details' onclick='getDetailsById("+listProducts[i].idproduct+")'><i class='fas fa-info-circle'></i></button></td>"
            +"<td class='text-center'><button class='btn btn-warning'  onclick='getById("+listProducts[i].idproduct+")'><i class='far fa-edit'></i></button></td>"
            +"<td class='text-center'><button class='btn btn-danger' onclick='remove("+listProducts[i].idproduct+")'><i class='far fa-trash-alt'></i></button></td>"
            +"</tr>")
        }
    })
}

const getById = async (id) => {
    return await $.ajax({
        type: 'GET',
        url: url+'/product/'+id
    }).done(res => res);
}

const getDetailsById = async (id) => {
    let product = await getById(id);
    let name = document.getElementById('name').value = product.product[0].name;
    let precio = document.getElementById('precio').value = product.product[0].precio;
    let status = document.getElementById('status').value = product.product[0].status ? "Activo" : "Inactivo";
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