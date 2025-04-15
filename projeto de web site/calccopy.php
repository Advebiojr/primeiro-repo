<?php
session_start();
include 'conexaoDB.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $valor_principal = $_POST['valor_principal'] ?? null;
  $taxa_juros = $_POST['taxa_juros'] ?? null;
  $tempo = $_POST['tempo'] ?? null;
  $resultado = $_POST['resultado'] ?? null;

  // Valida os dados obrigatórios
  if (($valor_principal) && is_numeric($taxa_juros) && is_numeric($tempo) && is_numeric($resultado)) {
    try {
      // Insere os dados no banco
      $sql = "INSERT INTO historico_calculos 
                        (valor_principal, taxa_juros, tempo, resultado) 
                    VALUES 
                        (:valor_principal, :taxa_juros, :tempo, :resultado)";
      $stmt = $conn->prepare($sql);

      // Substitui os placeholders pelos valores recebidos
      $stmt->execute([
        'valor_principal' => $valor_principal,
        'taxa_juros' => $taxa_juros,
        'tempo' => $tempo,
        'resultado' => $resultado
      ]);

      echo 'Cálculo salvo com sucesso!';
    } catch (PDOException $e) {
      echo 'Erro ao salvar o cálculo: ' . $e->getMessage();
    }
  } else {
    echo 'Por favor, preencha todos os campos obrigatórios corretamente.';
  }
} else {
  echo 'Nenhum formulário enviado.';
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calculadora de Juros</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
  <header>
    <h1>Calculadora de Juros</h1>
  </header>

  <section id="juros-simples" class="section">
    <h2>Juros Simples</h2>
    <div class="flex-container">
      <form id="form-simples" method="post" action="">
        <label for="capital-simples">Capital (R$):</label>
        <input type="number" id="capital-simples" required>

        <label for="taxa-simples">Taxa de Juros (%):</label>
        <input type="number" id="taxa-simples" required>

        <label for="tempo-simples">Tempo (meses):</label>
        <input type="number" id="tempo-simples" required>

        <button type="button" onclick="calcularJurosSimples()">Calcular</button>
        <button type="submit" name="resuldado">salvar</button>
      </form>
      <canvas id="grafico-simples"></canvas>
    </div>
    <div id="resultado-simples"></div>
  </section>

  <section id="juros-compostos" class="section">
    <h2>Juros Compostos</h2>
    <div class="flex-container">
      <form id="form-compostos">
        <label for="capital-compostos">Capital (R$):</label>
        <input type="number" id="capital-compostos" required>

        <label for="taxa-compostos">Taxa de Juros (%):</label>
        <input type="number" id="taxa-compostos" required>

        <label for="tempo-compostos">Tempo (meses):</label>
        <input type="number" id="tempo-compostos" required>

        <button type="button" onclick="calcularJurosCompostos()">Calcular</button>
      </form>
      <canvas id="grafico-compostos"></canvas>
    </div>
    <div id="resultado-compostos"></div>
  </section>

  <script src="script.js"></script>
</body>

</html>