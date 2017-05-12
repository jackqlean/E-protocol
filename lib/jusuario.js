$(document).ready(function() {			   
	$('#example').DataTable( {	
		responsive: true,
		"bDeferRender": true,			
		"sPaginationType": "full_numbers",
		"ajax": {
			"url": "fusuarios.php",
        	"type": "POST"
		},					
		"columns": [
			{ "data": "nome" },
			{ "data": "tipo" },
			{ "data": "cpf" },
			{ "data": "sexo" },
			{ "data": "telefone" },
			{ "data": "celular" },
			{ "data": "recados" },
			{ "data": "email" },
			{ "data": "ações"}
			],
		"oLanguage": {
            "sProcessing":     "Processando...",
		    "sLengthMenu": 'Mostrar <select>'+
		        '<option value="10">10</option>'+
		        '<option value="10">10</option>'+
		        '<option value="20">20</option>'+
		        '<option value="30">30</option>'+
		        '<option value="40">40</option>'+
		        '<option value="50">50</option>'+
		        '<option value="-1">All</option>'+
		        '</select> registros',    
		    "sZeroRecords":    "Não foi encontrado resultados",
		    "sEmptyTable":     "Nenhum registro disponível nesta tabela",
		    "sInfo":           "Mostrando de (_START_ de _END_) de um total de _TOTAL_ registros",
		    "sInfoEmpty":      "Mostrando de 0 a 0 de um total de 0 registros",
		    "sInfoFiltered":   "(Filtrado de um total de _MAX_ registros)",
		    "sInfoPostFix":    "",
		    "sSearch":         "Filtrar:",
		    "sUrl":            "",
		    "sInfoThousands":  ",",
		    "sLoadingRecords": "Por favor espere - carregando...",
		    "oPaginate": {
		        "sFirst":    "Primeiro",
		        "sLast":     "Último",
		        "sNext":     "Seguinte",
		        "sPrevious": "Anterior"
		    },
		    "oAria": {
		        "sSortAscending":  ": Ativar para ordenar a coluna de maneira ascendente",
		        "sSortDescending": ": Ativar para ordenar a coluna de maneira descendente"
		    }
        }
	});
});