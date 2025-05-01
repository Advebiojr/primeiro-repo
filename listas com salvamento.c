#include <stdio.h>
#include <stdlib.h>
#include <locale.h>

#define MAX_TAM 5

int lista[MAX_TAM], tamanho = MAX_TAM, menu, t = 0;

void insere() {
    int a;
    if (t == tamanho) {
        printf("\n--- Lista cheia ---\n");
    } else {
        printf("\nDigite um número a ser inserido na lista: ");
        scanf("%d", &a);
        lista[t] = a;
        t++;
    }
}

void elemento() {
    int posicao;
    if (t == 0) {
        printf("\n--- Lista vazia ---\n");
    } else {
        printf("\nEm qual posição da lista está o elemento que deseja visualizar? ");
        scanf("%d", &posicao);
        posicao--; // Ajuste para índice zero-base
        if (posicao < 0 || posicao >= t) {
            printf("\n--- Posição inexistente ---\n");
        } else {
            printf("\n--- Elemento: %d ---\n", lista[posicao]);
        }
    }
}

void exibe() {
	int i;
    if (t == 0) {
        printf("\n--- Lista vazia ---\n");
    } else {
        printf("\n--- Lista ---\n");
        for (i = 0; i < t; i++) {
            printf(" %d ", lista[i]);
        }
        printf("\n");
    }
}

void retirar() {
    if (t == 0) {
        printf("\n--- Lista vazia ---\n");
    } else {
        printf("\n--- Último elemento removido: %d ---\n", lista[t - 1]);
        t--;
    }
}

void salvar() {
	int i;
    FILE *arquivo = fopen("lista.txt", "w");
    if (arquivo == NULL) {
        printf("\nErro ao abrir o arquivo para salvar.\n");
        return;
    }
    for (i = 0; i < t; i++) {
        fprintf(arquivo, "%d\n", lista[i]);
    }
    fclose(arquivo);
    printf("\n--- Lista salva com sucesso ---\n");
}

void carregar() {
    FILE *arquivo = fopen("lista.txt", "r");
    if (arquivo == NULL) {
        printf("\nErro ao abrir o arquivo para carregar.\n");
        return;
    }
    t = 0; // Reiniciar o tamanho da lista
    while (fscanf(arquivo, "%d", &lista[t]) != EOF && t < tamanho) {
        t++;
    }
    fclose(arquivo);
    printf("\n--- Lista carregada com sucesso ---\n");
}

int main() {
    setlocale(LC_ALL, "");
    do {
        printf("\n0 - Reiniciar Lista");
        printf("\n1 - Inserir número na Lista");
        printf("\n2 - Exibir Lista");
        printf("\n3 - Exibir tamanho da Lista");
        printf("\n4 - Exibir um elemento da Lista");
        printf("\n5 - Limpar último elemento da lista");
        printf("\n6 - Salvar dados");
        printf("\n7 - Carregar lista");
        printf("\n8 - Sair");
        printf("\nDigite uma opção: ");
        scanf("%d", &menu);

        switch (menu) {
            case 0:
                t = 0; // Reiniciar lista
                printf("\n--- Lista reiniciada ---\n");
                break;
            case 1:
                insere();
                break;
            case 2:
                exibe();
                break;
            case 3:
                printf("\n--- Tamanho da lista: %d ---\n", t);
                break;
            case 4:
                elemento();
                break;
            case 5:
                retirar();
                break;
            case 6:
                salvar();
                break;
            case 7:
                carregar();
                break;
            case 8:
                break;
            default:
                printf("\n--- Opção inválida ---\n");
                break;
        }
    } while (menu != 8);
    
    printf("\nPrograma encerrado.\n");
    return 0;
}
