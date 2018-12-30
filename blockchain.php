<?php
//Funcionamento em código de blockchain simplificada
//Autor: Gustavo Duregger
//Observacoes:
//1.Linguagem utilizada-> PHP
//2.Para testar a blockchain procure modificar alguma informação dentro do bloco e verifique a mudança do hash de toda cadeia
//2.Por se tratar de uma blockchain simplificada, posui processos limitados
//3.O codigo é totalmente livre para fins educacionais
//4.Existem outros exemplos de Blockchain em outras linguagens no GITHUB

//Blockchain
$blockchain = array();

//bloco 1 
$bloco_1 = [
	"transacoes" => "Gustavo",
	"destinatario" => "Joao",
	"mensagem" => "2 BRL"
	],
	[
		"remetente" => "Pedro",
		"destinatário" => "Gustavo"
		"mensagem" => "5 BRL"
	],
	[
		"remetente" => "Maria",
		"destinatário" => "Jose"
		"mensagem" => "2.5 BRL"
	]
];

//bloco 2 
$bloco_2 = [
	"transacoes" => [
	[
		"remetente" => "Gustavo",
		"destinatário" => "Joao"
		"mensagem" => "1 BRL"
	],
	[
		"remetente" => "Maria",
		"destinatário" => "Jose"
		"mensagem" => "5 BRL"
	]
];

//bloco 3 
$bloco_3 = [
	"transacoes" => [
	[
		"remetente" => "Gustavo",
		"destinatário" => "Joao"
		"mensagem" => "1 BRL"
	],
	
//bloco 4 
$bloco_4 = [
	"transacoes" => [
	[
		"remetente" => "Gustavo",
		"destinatário" => "Joao"
		"mensagem" => "1 BRL"
	],
	[
		"remetente" => "Pedro",
		"destinatário" => "Gustavo"
		"mensagem" => "30 BRL"
	]
];

//bloco 5 
$bloco_5 = [
	"transacoes" => [
	[
		"remetente" => "Gustavo",
		"destinatário" => "Joao"
		"mensagem" => "2 BRL"
	],
	[
		"remetente" => "Pedro",
		"destinatário" => "Gustavo"
		"mensagem" => "3 BRL"
	]
];

//criacao de novos blocos
fuction adicionaBloco($bloco_novo){
	global $blockchain;
	//validacao caso esteja vazio
	//bloco genesis -- cricacao do hash dele mesmo
	if($blockchain == array()){
		$bloco_novo["hash"] = hash("sha256", json_encode($bloco_novo));
	}else{
		$ultimo_bloco = end($blockchain);
		$bloco_novo["hash"] = $ultimo_bloco["hash"];
		$bloco_novo["hash"] = hash("sha256", json_encode($bloco_novo));
	}
	array_push($blockchain, $bloco_novo);
	}

//insirir blocos
	adicionaBloco($bloco_1);
	adicionaBloco($bloco_2);
	adicionaBloco($bloco_3);
	adicionaBloco($bloco_4);
	adicionaBloco($bloco_5);

//corrente final
echo "<h1>Blockchain</h1>";
foreach ($blockchain as $key => $bloco)(
	$posicao = $key + 1;
	echo 'bloco #'.$posicao.' - ' .$bloco['hash']. '<br/>';
	foreach ($bloco['transacoes'] as $trasacao){
		echo " - Tx: ".$trasacao['remetente']." -> ".$transacao['destinatario']. " - "
			.$transacao["mensagem"]. "<br/>";
		}
		echo "<br/><br/>";
	}
exit;

?>
