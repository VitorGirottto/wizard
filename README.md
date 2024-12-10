# Simulação de Alteração de Plano - Wizard

## Visão Geral:
Este código simula a alteração de um plano de contrato, permitindo realizar modificações 
no valor do plano, como "upgrade" (aumento de valor) ou "downgrade" (redução de valor), 
com base em um conjunto de parâmetros configuráveis. Ele calcula o valor proporcional considerando 
a data de alteração, tipo de contrato e outros parâmetros. No final, o sistema gera um boleto 
com o valor calculado para a nova configuração.

## Requisitos:
- PHP 7.x ou superior.
- Ambiente de terminal para interação com o código.
- O código simula a alteração de plano de contrato e requer interações via linha de comando (CLI).

## Funcionalidade:
A classe `wizard` tem como objetivo realizar a simulação de alteração do plano, considerando o tipo 
de contrato (pré-pago ou pós-pago), data de alteração, valor do plano, base do período de prestação e a data 
de vencimento.

### Parâmetros de Configuração:
Os seguintes parâmetros precisam ser configurados corretamente para garantir o funcionamento correto da classe:

- **tipo_contrato**: Define se o contrato é "pré-pago" ou "pós-pago".
  - Valores possíveis: "pre" ou "pos".
  
- **mes_alteracao**: Mês da alteração (Valor entre 1 e 12).
  
- **dia_alteracao**: Dia da alteração (Valor entre 1 e o número máximo de dias do mês).
  
- **valor_antigo**: Valor do plano anterior (Precisa ser maior que 0).
  
- **data_vencimento**: Data de vencimento do plano (Valor entre 1 e 28).
  
- **base_periodo_prestacao**: Define como a prestação será calculada.
  - Valores possíveis: "vencimento" ou "periodo".

## Fluxo de Execução:
1. **Configuração Inicial**:
    Ao iniciar o código, a classe `wizard` verifica os parâmetros de configuração, como o tipo de contrato, 
    mês de alteração, dia de alteração e outros dados necessários para a execução da alteração.

2. **Alteração de Plano (Upgrade/Downgrade)**:
    O usuário escolhe entre um "upgrade" (aumento do valor do plano) ou "downgrade" (redução do valor do plano).
    O valor do novo plano é inserido pelo usuário.

3. **Cálculo Proporcional**:
    O valor do novo plano é calculado de forma proporcional ao mês e data de alteração, com base no tipo de contrato 
    e base de período de prestação escolhidos.

4. **Geração de Boleto**:
    O código simula a geração de um boleto com o valor calculado. O usuário pode optar por gerar o boleto 
    ou simular o valor proporcional para a próxima parcela.

## Exemplo de Execução:

Verificando o tipo contrato... 

Tipo contrato é um pós-pago 

Verificando o mês da alteração... 

O mês atual é o mês 3 Verificando o dia da alteração... 

O dia atual é 1/3 Verificando o valor antigo do plano... 

O valor antigo do plano é de 89.90 

Verificando a data de vencimento fixo... 

A data de vencimento fixo é dia 28 

Verificando a base periodo prestacao... 

A base periodo prestação é de vencimento


É um upgrade ou downgrade?

upgrade 

Qual o valor do novo plano?

79.90 

Valor novo maior que o valor antigo 

Por ser um upgrade é necessário que o valor novo seja maior que o valor antigo 

Digite novamente o valor novo, caso deseja fazer um downgrade, pode estar recomeçando a alteração 

100.00


Vai ser gerado um boleto com o vencimento 28/3 no valor de R$ 90.00 

Deseja gerar esse boleto ou gerar o proporcional para a próxima parcela? 

Digite 'gerar' ou 'proximo': gerar

Boleto com o vencimento 28/3 no valor de R$ 90.00 gerado!!


## Detalhamento das Funções:
- **VerificarParametros()**: Valida os parâmetros configurados (tipo de contrato, mês de alteração, etc.).
  
- **VerificarNumero($valor_novo, $tipo_alteracao)**: Verifica se o valor inserido para o novo plano é válido 
  com base no tipo de alteração.

- **CalcularProporcional($valor_novo)**: Calcula o valor proporcional do novo plano, considerando o mês 
  e a data de alteração.

- **GerarBoleto($valor_novo)**: Gera o boleto com o valor calculado, perguntando ao usuário se deseja 
  gerar o boleto ou calcular o valor proporcional para a próxima parcela.

## Como Usar:
1. Abra o terminal ou console e execute o código PHP.
2. Configure os parâmetros no início da classe `wizard` (tipo de contrato, mês de alteração, etc.).
3. O sistema vai solicitar entradas, como o tipo de alteração (upgrade ou downgrade), o valor do novo plano, 
   e se você deseja gerar o boleto ou o valor proporcional.
4. A execução terminará gerando o boleto ou apresentando os valores adicionais, dependendo das opções selecionadas.
