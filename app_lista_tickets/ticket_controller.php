<?php

	require "../../app_lista_tickets/ticket.model.php";
	require "../../app_lista_tickets/ticket.service.php";
	require "../../app_lista_tickets/conexao.php";


	$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

	if($acao == 'inserir' ) {
		$ticket = new ticket();
		$ticket->__set('ticket', $_POST['ticket']);

		$conexao = new Conexao();

		$ticketservice = new TicketService($conexao, $ticket);
		$ticketservice->inserir();

		header('Location: novo_ticket.php?inclusao=1');
	
	} else if($acao == 'recuperar') {
		
		$ticket = new ticket();
		$conexao = new Conexao();

		$ticketservice = new TicketService($conexao, $ticket);
		$tickets = $ticketservice->recuperar();
	
	} else if($acao == 'atualizar') {

		$ticket = new ticket();
		$ticket->__set('id', $_POST['id'])
			->__set('ticket', $_POST['ticket']);

		$conexao = new Conexao();

		$ticketservice = new TicketService($conexao, $ticket);
		if($ticketservice->atualizar()) {
			
			if( isset($_GET['pag']) && $_GET['pag'] == 'index') {
				header('location: index.php');	
			} else {
				header('location: todas_tickets.php');
			}
		}


	} else if($acao == 'remover') {

		$ticket = new ticket();
		$ticket->__set('id', $_GET['id']);

		$conexao = new Conexao();

		$ticketservice = new TicketService($conexao, $ticket);
		$ticketservice->remover();

		if( isset($_GET['pag']) && $_GET['pag'] == 'index') {
			header('location: index.php');	
		} else {
			header('location: todas_tickets.php');
		}
	
	} else if($acao == 'marcarRealizada') {

		$ticket = new ticket();
		$ticket->__set('id', $_GET['id'])->__set('id_status', 2);

		$conexao = new Conexao();

		$ticketservice = new TicketService($conexao, $ticket);
		$ticketservice->marcarRealizada();

		if( isset($_GET['pag']) && $_GET['pag'] == 'index') {
			header('location: index.php');	
		} else {
			header('location: todas_tarefas.php');
		}
	
	} else if($acao == 'recuperarTarefasPendentes') {
		$ticket = new ticket();
		$ticket->__set('id_status', 1);
		
		$conexao = new Conexao();

		$ticketservice = new TicketService($conexao, $ticket);
		$tickets = $ticketservice->recuperarTicketsPendentes();
	}


?>