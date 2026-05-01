<?php

function calcularSaldo($transacoes) {
    $saldo = 0;
    foreach ($transacoes as $t) {
        if ($t["tipo"] === "receita") {
            $saldo += $t["valor"];
        } else {
            $saldo -= $t["valor"];
        }
    }
    return $saldo;
}

function totalDespesas($transacoes) {
    $total = 0;
    foreach ($transacoes as $t) {
        if ($t["tipo"] === "despesa") {
            $total += $t["valor"];
        }
    }
    return $total;
}

function totalReceitas($transacoes) {
    $total = 0;
    foreach ($transacoes as $t) {
        if ($t["tipo"] === "receita") {
            $total += $t["valor"];
        }
    }
    return $total;
}

function percentual($valor, $total) {
    if ($total == 0) return 0;
    return ($valor / $total) * 100;
}

function formatarMoeda($valor) {
    return "R$ " . number_format($valor, 2, ',', '.');
}