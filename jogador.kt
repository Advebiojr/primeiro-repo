import kotlin.random.Random

class Adivinha {

    private val numeroSecreto = Random.nextInt(1, 11)

    fun iniciarJogo() {
        println("Estou pensando em um número entre 1 e 10. Você tem 5 tentativas!")

        for (i in 1..5) {
            print("Tentativa $i: ")
            val palpite = readLine()?.toIntOrNull()

            if (palpite == null) {
                println("Entrada inválida. Digite um número inteiro.")
                continue
            }

            when {
                palpite == numeroSecreto -> {
                    println("Parabéns! Você acertou o número! 🎉")
                    return
                }
                palpite > numeroSecreto -> println("Errou! O número é menor que $palpite.")
                else -> println("Errou! O número é maior que $palpite.")
            }
        }

        println("Acabaram as tentativas! O número era $numeroSecreto.")
    }
}

fun main(){
    val adivinha = Adivinha()
    adivinha.iniciarJogo()

}
