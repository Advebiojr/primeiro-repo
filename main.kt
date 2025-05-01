class Loja {
    private val estoque = mutableListOf<Pair<String, String>>()
    private val carrinho = mutableListOf<Pair<String, String>>()

    fun adicionarProduto(nome: String, preco: String) {
        estoque.add(Pair(nome, preco))
        println("Produto adicionado ao estoque: $nome - R$ $preco")
    }

    fun mostrarEstoque() {
        if (estoque.isEmpty()) {
            println("Estoque vazio.")
        } else {
            println("\n📦 Produtos no estoque:")
            for ((nome, preco) in estoque) {
                println("$nome: R$ $preco")
            }
        }
    }

    fun buscarProduto(nomeBusca: String) {
        val encontrado = estoque.find { it.first.equals(nomeBusca, ignoreCase = true) }

        if (encontrado != null) {
            println("Produto encontrado: ${encontrado.first}: R$ ${encontrado.second}")
        } else {
            println("Produto não encontrado.")
        }
    }

    fun adicionarAoCarrinho(nomeCarrinho: String) {
        val produto = estoque.find { it.first.equals(nomeCarrinho, ignoreCase = true) }

        if (produto != null) {
            carrinho.add(produto)
            println("Adicionado ao carrinho: ${produto.first}: R$ ${produto.second}")
        } else {
            println("Produto não encontrado no estoque.")
        }
    }

    fun mostrarCarrinho() {
        if (carrinho.isEmpty()) {
            println("Carrinho vazio.")
        } else {
            println("\n🛒 Produtos no carrinho:")
            for ((nome, preco) in carrinho) {
                println("$nome: R$ $preco")
            }
        }
    }

    fun finalizarCompra() {
        if (carrinho.isEmpty()) {
            println("Carrinho vazio. Nada para comprar.")
            return
        }

        val total = carrinho.sumOf { it.second.toDoubleOrNull() ?: 0.0 }

        println("\n🧾 Compra finalizada. Valor total: R$ %.2f".format(total))
        carrinho.clear()
    }
}

fun main() {
    val minhaloja = Loja()

    var opcao: Int

    do {
        println("\nMenu da Loja:")
        println("1. Adicionar produtos ao estoque")
        println("2. Ver estoque")
        println("3. Buscar produto")
        println("4. Adicionar ao carrinho")
        println("5. Ver carrinho")
        println("6. Finalizar compra")
        println("0. Sair")
        print("Escolha uma opção: ")

        opcao = readLine()?.toIntOrNull() ?: -1

        when (opcao) {
            1 -> {
                print("Quantos produtos deseja adicionar? ")
                val qtd = readLine()?.toIntOrNull() ?: 0

                for (i in 1..qtd) {
                    print("Nome do produto #$i: ")
                    val nome = readLine() ?: ""
                    print("Preço do produto #$i: ")
                    val preco = readLine() ?: ""

                    minhaloja.adicionarProduto(nome, preco)
                }
            }

            2 -> minhaloja.mostrarEstoque()

            3 -> {
                print("Digite o nome do produto para buscar: ")
                val nomeBusca = readLine() ?: ""
                minhaloja.buscarProduto(nomeBusca)
            }

            4 -> {
                print("Digite o nome do produto que deseja adicionar ao carrinho: ")
                val nomeCarrinho = readLine() ?: ""
                minhaloja.adicionarAoCarrinho(nomeCarrinho)
            }

            5 -> minhaloja.mostrarCarrinho()

            6 -> minhaloja.finalizarCompra()

            0 -> println("Encerrando o programa.")

            else -> println("Opção inválida.")
        }

    } while (opcao != 0)
}
