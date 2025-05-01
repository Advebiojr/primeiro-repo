let graficoSimples = null;
let graficoCompostos = null;

function criarGrafico(idCanvas, labels, dados) {
  const ctx = document.getElementById(idCanvas).getContext('2d');
  
  if (idCanvas === 'grafico-simples' && graficoSimples) {
    graficoSimples.destroy();
  } else if (idCanvas === 'grafico-compostos' && graficoCompostos) {
    graficoCompostos.destroy();
  }

  const novoGrafico = new Chart(ctx, {
    type: 'line', 
    data: {
      labels: labels,
      datasets: [{
        label: 'Valores (R$)',
        data: dados,
        backgroundColor: 'rgba(76, 175, 80, 0.2)', 
        borderColor: '#4caf50', 
        borderWidth: 2,
        fill: true 
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  if (idCanvas === 'grafico-simples') {
    graficoSimples = novoGrafico;
  } else if (idCanvas === 'grafico-compostos') {
    graficoCompostos = novoGrafico;
  }
}

function calcularJurosSimples() {
  const capital = parseFloat(document.getElementById('capital-simples').value);
  const taxa = parseFloat(document.getElementById('taxa-simples').value) / 100;
  const tempo = parseInt(document.getElementById('tempo-simples').value);

  if (!capital || !taxa || !tempo) {
    alert('Por favor, preencha todos os campos.');
    return;
  }

  const juros = capital * taxa * tempo;
  const montante = capital + juros;

  document.getElementById('resultado-simples').textContent = 
    `Juros: R$ ${juros.toFixed(2)} | Montante: R$ ${montante.toFixed(2)}`;

  criarGrafico('grafico-simples', ['Capital', 'Juros', 'Montante'], [capital, juros, montante]);
}

function calcularJurosCompostos() {
  const capital = parseFloat(document.getElementById('capital-compostos').value);
  const taxa = parseFloat(document.getElementById('taxa-compostos').value) / 100;
  const tempo = parseInt(document.getElementById('tempo-compostos').value);

  if (!capital || !taxa || !tempo) {
    alert('Por favor, preencha todos os campos.');
    return;
  }

  const montante = capital * Math.pow(1 + taxa, tempo);
  const juros = montante - capital;

  document.getElementById('resultado-compostos').textContent = 
    `Juros: R$ ${juros.toFixed(2)} | Montante: R$ ${montante.toFixed(2)}`;

  criarGrafico('grafico-compostos', ['Capital', 'Juros', 'Montante'], [capital, juros, montante]);
}

function convert() {
  const fromCurrency = document.getElementById("fromCurrency").value;
  const toCurrency = document.getElementById("toCurrency").value;
  const amount = parseFloat(document.getElementById("amount").value);
  
  if (isNaN(amount)) {
      document.getElementById("result").innerText = "Por favor, insira um valor válido.";
      return;
  }
  
  let exchangeRate = 1; 
  
 
  if (fromCurrency === "BRL" && toCurrency === "USD") exchangeRate = 0.17;
  else if (fromCurrency === "BRL" && toCurrency === "EUR") exchangeRate = 0.16;
  else if (fromCurrency === "USD" && toCurrency === "BRL") exchangeRate = 5.76;
  else if (fromCurrency === "USD" && toCurrency === "EUR") exchangeRate = 0.92;
  else if (fromCurrency === "EUR" && toCurrency === "BRL") exchangeRate = 6.27;
  else if (fromCurrency === "EUR" && toCurrency === "USD") exchangeRate = 1.9;
  
  const result = amount * exchangeRate;
  document.getElementById("result").innerText = `Resultado: ${result.toFixed(2)} ${toCurrency}`;
}


function calcularJurosSimples() {
  const capital = parseFloat(document.getElementById('capital-simples').value);
  const taxa = parseFloat(document.getElementById('taxa-simples').value) / 100;
  const tempo = parseInt(document.getElementById('tempo-simples').value);

  if (!capital || !taxa || !tempo) {
    alert('Por favor, preencha todos os campos.');
    return;
  }

  const juros = capital * taxa * tempo;
  const montante = capital + juros;

  document.getElementById('resultado-simples').textContent = 
    `Juros: R$ ${juros.toFixed(2)} | Montante: R$ ${montante.toFixed(2)}`;

  criarGrafico('grafico-simples', ['Capital', 'Juros', 'Montante'], [capital, juros, montante]);
}

function calcularJurosCompostos() {
  const capital = parseFloat(document.getElementById('capital-compostos').value);
  const taxa = parseFloat(document.getElementById('taxa-compostos').value) / 100;
  const tempo = parseInt(document.getElementById('tempo-compostos').value);

  if (!capital || !taxa || !tempo) {
    alert('Por favor, preencha todos os campos.');
    return;
  }

  const montante = capital * Math.pow(1 + taxa, tempo);
  const juros = montante - capital;

  document.getElementById('resultado-compostos').textContent = 
    `Juros: R$ ${juros.toFixed(2)} | Montante: R$ ${montante.toFixed(2)}`;

 criarGrafico('grafico-compostos', ['Capital', 'Juros', 'Montante'], [capital, juros, montante]);
}




       
function convert() {
  const fromCurrency = document.getElementById("fromCurrency").value;
  const toCurrency = document.getElementById("toCurrency").value;
  const amount = parseFloat(document.getElementById("amount").value);
  
  if (isNaN(amount)) {
      document.getElementById("result").innerText = "Por favor, insira um valor válido.";
      return;
  }
  
  let exchangeRate = 1; 
  
 
  if (fromCurrency === "BRL" && toCurrency === "USD") exchangeRate = 0.17;
  else if (fromCurrency === "BRL" && toCurrency === "EUR") exchangeRate = 0.16;
  else if (fromCurrency === "USD" && toCurrency === "BRL") exchangeRate = 5.76;
  else if (fromCurrency === "USD" && toCurrency === "EUR") exchangeRate = 0.92;
  else if (fromCurrency === "EUR" && toCurrency === "BRL") exchangeRate = 6.27;
  else if (fromCurrency === "EUR" && toCurrency === "USD") exchangeRate = 1.9;
  
  const result = amount * exchangeRate;
  document.getElementById("result").innerText = `Resultado: ${result.toFixed(2)} ${toCurrency}`;
       
}

