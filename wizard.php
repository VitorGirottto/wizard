<?php

class wizard{
    
    //Parâmetros necessário ser configurado corretamente
    
    private $tipo_contrato = "pre"; //Apenas podendo configurar com "pre" em caso de pré-pago ou "pos" em caso de pós-pago
    private $mes_alteracao = 3; //Apenas podendo conter o valor de 1 a 12
    private $dia_alteracao = 1; //Apenas podendo configurar com o dia da alteração, sendo um dia existente
    private $valor_antigo = 89.90; //Apenas podendo conter o valor maior que 0
    private $data_vencimento = 28; //Apenas podendo conter o valor de 1 a 28
    private $base_periodo_prestacao = "vencimento"; //Apenas podendo configurar com "periodo" ou "vencimento" 
    //----------------------------------------------------------------------------------
    
    private $valor;
    private $mes_alteracao2;
    private $mes_dia = [
        '1' => 31,
        '2' => 28,
        '3' => 31,
        '4' => 30,
        '5' => 31,
        '6' => 30,
        '7' => 31,
        '8' => 31,
        '9' => 30,
        '10' => 31,
        '11' => 30,
        '12' => 31  
    ];
    
    public function Mudar(){
        $this->mes_alteracao2 = $this->mes_alteracao;
    }

    public function VerificarParametros(){
        
        //Validação 1 ----------------------------------------------------------------------------------
        echo "Verificando o tipo contrato...\n"; 
        
        if($this -> tipo_contrato == "pos"){
            
            if($this->dia_alteracao < $this->data_vencimento and $this->base_periodo_prestacao == "vencimento"){
                $this -> mes_alteracao = $this -> mes_alteracao - 1;
            }
            
            echo "Tipo contrato é um pós-pago\n";
        }
        else if($this -> tipo_contrato == "pre"){
            
            if($this->dia_alteracao < $this->data_vencimento and $this->base_periodo_prestacao == "vencimento"){
                $this -> mes_alteracao = $this -> mes_alteracao - 1;
            }
            
        //Validação 2 ----------------------------------------------------------------------------------
        echo "Tipo contrato é um pré-pago\n";
        }
        else{
            echo "Configuração de Pós pago ou Pré pago inválida, reconfigure na classe wizard";
            exit;
        }
        echo "Verificando o mês da alteração...\n";
        
        if($this -> mes_alteracao > 0 && $this-> mes_alteracao < 13){
            
            echo "O mês atual é o mês ". $this->mes_alteracao2."\n";
        }
        else{
            echo "Configuração do mês de alteração inválida, reconfigure na classe wizard";
            exit;
        }
        
        //Validação 3 ----------------------------------------------------------------------------------
        echo "Verificando o dia da alteração...\n";
        
        if($this -> dia_alteracao > 0 && $this -> dia_alteracao <= $this -> mes_dia[$this->mes_alteracao]){
            
            echo "O dia atual é ". $this->dia_alteracao."/".$this->mes_alteracao2."\n";
        }
        else{
            echo "Configuração do dia de alteração inválida, reconfigure na classe wizard";
            exit;
        }
        
        //Validação 4 ----------------------------------------------------------------------------------
        echo "Verificando o valor antigo do plano...\n";
        
        if($this -> valor_antigo > 0){
            
            echo "O valor antigo do plano é de ". $this->valor_antigo."\n";
        }
        else{
            echo "Configuração do valor antigo do plano inválida, reconfigure na classe wizard";
            exit;
        }
        
        //Validação 5 ----------------------------------------------------------------------------------
        echo "Verificando a data de vencimento fixo...\n";
        
        if($this -> data_vencimento > 0 && $this -> data_vencimento < 29){
            
            echo "A data de vencimento dixo é dia ". $this->data_vencimento."\n";
        }
        else{
            echo "Configuração de vencimento fixo inválida, reconfigure na classe wizard";
            exit;
        }
        
        //Validação 6 ----------------------------------------------------------------------------------
        echo "Verificando a base periodo prestacao...\n";
        
        if($this -> base_periodo_prestacao == "vencimento" || $this -> base_periodo_prestacao == "periodo"){
            
            echo "A base periodo prestação é de ". $this->base_periodo_prestacao."\n\n";
        }
        else{
            echo "Configuração da base periodo prestão é inválida, reconfigure na classe wizard";
            exit;
        }
    }

    function VerificarNumero($valor_novo, $tipo_alteracao){
        do{
            
            if(is_numeric($valor_novo)){
                    
                if($tipo_alteracao=="upgrade"){
                        
                    if($this->valor_antigo<=$valor_novo){
                        break;
                    }
                    else{
                        do{
                            echo "Valor novo menor que o valor antigo\nPor ser um upgrade é necessário que o valor novo seja maior que o valor antigo\nDigite nvoamente o valor novo, caso deseja fazer um downgrade, pode estar recomeçando a alteração\n";
                            $valor_novo = trim(fgets(STDIN));
                            
                            if($this->valor_antigo<=$valor_novo){
                                break;
                            }
                        }while(true);
                    }
                }
                    
                elseif($tipo_alteracao=="downgrade"){
                        
                    if($this->valor_antigo>=$valor_novo){
                        break;
                    }
                    else{
                        do{
                            echo "Valor novo maior que o valor antigo\nPor ser um downgrade é necessário que o valor novo seja menor que o valor antigo\nDigite nvoamente o valor novo, caso deseja fazer um upgrade, pode estar recomeçando a alteração\n";
                            $valor_novo = trim(fgets(STDIN));
                                    
                            if($this->valor_antigo>=$valor_novo){
                                break;
                            }
                        }while(true);
                    }
                }
            }
            else{
                $valor_novo = readline("\nValor não aceito, tente novamente:  ");
            }
        }while(true);
    }

    public function CalcularProporcional($valor_novo){
        
        if ($this->mes_alteracao < 1 || $this->mes_alteracao > 12) {
            if($this->mes_alteracao < 1){
                $this->mes_alteracao = 12;
            }
            elseif($this->mes_alteracao > 12){
                $this->mes_alteracao = 1;
            }
        }
        $valor3 = $valor_novo;
        
        $valor_novo = $valor_novo / $this->mes_dia[$this->mes_alteracao];
        $this->valor_antigo = $this->valor_antigo / $this->mes_dia[$this->mes_alteracao];

        if($this->base_periodo_prestacao == "periodo"){
            
            $valor_boleto = ($this->valor_antigo * ($this->dia_alteracao - 1)) + (($this->mes_dia[$this->mes_alteracao] - ($this->dia_alteracao - 1)) * $valor_novo);
        }
        elseif($this->base_periodo_prestacao == "vencimento"){
            
            if($this->data_vencimento < $this->dia_alteracao){
                
                $valor_boleto = ($this->dia_alteracao - $this->data_vencimento);
                $valor_boleto = ($valor_boleto * $this->valor_antigo) + (($this->mes_dia[$this->mes_alteracao] - $valor_boleto) * $valor_novo);
               
            }       
            elseif($this->data_vencimento > $this->dia_alteracao){
                
                $valor_boleto = ($this->data_vencimento - $this->dia_alteracao);
                $valor_boleto = ($valor_boleto * $valor_novo) + (($this->mes_dia[$this->mes_alteracao] - $valor_boleto) * $this->valor_antigo);
                
            }
            elseif($this->data_vencimento == $this->dia_alteracao){
                
                $valor_boleto = $valor3;
            }
        }
        $this->valor = $valor_boleto;
    }
    
    public function GerarBoleto($valor_novo){
        
        if($this -> tipo_contrato == "pos" and $this->dia_alteracao > $this->data_vencimento){
            $this->mes_alteracao2 = $this->mes_alteracao2 + 1;
            if($this->mes_alteracao2 == 13){
                $this->mes_alteracao2 = 1;
            }
        }
        elseif($this -> tipo_contrato == "pre" and $this->dia_alteracao < $this->data_vencimento){
            $this->mes_alteracao2 = $this->mes_alteracao2 - 1;
            if($this->mes_alteracao2 == 0){
                $this->mes_alteracao2 = 12;
            }
        }
        echo("\nVai ser gerado um boleto com o vencimento ".$this->data_vencimento."/".$this->mes_alteracao2." no valor de R$ ". number_format($this->valor, 2)). "\n";
        echo ("Deseja gerar esse boleto ou gerar o proporcional para a próxima parcela? \n");
        do{
            $valor1 = readline("Digite 'gerar' ou 'proximo': ");
            
            if($valor1 == "proximo"){
                $valor2 = $this->valor - $valor_novo;
                
                if ($valor2 < 0){
                     
                    echo "Gerado desconto adicional no valor de R$ ".number_format($valor2, 2);
                }
                elseif($valor2 > 0){
                    
                    echo "Gerado serviço adicional no valor de R$ ".number_format($valor2, 2);
                }
               
                break;
            }
            elseif($valor1 == "gerar"){
                echo("\nBoleto com o vencimento ".$this->data_vencimento."/".$this->mes_alteracao2." no valor de R$ ". number_format($this->valor, 2)). " gerado!!\n";
                break;
            }
            else{
                echo "Resposta inválida\n";
                $valor1 = readline("Digite 'gerar' ou 'proxima': ");
                
                if($valor1 == "proximo"){
                    break;
                }
                elseif($valor1 == "gerar"){
                            echo("\nBoleto com o vencimento ".$this->data_vencimento."/".$this->mes_alteracao2." no valor de R$ ". number_format($this->valor, 2)). " gerado!!\n";
                    break;
                }
            }
        }while(true);
    }
}

function VerficarAlteracao($tipo_alteracao){
    while (true){
        
        if($tipo_alteracao != "upgrade" && $tipo_alteracao != "downgrade"){
            
            $tipo_alteracao = readline("\nResposta inválida, tente novamente:  ");
        }
        else {
            break;
        }
    }
}

//----------------------------------------------------------------------------------

$wizard = new wizard;

$wizard -> Mudar();

$wizard -> VerificarParametros();

$tipo_alteracao = readline("\nÉ um upgrade ou downgrade?  \n");

VerficarAlteracao($tipo_alteracao);

$valor_novo = readline("Qual o valor do novo plano?  \n");

$wizard -> VerificarNumero($valor_novo, $tipo_alteracao);

$wizard -> CalcularProporcional($valor_novo);

$wizard -> GerarBoleto($valor_novo);

?>

//fim
