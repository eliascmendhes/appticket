<?php

	$acao = 'recuperarTicketPendentes';
	require 'ticket_controller.php';

	/*
	echo '<pre>';
	
	echo '</pre>';
	*/

?>

<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App tickets</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

		<script>
			function editar(id, txt_ticket) {

				//criar um form de edição
				let form = document.createElement('form')
				form.action = 'index.php?pag=index&acao=atualizar'
				form.method = 'post'
				form.className = 'row'

				//criar um input para entrada do texto
				let inputticket = document.createElement('input')
				inputticket.type = 'text'
				inputticket.name = 'ticket'
				inputticket.className = 'col-9 form-control'
				inputticket.value = txt_ticket

				//criar um input hidden para guardar o id da ticket
				let inputId = document.createElement('input')
				inputId.type = 'hidden'
				inputId.name = 'id'
				inputId.value = id

				//criar um button para envio do form
				let button = document.createElement('button')
				button.type = 'submit'
				button.className = 'col-3 btn btn-info'
				button.innerHTML = 'Atualizar'

				//incluir inputticket no form
				form.appendChild(inputticket)

				//incluir inputId no form
				form.appendChild(inputId)

				//incluir button no form
				form.appendChild(button)

				//teste
				//console.log(form)

				//selecionar a div ticket
				let ticket = document.getElementById('ticket_'+id)

				//limpar o texto da ticket para inclusão do form
				ticket.innerHTML = ''

				//incluir form na página
				ticket.insertBefore(form, ticket[0])

			}

			function remover(id) {
				location.href = 'index.php?pag=index&acao=remover&id='+id;
			}

			function marcarRealizada(id) {
				location.href = 'index.php?pag=index&acao=marcarRealizada&id='+id;
			}
		</script>

	</head>

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista ticket
				</a>
			</div>
		</nav>

		<div class="container app">
			<div class="row">
				<div class="col-md-3 menu">
					<ul class="list-group">
						<li class="list-group-item active"><a href="#">Tickets pendentes</a></li>
						<li class="list-group-item"><a href="nova_ticket.php">Novo Ticket</a></li>
						<li class="list-group-item"><a href="todas_tickets.php">Todos os Tickets</a></li>
					</ul>
				</div>

				<div class="col-md-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Tickets pendentes</h4>
								<hr />

								<? foreach($ticket as $indice => $ticket) { ?>
									<div class="row mb-3 d-flex align-items-center ticket">
										<div class="col-sm-9" id="ticket_<?= $ticket->id ?>">
											<?= $ticket->ticket ?>
										</div>
										<div class="col-sm-3 mt-2 d-flex justify-content-between">
											<i class="fas fa-trash-alt fa-lg text-danger" onclick="remover(<?= $ticket->id ?>)"></i>
											<i class="fas fa-edit fa-lg text-info" onclick="editar(<?= $ticket->id ?>, '<?= $ticket->ticket ?>')"></i>
											<i class="fas fa-check-square fa-lg text-success" onclick="marcarRealizada(<?= $ticket->id ?>)"></i>
										</div>
									</div>

								<? } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>