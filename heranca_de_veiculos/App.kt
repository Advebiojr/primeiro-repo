

fun main(){

        var meuCarro: Carro2? = null
    var minhamoto: Moto2? = null



    do {
        println("""
            +--------Controle de Veículo---------+
            | [1] - Criar objeto Carro           |
            | [2] - Exibir informações do carro  |
            | [3] - Frear o carro                |
            | [4] - Acelerar o carro             |
            | [5] - Abrir pota malas do carro    |
            | [6] - criar objeto moto            |
            | [7] - Exibir informações do moto   |
            | [8] - Acelerar o moto              |
            | [9] - Frear o moto                 |
            | [10] - Empinar a moto              |
            | [11] - Sair                        |
            +------------------------------------+
        """.trimIndent())

        println("Digite a opção desejada")
        var opcao = readLine()?.toInt()

        when (opcao){
            1 -> {
                println("qual o modelo do carro")
                var modelo = readLine()
                println("marca do carro")
                var marca = readLine()
                println("de que ano:")
                var ano = readLine()?.toInt()
                println("quantidade de portas")
                var qtdportas = readLine()?.toInt()
                var velocidade = 0
                meuCarro = Carro2(qtdportas?:0,modelo?:"",marca?:"",velocidade?:0,ano?:0)
            }
            2 -> meuCarro?.exibirdetalhes()
            3 -> {
                println("quanto você desacelerou:")
                var desacelerar = readLine()?.toInt()
                meuCarro?.desacelerar(desacelerar?:0)

            }
            4 -> {
                println("qual velocidade você está:")
                var acelerar = readLine()?.toInt()
                meuCarro?.acelerando(acelerar?:0)

            }
            5 -> meuCarro?.abriPortamalas()
            6 -> {println("qual o modelo do carro")
                var modelo = readLine()
            println("marca do carro")
                var marca = readLine()
            println("de que ano:")
                var ano = readLine()?.toInt()
            println("quantas cilindradas")
                var cilindradas = readLine()?.toInt()
                var velocidade = 0
                minhamoto = Moto2(cilindradas?:0,modelo?:"",marca?:"",velocidade?:0,ano?:0)
            }
            7 -> minhamoto?.exibirdetalhes()
            8 -> {
                println("qual velocidade você está:")
                var acelerar = readLine()?. toInt()
                minhamoto?.acelerando(acelerar?:0)
            }
            9 -> {
                println("quanto você desacelerou:")
                var frear = readLine()?. toInt()
                minhamoto?.desacelerar(frear?:0)
            }
            10 -> minhamoto?.empinar()
            11 -> println("encerrando-8")

            else -> println("Opção invalida")


        }
    }while (opcao != 11)

}