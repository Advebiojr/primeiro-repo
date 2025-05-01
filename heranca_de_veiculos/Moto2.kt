class Moto2(cilindradas: Int,modelo:String,marca:String,velocidade:Int,ano:Int): Veiculo(modelo,marca,velocidade,ano){
    var cilindradas: Int = 0


    init {
        this.cilindradas=cilindradas
    }

    override fun exibirdetalhes() {
        super.exibirdetalhes()
        println("cilindradas: $cilindradas")
    }

    fun empinar(){
        if (velocidade>10){
            println("A $marca $modelo está empinando! Cuidado! \n")
        }else{
            println("A $marca $modelo precisa de mais velocidade para empinar \n")
        }
    }
}