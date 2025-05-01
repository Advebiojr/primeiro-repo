class Carro2(qtdportas: Int,modelo:String,marca:String,velocidade:Int,ano:Int): Veiculo(modelo,marca,velocidade,ano) {
    var qtdportas: Int = 0

    init {
       this.qtdportas = qtdportas

    }

    override fun exibirdetalhes() {
        super.exibirdetalhes()
        println("quantidade de portas:$qtdportas")
    }

    fun abriPortamalas(){
        println("Abrir porta-malas $modelo aberto \n")
    }




}