<?php
include("session.php");
include("funcoes.php");

if (isset($_POST["excluir_index"])) {
    $index = $_POST["excluir_index"];
    if (isset($_SESSION["transacoes"][$index])) {
        unset($_SESSION["transacoes"][$index]);
        $_SESSION["transacoes"] = array_values($_SESSION["transacoes"]);
    }
    header("Location: index.php");
    exit;
}

if (isset($_POST["limpar"])) {
    $_SESSION["transacoes"] = [];
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nome"])) {
    $nome  = trim($_POST["nome"]);
    $valor = (float) $_POST["valor"];
    $tipo  = $_POST["tipo"];

    if ($nome !== "" && $valor > 0) {
        $_SESSION["transacoes"][] = [
            "nome"  => $nome,
            "valor" => $valor,
            "tipo"  => $tipo,
            "data"  => date("d/m/Y H:i")
        ];
    }

    header("Location: index.php");
    exit;
}



$transacoes   = $_SESSION["transacoes"];
$saldo        = calcularSaldo($transacoes);
$totalReceita = totalReceitas($transacoes);
$totalDespesa = totalDespesas($transacoes);
?>
<?php include("includes/header.php"); ?>
<?php include("includes/menu.php"); ?>

<div class="container">
    <h1>Dashboard</h1>

    <div class="cards">
        <div class="card card-saldo <?= $saldo >= 0 ? 'positivo' : 'negativo' ?>">
            <span class="card-label">Saldo Atual</span>
            <span class="card-valor"><?= formatarMoeda($saldo) ?></span>
        </div>
        <div class="card card-receita">
            <span class="card-label">Total Receitas</span>
            <span class="card-valor"><?= formatarMoeda($totalReceita) ?></span>
        </div>
        <div class="card card-despesa">
            <span class="card-label">Total Despesas</span>
            <span class="card-valor"><?= formatarMoeda($totalDespesa) ?></span>
        </div>
    </div>

    <div class="box">
        <h2>Nova Transação</h2>
        <form method="POST">
            <div class="form-group">
                <label>Descrição</label>
                <input type="text" name="nome" placeholder="Ex: Salário, Aluguel..." required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Valor (R$)</label>
                    <input type="number" name="valor" step="0.01" min="0.01" placeholder="0,00" required>
                </div>
                <div class="form-group">
                    <label>Tipo</label>
                    <select name="tipo">
                        <option value="despesa">Despesa</option>
                        <option value="receita">Receita</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn">Adicionar Transação</button>
        </form>
    </div>

    <?php if (count($transacoes) > 0): ?>
    <div class="box">
        <div class="box-header">
            <h2>Últimas Transações</h2>
            <form method="POST" onsubmit="return confirm('Tem certeza que deseja zerar o mês?')">
                <button type="submit" name="limpar" class="btn btn-perigo">Zerar Mês</button>
            </form>
        </div>

        <table class="tabela">
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Tipo</th>
                    <th>Valor</th>
                    <th>Data</th>
                    <th class="col-acoes">Ações</th> </tr>
                </tr>
            </thead>
            <tbody>
                <?php 
                $lista_invertida = array_reverse($_SESSION["transacoes"], true); 
                foreach ($lista_invertida as $index => $t): 
                ?>
                <tr>
                    <td><?= htmlspecialchars($t["nome"]) ?></td>
                    <td>
                        <span class="badge <?= $t["tipo"] ?>">
                            <?= $t["tipo"] === "receita" ? "Receita" : "Despesa" ?>
                        </span>
                    </td>
                    <td class="<?= $t["tipo"] ?>">
                        <?= $t["tipo"] === "receita" ? "+" : "-" ?> <?= formatarMoeda($t["valor"]) ?>
                    </td>
                    <td><?= $t["data"] ?? "-" ?></td>
                    <td class="col-acoes">
                        <form method="POST" class="form-excluir" onsubmit="return confirm('Excluir esta transação?')">
                            <input type="hidden" name="excluir_index" value="<?= $index ?>">
                            <button type="submit" class="btn-deletar" title="Excluir">
                                &times;
                            </button>
                        </form>
                    </td>
                </tr>
                
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <div class="box vazio">
        <p>Nenhuma transação registrada ainda. Adicione uma acima! 👆</p>
    </div>
    <?php endif; ?>
</div>

<?php include("includes/footer.php"); ?>
