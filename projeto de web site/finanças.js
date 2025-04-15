window.irparacalc = function(){
    window.location.href = "calculadora.html"; 
};

window.irparajuros = function(){
    window.location.href = "juros.html";
};

document.getElementById('financial-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const revenue = parseFloat(document.getElementById('revenue').value);
    const expenses = parseFloat(document.getElementById('expenses').value);
    const taxRate = parseFloat(document.getElementById('tax').value) / 100;

   
    if (revenue < 0 || expenses < 0) {
        alert("Os valores de receita e despesas não podem ser negativos.");
        return;
    }

    const profit = revenue - expenses;
    const tax = profit > 0 ? profit * taxRate : 0;
    const netProfit = profit - tax;

    const resultDiv = document.getElementById('result');
    resultDiv.innerHTML = `
        <h2>Resultados</h2>
        <p>Lucro Bruto: R$ ${profit.toFixed(2)}</p>
        <p>Imposto: R$ ${tax.toFixed(2)}</p>
        <p>Lucro Líquido: R$ ${netProfit.toFixed(2)}</p>
    `;
});
