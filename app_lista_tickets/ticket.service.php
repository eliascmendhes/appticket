<?php


//CRUD
class TicketService {

	private $conexao;
	private $ticket;

	public function __construct(Conexao $conexao, Ticket $ticket) {
		$this->conexao = $conexao->conectar();
		$this->ticket = $ticket;
	}

	public function inserir() { //create
		$query = 'insert into tb_ticket(ticket)values(:ticket)';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':ticket', $this->ticket->__get('ticket'));
		$stmt->execute();
	}

	public function recuperar() { //read
		$query = '
			select 
				t.id, s.status, t.ticket 
			from 
				tb_tickets as t
				left join tb_status as s on (t.id_status = s.id)
		';
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function atualizar() { //update

		$query = "update tb_tickets set ticket = ? where id = ?";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->ticket->__get('ticket'));
		$stmt->bindValue(2, $this->ticket->__get('id'));
		return $stmt->execute(); 
	}

	public function remover() { //delete

		$query = 'delete from tb_tickets where id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id', $this->ticket->__get('id'));
		$stmt->execute();
	}

	public function marcarRealizada() { //update

		$query = "update tb_tickets set id_status = ? where id = ?";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->ticket->__get('id_status'));
		$stmt->bindValue(2, $this->ticket->__get('id'));
		return $stmt->execute(); 
	}

	public function recuperarTicketPendentes() {
		$query = '
			select 
				t.id, s.status, t.ticket 
			from 
				tb_ticket as t
				left join tb_status as s on (t.id_status = s.id)
			where
				t.id_status = :id_status
		';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id_status', $this->ticket->__get('id_status'));
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
}

?>