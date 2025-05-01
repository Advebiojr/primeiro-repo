<?php
session_start();
include 'conexaoDB.php';

if (isset($_POST['resuldado'])) {
  $valor_principal = $_POST['valor_principal'] ?? null;
  $taxa_juros = $_POST['taxa_juros'] ?? null;
  $tempo = $_POST['tempo'] ?? null;




  try {
    // Insere os dados no banco
    $sql = "INSERT INTO historico_calculos 
                        (valor_principal, taxa_juros, tempo) VALUES (:valor_principal, :taxa_juros, :tempo)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
      'valor_principal' => $valor_principal,
      'taxa_juros' => $taxa_juros,
      'tempo' => $tempo
    ]);

    echo 'Cálculo salvo com sucesso!';
  } catch (PDOException $e) {
    echo 'Erro ao salvar o cálculo: ' . $e->getMessage();
    exit();
  }
} else {
  echo 'Por favor, preencha todos os campos obrigatórios corretamente.';
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
  <script src="home.js"></script>
</head>

<div class="main">
  <div class="convert">
    <h3>Conversor</h3><br>
    <label>De:</label>

    <select id="fromCurrency" class="opcao">


      <option value="BRL">Real Brasileiro</option>


      <option value="USD">Dólar Americano</option>




      <option value="EUR">Euro</option>


    </select><br><br>




    <label>Para:</label>
    <select id="toCurrency" class="opcao">
      <option value="BRL">Real Brasileiro</option>


      <option value="USD">Dólar Americano</option>


      <option value="EUR">Euro</option>


    </select><br><br>



    <label>Valor:</label>


    <input type="text" class="result" id="amount" placeholder="Digite o valor"><br><br>





    <div class="botao">
      <button onclick="convert()">Converter</button><br><br>
    </div>
    <h3 id="result">Resultado: </h3>
  </div>

  <div class="Cambio">
    <h2>Cambio em relação ao Real</h2>

    <table border="1">
      <thead>
        <tr>
          <th>Moeda</th>
          <th>1 Semana</th>
          <th>1 Mês</th>
          <th>1 Ano</th>
        </tr>
      </thead>
      <tbody>
        <tr class="dark">
          <td><a href="https://www.google.com/finance/quote/USD-BRL?sa=X&ved=2ahUKEwiHzPK26baJAxU0I7kGHfoRFHQQmY0JegQIIxAw"> Americano </a></td>
          <td class="up">+1,06%</td>
          <td class="up">+1,12%</td>
          <td class="down">-6,36%</td>
        </tr>
        <tr>
          <td><a href="https://www.google.com/finance/quote/EUR-BRL?sa=X&ved=2ahUKEwjzx_Kk77aJAxUqgWEGHa21HnMQmY0JegQIARAs"> Euro </a></td>
          <td class="up">+1,60%</td>
          <td class="up">+3,28%</td>
          <td class="up">+16,94%</td>
        </tr>
        <tr class="dark">
          <td><a href="https://www.google.com/finance/quote/JPY-BRL?sa=X&ved=2ahUKEwiloZnu7raJAxXtO7kGHSMTATUQmY0JegQIARAs"> Japonês</a></td>
          <td class="up">+0,28%</td>
          <td class="down">-0,99%</td>
          <td class="up">+11,06%</td>

        </tr>
        <tr>
          <td><a href="https://www.google.com/finance/quote/CNY-BRL?sa=X&ved=2ahUKEwiPwojon7mJAxVxpZUCHROtItoQmY0JegQIIBAw"> Chinês </a></td>
          <td class="up">+1,38%</td>
          <td class="up">+4,63%</td>
          <td class="up">+15,92%</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<body>
  <header>
    <h1>Calculadora de Juros</h1>

    <h2>"O juro simples e o juro composto são ambos praticados no mercado. Eles se diferem pelo fato de que no juro simples, o valor a ser acrescentado ao capital a cada período é sempre o mesmo, entretanto, no juro composto, a cada período que passa, o valor acrescentado ao capital é maior. A fórmula do juro composto é:

      M=C(1+i)t
      𝑀
      =
      𝐶
      (
      1
      +
      𝑖
      )
      𝑡

      A diferença é que no juro composto há a incidência de juro sobre juro, sendo o capital e a taxa os mesmos. No primeiro período, o valor do juro será o mesmo, entretanto, a partir do segundo, o juro composto gera um montante maior.  "

    </h2>
  </header>

  <section id="juros-simples" class="section">
    <h2>Juros Simples</h2>
    <div class="flex-container">
      <form id="form-simples" method="POST" action="">
        <label for="capital-simples">Capital (R$):</label>
        <input type="number" id="capital-simples" name="valor_principal" required>

        <label for="taxa-simples">Taxa de Juros (%):</label>
        <input type="number" id="taxa-simples" name="taxa_juros" required>

        <label for="tempo-simples">Tempo (meses):</label>
        <input type="number" id="tempo-simples" name="tempo">

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
        <input type="number" id="capital-compostos" name="valor_principal2" required>

        <label for="taxa-compostos">Taxa de Juros (%):</label>
        <input type="number" id="taxa-compostos" name="taxa_juros2">

        <label for="tempo-compostos">Tempo (meses):</label>
        <input type="number" id="tempo-compostos" name="tempo2" required>

        <button type="button" onclick="calcularJurosCompostos()">Calcular</button>
        <button type="submit" name="resuldado2">salvar</button>
      </form>
      <canvas id="grafico-compostos"></canvas>
    </div>
    <div id="resultado-compostos"></div>
  </section>

  <script src="script.js"></script>
</body>

</html>