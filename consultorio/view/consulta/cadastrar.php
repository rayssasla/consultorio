
<?php
use App\Paciente;
use App\Funcionario;
include('../includes/cabecalho.php');
include('../includes/menu.php');
include('../includes/rodape.php');
$pacientes = Paciente::listar();
$dentistas = Funcionario::listar("perfil = 'dentista'");
?>
<main class="container">
    <h1>Cadastrar Consulta</h1>
    <form method="POST" action="/consultorio/action/action_consulta.php?action=cadastrar">
        Paciente * : <select name="paciente_id" class="form-select" required>
            <option value="">Selecione o Paciente</option>
            <?php
            foreach ($pacientes as $paciente) {
                echo "<option value='" . $paciente->id . "'>" . $paciente->nome . "</option>";
            }
            ?>
        </select>
        Dentista * : <select name="dentista_id" class="form-select" required>
            <option value="">Selecione o Dentista</option>
            <?php
            foreach ($dentistas as $dentista) {
                echo "<option value='" . $dentista->id . "'>" . $dentista->nome . "</option>";
            }
            ?>
        </select>
        Data e Hora * : <input name="data_hora" type="datetime-local" class="form-control" required>
        Valor Total * : <input name="valor_total" type="number" step="0.01" value="0.00" class="form-control" required>
        Valor Pago * : <input name="valor_pago" type="number" step="0.01" value="0.00" class="form-control" required>
        Forma de Pagamento * : <select name="forma_pagamento" class="form-select" required>
            <option value="">Selecione a Forma de Pagamento</option>
            <option value="DINHEIRO">Dinheiro</option>
            <option value="PIX">Pix</option>
            <option value="CARTÃO DE DEBITO">Cartão de Débito</option>
            <option value="CARTÃO DE CREDITO">Cartão de Crédito</option>
        </select>
        Procedimentos Realizados : <input name="procedimentos_realizados" type="text" class="form-control">
        Procedimentos a Realizar : <input name="procedimentos_arealizar" type="text" class="form-control">
        Descrição : <input name="descricao" type="text" class="form-control">
        Medicação : <input name="medicacao" type="text" class="form-control">
        <input type="submit" value="Cadastrar" class="btn btn-primary">
    </form>
    <div class="pb-5"></div>
</main>