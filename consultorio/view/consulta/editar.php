<?php
use App\Consulta;
use App\Paciente;
use App\Funcionario;
include('../includes/cabecalho.php');
include('../includes/menu.php');
include('../includes/rodape.php');
$id = $_GET['id'];
$consulta = Consulta::buscarPorId($id);
$pacientes = Paciente::listar();
$dentistas = Funcionario::listar("perfil = 'dentista'");
$formas = ['DINHEIRO', 'PIX', 'CARTÃO DE DEBITO', 'CARTÃO DE CREDITO'];
?>
<main class="container">
    <h1>Editar Consulta</h1>
    <form method="POST" action="/consultorio/action/action_consulta.php?action=alterar&id=<?= $id ?>">
        Paciente * : <select name="paciente_id" class="form-select" required>
            <?php
            foreach ($pacientes as $paciente) {
                $selecionado = ($paciente->id == $consulta->paciente_id) ? 'selected' : '';
                echo "<option value='" . $paciente->id . "' " . $selecionado . ">" . $paciente->nome . "</option>";
            }
            ?>
        </select>
        Dentista * : <select name="dentista_id" class="form-select" required>
            <?php
            foreach ($dentistas as $dentista) {
                $selecionado = ($dentista->id == $consulta->dentista_id) ? 'selected' : '';
                echo "<option value='" . $dentista->id . "' " . $selecionado . ">" . $dentista->nome . "</option>";
            }
            ?>
        </select>
        Data e Hora * : <input name="data_hora" type="datetime-local" value="<?= date('Y-m-d\TH:i', strtotime($consulta->data_hora)) ?>" class="form-control" required>
        Valor Total * : <input name="valor_total" type="number" step="0.01" value="<?= $consulta->valor_total ?>" class="form-control" required>
        Valor Pago * : <input name="valor_pago" type="number" step="0.01" value="<?= $consulta->valor_pago ?>" class="form-control" required>
        Forma de Pagamento * : <select name="forma_pagamento" class="form-select" required>
            <?php
            foreach ($formas as $forma) {
                $selecionado = ($forma == $consulta->forma_pagamento) ? 'selected' : '';
                echo "<option value='" . $forma . "' " . $selecionado . ">" . $forma . "</option>";
            }
            ?>
        </select>
        Procedimentos Realizados : <input name="procedimentos_realizados" type="text" value="<?= $consulta->procedimentos_realizados ?>" class="form-control">
        Procedimentos a Realizar : <input name="procedimentos_arealizar" type="text" value="<?= $consulta->procedimentos_arealizar ?>" class="form-control">
        Descrição : <input name="descricao" type="text" value="<?= $consulta->descricao ?>" class="form-control">
        Medicação : <input name="medicacao" type="text" value="<?= $consulta->medicacao ?>" class="form-control">
        <input type="submit" value="Editar" class="btn btn-primary">
    </form>
    <div class="pb-5"></div>
</main>
