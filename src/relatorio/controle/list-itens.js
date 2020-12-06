$(document).ready(function() {

    $('#table-relatorio').DataTable({
        "processing": true,
        "serverSide": true,
        "pageLength": 5,
        "lengthMenu": [5, 10, 25, 50],
        "language": {
            "url": "../../../recursos/DataTable/dataTables.brazil.json"
        },
        "ajax": {
            "url": "../modelo/list-relatorio.php",
            "type": "POST"
        },
        "columns": [{
                "data": "id_relatorio",
                "className": 'text-center'
            },
            {
                "data": "data_hora",
                "className": 'text-center'
            },
            {
                "data": "descricao",
                "className": 'text-center'
            },
            {
                "data": "id_professor",
                "className": 'text-center'
            },
            {
                "data": "id_relatorio",
                "className": 'text-center',
                "orderable": false,
                "searchable": false,
                "render": function(data) {
                    return `
                    <button id="${data}" class="btn btn-sm btn-primary btn-visualizar"><i class="fas fa-eye"></i></button>
                    <button id="${data}" class="btn btn-sm btn-warning btn-editar"><i class="fas fa-pencil-alt"></i></button>
                    <button id="${data}" class="btn btn-sm btn-danger btn-deletar"><i class="fas fa-trash"></i></button>
                   `
                }
            }
        ]
    })

})