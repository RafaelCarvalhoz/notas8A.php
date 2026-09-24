<?php
/*
  EXPLICAÇÃO DO FOREACH:
  O primeiro foreach percorre cada aluno (chave) e seu array de notas (valor) na matriz de dados.
  O segundo foreach (aninhado) percorre individualmente as 4 notas do aluno atual para somá-las.
  Assim, conseguimos iterar pela estrutura bidimensional sem precisar saber o tamanho exato do array.
*/

// Array bidimensional com 5 alunos e suas notas dos 4 bimestres
$turma8A = [
    "Ana Clara"      => [7.5, 8.0, 6.5, 9.0],
    "Bruno Henrique" => [5.0, 4.5, 6.0, 5.5],
    "Carla Souza"    => [9.0, 9.5, 8.5, 10.0],
    "Diego Lima"     => [6.0, 5.5, 7.0, 6.5],
    "Eduardo Santos" => [4.0, 5.0, 3.5, 6.0]
];

// Array auxiliar para armazenar o processamento completo dos dados
$dadosProcessados = [];
$somaMediasTurma = 0;

// Processamento dos dados e cálculo das médias
foreach ($turma8A as $nome => $notas) {
    $somaNotas = 0;
    foreach ($notas as $nota) {
        $somaNotas += $nota;
    }
    
    $media = $somaNotas / count($notas);
    $somaMediasTurma += $media;

    $dadosProcessados[] = [
        "nome"   => $nome,
        "notas"  => $notas,
        "media"  => $media
    ];
}

// Atividade 1: Ordenar a tabela da maior para a menor média
usort($dadosProcessados, function ($a, $b) {
    return $b['media'] <=> $a['media'];
});

// Atividade 2: Cálculo da média geral da turma
$mediaGeralTurma = $somaMediasTurma / count($turma8A);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Notas - 8º Ano A</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background-color: #f4f6f9;
        }
        h2 {
            color: #333;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 700px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 10px;
        }
        th {
            background-color: #2c3e50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .nome {
            text-align: left;
            font-weight: bold;
        }
        .aprovado {
            color: #27ae60;
            font-weight: bold;
        }
        .reprovado {
            color: #c0392b;
            font-weight: bold;
        }
        .linha-geral {
            background-color: #ecf0f1;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h2>Boletim Escolar - 8º Ano A</h2>

    <table>
        <thead>
            <tr>
                <th>Aluno</th>
                <th>1º Bim</th>
                <th>2º Bim</th>
                <th>3º Bim</th>
                <th>4º Bim</th>
                <th>Média</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dadosProcessados as $aluno): ?>
                <?php 
                    // Formatação com 1 casa decimal e definição da cor da média
                    $mediaFormatada = number_format($aluno['media'], 1, ',', '.');
                    $classeEstilo = ($aluno['media'] >= 6.0) ? 'aprovado' : 'reprovado';
                ?>
                <tr><td class="nome"><?= $aluno['nome'] ?></td>
                    <td class="nome"><?= $aluno['nome'] ?></td>
                    <td><?= number_format($aluno['notas'][0], 1, ',', '.') ?></td>
                    <td><?= number_format($aluno['notas'][1], 1, ',', '.') ?></td>
                    <td><?= number_format($aluno['notas'][2], 1, ',', '.') ?></td>
                    <td><?= number_format($aluno['notas'][3], 1, ',', '.') ?></td>
                    <td class="<?= $classeEstilo ?>"><?= $mediaFormatada ?></td>
                </tr>
            <?php endforeach; ?>
            
            <!-- Linha final com a média geral da turma -->
            <tr class="linha-geral">
                <td colspan="5" style="text-align: right;">Média Geral da Turma:</td>
                <td><?= number_format($mediaGeralTurma, 1, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>

</body>
</html>