open class Veiculo(modelo: String,marca:String,velocidade:Int, ano: Int) {
    var modelo: String = ""
    var marca: String = ""
    var velocidade: Int = 0
    var ano: Int = 0

    init {
        this.modelo=modelo
        this.marca=marca
        this.velocidade=velocidade
        this.ano=ano
    }

   open fun exibirdetalhes(){
        println("marca: $marca")
        println("modelo: $modelo")
        println("velocidade atual: $velocidade")
    }

    fun acelerando(acelerar: Int){

        if (acelerar > 0){
        velocidade += acelerar
            println("velocidade atual: $velocidade")
        }

    }


    fun desacelerar(desacelerar: Int){
        if(desacelerar > 0){
            velocidade -= desacelerar
            println("velocidade atual: $velocidade")
        }
    }

}