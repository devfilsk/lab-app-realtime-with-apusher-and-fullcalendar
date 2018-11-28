<?php

header("Content-Type: application/json");

require "conexao.php";

$nome = $_POST['nome'] ?? null;
$inicio = $_POST['inicio'] ?? null;
$fim = $_POST['fim'] ?? null;

if(!empty($nome) && !empty($inicio) && !empty($fim)){
    $sql = "INSERT INTO agendamentos (`nome`, `inicio`, `fim`) VALUES (:nome, :inicio, :fim)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':inicio', $inicio);
    $stmt->bindParam(':fim', $fim);

    $res = $stmt->execute();

    $retorno = [];
    if($res){
        $retorno['status'] = "success";
        $retorno['mensagem'] = "Agendamento realizado com seucesso";

        //Estes campos são obrigatórios devido ao fullcalendar exigir um json de retorno com eles
        $retorno['id'] = $conn->lastInsertId();
        $retorno['title'] = $nome;
        $retorno['start'] = $inicio;
        $retorno['end'] = $fim;
    }else{
        $retorno['status'] = "fail";
        $retorno['mensagem'] = "Ocorreu um erro ao salvar o agendamento";
    }

}else{
    $retorno['status'] = "fail";
    $retorno['mensagem'] = "É necessário um nome para o compromisso!";
}
echo json_encode($retorno);
exit;
?>