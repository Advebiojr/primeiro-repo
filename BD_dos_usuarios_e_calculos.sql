CREATE DATABASE calculadora_financeira;
USE calculadora_financeira;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
select * from usuarios;

CREATE TABLE historico_calculos (
    valor_principal DECIMAL(10, 2) not null,
    taxa_juros DECIMAL(5, 2) not null,
    tempo INT not null, -- Tempo em períodos (meses ou anos),
    resultado DECIMAL(10, 2),
    data_calculo TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
select * from historico_calculos;






