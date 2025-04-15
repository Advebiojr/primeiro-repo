
       
       function convert() {
            const fromCurrency = document.getElementById("fromCurrency").value;
            const toCurrency = document.getElementById("toCurrency").value;
            const amount = parseFloat(document.getElementById("amount").value);
            
            if (isNaN(amount)) {
                document.getElementById("result").innerText = "Por favor, insira um valor válido.";
                return;
            }
            
            let exchangeRate = 1; // Taxa de câmbio fictícia
            
            // Taxas de câmbio fictícias (exemplo)
            if (fromCurrency === "BRL" && toCurrency === "USD") exchangeRate = 0.17;
            else if (fromCurrency === "BRL" && toCurrency === "EUR") exchangeRate = 0.16;
            else if (fromCurrency === "USD" && toCurrency === "BRL") exchangeRate = 5.76;
            else if (fromCurrency === "USD" && toCurrency === "EUR") exchangeRate = 0.92;
            else if (fromCurrency === "EUR" && toCurrency === "BRL") exchangeRate = 6.27;
            else if (fromCurrency === "EUR" && toCurrency === "USD") exchangeRate = 1.9;
            
            const result = amount * exchangeRate;
            document.getElementById("result").innerText = `Resultado: ${result.toFixed(2)} ${toCurrency}`;
        }
        function irparajuros() {
            window.location.href = "juros.html";
        }
        
        function irparafinanceira() {
            window.location.href = "finance.html";
        }
        function irparacalc(){
            window.location.href = "calculadora.html";
        }  function irparacadastro(){
            window.location.href = "cadastro.php";
        }  
        function irparalogin(){
            window.location.href = "login (3).php"
        }    
    
   
