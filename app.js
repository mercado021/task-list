$(document).ready(function(){
   // console.log('Jquery is working');
    fetchtask();
    let edit = false;
    $('#task-result').hide();

    //Se ejecutará esta función cada vez que se escriba una letra con en el input con id=search
    $('#search').keyup(function(){
        //si la casilla tiene algún valor se hace la busqueda
        if ($('#search').val().length >0){
            //se guarda la palabra completa en la variable search
            let search = $('#search').val();

           //$.ajax() envía la petición. y la procesa dentro de function(response){}
           $.ajax(
               {
                   url: 'task-search.php',
                   type: 'POST',
                   data: {search:search},
                   success: function(response){
                       let tasks = JSON.parse(response);
                       let template = '';
    
                       tasks.forEach(element => {
                           //console.log(tasks);
                            template += `<li>${element.name}</li>`    
                        });
    
                        $('#task-result').show();
                        $('#container').html(template);
                   }
               }
           )         
        }
        else{
            $('#task-result').hide();
        }
    })

    $('#task-form').submit(function(e){
        let postdata = {
            name: $('#nombre').val(),
            descriptcion: $('#description').val(),
            id: $('#taskId').val()
        }
        
        //Se verifica si la variable Edit es true o false para identificar
        //si es un nuevo elemento o si se va a editar uno existente.
        //creamos la variable url saber a que archivo del servidor mandar

        let url = edit === false ? 'task-add.php' : 'task-edit.php';
        //Esta es otra forma de mandar los datos al servidor con Ajax
        console.log(url)
        $.post(url,postdata, function (response) {
            console.log(response);
            $('#task-form').trigger('reset');
            fetchtask();
            edit= false;
        });
        e.preventDefault();
        
    })

    function fetchtask(){
        $.ajax({
            url: 'task-list.php',
            type: 'GET',
            success: function(response){
                let tasks = JSON.parse(response);
                let template ="";
                tasks.forEach(tarea=> {
                    template += `
                <tr taskID="${tarea.id}">
                    <td >${tarea.id}</td>
                    <td>
                        <a href="#" class="task-item">${tarea.name}</a>
                    </td>
                    <td>${tarea.descripcion}</td>
                    <td>
                        <button class="task-delete btn btn-danger">
                            Delete
                        </button>
                    </td>

                </tr>
                `
                });
                $('#task').html(template)
            }
        })
    }

    $(document).on('click', '.task-delete', function () {
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('taskID');
        if(confirm('estás seguro de querer eliminar el elemento '+ id)) {
            //console.log(id);
            $.post('task-delete.php',{id:id}, function(response) {
                // console.log(response);
                fetchtask();
            })
        }
    })

    $(document).on('click','.task-item', function(){
        let element = $(this)[0].parentElement.parentElement
        let id = $(element).attr('taskID')
        $.post('task-single.php',{id:id}, function(response) {
            console.log(response)
            const task = JSON.parse(response);
            $('#nombre').val(task.name);
            $('#description').val(task.description);
            $('#taskId').val(task.id);
            edit = true;
        })
    })


})