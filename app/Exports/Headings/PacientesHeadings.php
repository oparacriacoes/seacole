<?php

namespace App\Exports\Headings;

class PacientesHeadings
{
    public function headings(): array
    {
        return [
            'Nome',
            'Nome social',
            'Tel. fixo',
            'Tel. celular',
            'Data nascimento',
            'Idade',
            'Faixa Etária',
            'Responsável residência',
            'Email',
            'CEP',
            'Rua',
            'Número',
            'Complemento',
            'Bairro',
            'Cidade',
            'UF',
            'Ponto referência',
            'Identidade gênero',
            'Orientação sexual',
            'Cor/Raça',
            'Cor/Raça',
            'Nº pessoas residência',
            'Auxílio emergencial',
            'Renda residência',
            'Classe Social (Renda Total)',
            'Renda per capta',
            'Classe Social (Renda Per Capta)',
            'Como chegou ao projeto',
            'Núcleo UNEAFRO qual?',
            'Como chegou ao projeto outro',
            'Data início sintoma',
            'Data início monitoramento',
            'Data finalização caso',
            'Total dias monitoramento',
            'Situação',
            'Agente',
            'Médico',
            'Articuladora',
            'Psicólogo',
            'Data início ac. psicológico',
            'Data encerramento ac. psicológico',
            'Acomp. psicol. individual',
            'Acomp. psicol. em grupo',
            'At. semanal psicol.',
            'Hor. at. psicol.',

            'DIAGNÓSTICO DE COVID-19',
            'Data do teste confirmatório',
            'Testes Realizados? PCR',
            'Testes Realizados? Sorologias (IgM/IgG)',
            'Testes Realizados? Teste Rápido',
            'Testes Realizados? Não Informado',
            'Resultados Encontrados - PCR positivo',
            'Resultados Encontrados - PCR negativo',
            'Resultados Encontrados - IgM positivo',
            'Resultados Encontrados - IgM negativo',
            'Resultados Encontrados - IgG positivo',
            'Resultados Encontrados - IgG negativo',
            'Outras inf. sobre o teste',

            'Condições Gerais de Saúde: Hipertensão arterial sistêmica (HAS)',
            'Condições Gerais de Saúde: Diabetes Mellitus (DM)',
            'Condições Gerais de Saúde: Dislipidemia',
            'Condições Gerais de Saúde: Asma / Bronquite',
            'Condições Gerais de Saúde: Tuberculose ativa',
            'Condições Gerais de Saúde: Cardiopatias e outras doenças cardiovasculares',
            'Condições Gerais de Saúde: Outras doenças respiratórias',
            'Condições Gerais de Saúde: Artrite/Artrose/Reumatismo',
            'Condições Gerais de Saúde: Doença autoimune',
            'Condições Gerais de Saúde: Doença renal',
            'Condições Gerais de Saúde: Doença neurológica',
            'Condições Gerais de Saúde: Câncer',
            'Condições Gerais de Saúde: Ansiedade',
            'Condições Gerais de Saúde: Depressão',
            'Condições Gerais de Saúde: Demência',
            'Condições Gerais de Saúde: Outras questões de saúde mental',
            'Condições Gerais de Saúde: Descreva as doenças assinaladas',

            'Já teve tuberculose?',
            'É tabagista?',
            'Faz uso crônico de alcool?',
            'Faz uso crônico de outras drogas?',

            'Toma remédio(s) de uso contínuo? Qual(is)?',

            'Gestante',
            'Pós parto',
            'Amamenta',
            'Gestação alto risco',
            'Motivo risco gravidez',
            'Data parto',
            'Data última menstruação',
            'Trimestre gestacao',
            'Acompanhamento médico',
            'Data última consulta',

            'Onde/como acessa o sistema de saúde? - É usuária/o do SUS (público)',
            'Onde/como acessa o sistema de saúde? - Tem convênio/plano de saúde',
            'Onde/como acessa o sistema de saúde? Usuária/o de serviços pagos "populares" (Ex: Dr Consulta)',
            'Onde/como acessa o sistema de saúde? - Usuária/o de serviços particulares não cobertos por convênios',

            //'QUADRO ATUAL'
            'Primeiros sintomas',
            'SINTOMAS MANIFESTADOS - Tosse',
            'SINTOMAS MANIFESTADOS - Falta de ar',
            'SINTOMAS MANIFESTADOS - Febre',
            'SINTOMAS MANIFESTADOS - Dor de cabeça',
            'SINTOMAS MANIFESTADOS - Perda de olfato',
            'SINTOMAS MANIFESTADOS Perda de paladar',
            'SINTOMAS MANIFESTADOS Enjoo ou vomitos',
            'SINTOMAS MANIFESTADOS Diarreia',
            'SINTOMAS MANIFESTADOS Aumento da pressão',
            'SINTOMAS MANIFESTADOS Queda brusca da pressão',
            'SINTOMAS MANIFESTADOS Dor torácica (dor no peito)',
            'SINTOMAS MANIFESTADOS Sonolência ou cansaço importantes',
            'SINTOMAS MANIFESTADOS Confusão mental',
            'SINTOMAS MANIFESTADOS Desmaio',
            'SINTOMAS MANIFESTADOS Convulsão',
            'SINTOMAS MANIFESTADOS Outros',
            'Temperatura máxima (em graus)',
            'Data temperatura máxima',
            'Saturação mais baixa registrada (%)',
            'Data da saturação mais baixa',
            'Frequência respiratória máxima',
            'Data da Frequência respiratória máxima',

            //'DESFECHO e SEQUELAS'
            'DESFECHO:',
            'SEQUELAS: perda persistente de olfato',
            'SEQUELAS: perda persistente de paladar',
            'SEQUELAS: tosse persistente',
            'SEQUELAS: falta de ar persistente',
            'SEQUELAS: dor de cabeça persistente',
            'SEQUELAS: eventos tromboliticos',
            'SEQUELAS: danos renais',
            'SEQUELAS: outros',
            'SEQUELAS: outros QUAIS?',
            'Algo mais que queira descrever sobre o caso?',

            //'SAÚDE MENTAL'
            'Quadro atual intensifica medos, angústias, ansiedade, tristezas ou preocupação?',
            'Escreva sobre o estado emocional e detalhe os medos',

            //'SERVIÇOS DE REFERÊNCIA E INTERNAÇÃO'
            'A pessoa precisou ir a algum serviço de saúde? UBS (Unidade Básica de Saúde - posto de saúde)',
            'A pessoa precisou ir a algum serviço de saúde? UPA (Unidade de Pronto Atendimento)',
            'A pessoa precisou ir a algum serviço de saúde? AMA',
            'A pessoa precisou ir a algum serviço de saúde? Hospital Público',
            'A pessoa precisou ir a algum serviço de saúde? Hospital Privado',
            'A pessoa precisou ir a algum serviço de saúde? OUTRO',
            'Quantas idas a serviços de saúde?',
            'Data da última ida a serviço de saúde',
            'Recebeu medicações para tratar COVID-19? Azitromicina',
            'Recebeu medicações para tratar COVID-19? Outro antibiótico',
            'Recebeu medicações para tratar COVID-19? Ivermectina',
            'Recebeu medicações para tratar COVID-19? Cloroquina/Hidroxicloroquina',
            'Recebeu medicações para tratar COVID-19? Oseltamivir (tamiflu)',
            'Recebeu medicações para tratar COVID-19? Algum antialérgico',
            'Recebeu medicações para tratar COVID-19? Algum corticóide',
            'Recebeu medicações para tratar COVID-19? Algum antiinflamatoŕio',
            'Recebeu medicações para tratar COVID-19? Vitamina D',
            'Recebeu medicações para tratar COVID-19? Zinco',
            'Recebeu medicações para tratar COVID-19? Outro medicamento',
            'Escreva o nome do medicamento prescrito',
            'A pessoa teve algum problema com serviços de referência? UBS (Unidade Básica de Saúde - posto de saúde)',
            'A pessoa teve algum problema com serviços de referência? UPA (Unidade de Pronto Atendimento)',
            'A pessoa teve algum problema com serviços de referência? AMA',
            'A pessoa teve algum problema com serviços de referência? Hospital Público',
            'A pessoa teve algum problema com serviços de referência? Hospital Privado',
            'A pessoa teve algum problema com serviços de referência? OUTRO',
            'Descreva o problema',
            'Precisou de internação pelo quadro (suspeito ou confirmado)?',
            'Precisou de ambulância financiada pelo projeto?',
            'LOCAL DE INTERNAÇÃO Hospital público de referência',
            'LOCAL DE INTERNAÇÃO Hospital de campanha',
            'LOCAL DE INTERNAÇÃO Hospital particular de referência',
            'LOCAL DE INTERNAÇÃO Hospital municipal do Ipiranga (encaminhado pelo projeto)',
            'LOCAL DE INTERNAÇÃO Hospital privado financiado pelo projeto',
            'Nome do Hospital de internação',
            'Data de entrada da internação',
            'Data da alta hospitalar',
            'Tempo de internação (data da alta - data da entrada da internação)',

            //'INSUMOS OFERECIDOS PELO PROJETO'
            'Há condição de ficar isolada, sozinha, em um cômodo da casa?',
            'Tem comida disponível, sem precisar sair?',
            'Tem alguém para auxiliá-lo(a)?',
            'Consegue realizar tarefas de autocuidado? (como tomar banho, cozinhar, lavar a própria roupa)',
            'Precisa de algum tipo de ajuda? Comprar remédios de uso contínuo',
            'Precisa de algum tipo de ajuda? Comprar remédios para o tratamento do quadro atual',
            'Precisa de algum tipo de ajuda? Comprar alimento ou outro produtos de necessidade básica',
            'Precisa de algum tipo de ajuda? Outros',
            'Tratamento foi prescrito por algum médico do projeto?',
            'Tratamento financiado - Alopático  (medicamentos convencionais)',
            'Tratamento financiado - PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)',
            'Foi entregue: Cartilha de cuidados',
            'Foi entregue: Termômetro',
            'Foi entregue: Dipirona',
            'Foi entregue: Paracetamol',
            'Foi entregue: Oxímetro',
            'Foi entregue: Máscaras de tecido',
            'Foi entregue: Máscaras de limpeza',
            'Foi entregue: Cesta básica',
            'Se o caso já tiver sido encerrado: oxímetro foi devolvido?',

            // //MONITORAMENTOS
            // 'Monitoramento ID',
            // 'Data do monitoramento',
            // 'QUANTOS DIAS DE SINTOMAS?',
            // 'Horário do monitoramento',
            // 'Sintomas atuais: Tosse',
            // 'Sintomas atuais: Falta de ar',
            // 'Sintomas atuais: Febre',
            // 'Sintomas atuais: Dor de cabeça',
            // 'Sintomas atuais: Perda de olfato',
            // 'Sintomas atuais: Perda de paladar',
            // 'Sintomas atuais: outros',
            // 'Sintomas atuais: Outros DESCREVA',
            // 'Temperatura atual (em graus)',
            // 'Saturação atual (%)',
            // 'Frequência respiratória atual',
            // 'Frequência cardíaca atual',
            // 'Pressão Arterial Atual',
            // 'Algum sinal de gravidade nesse monitoramento?',
            // 'Equipe médica do projeto prescreveu algum medicamento?',
            // 'Medicamento prescrito pela equipe médica do projeto',
            // 'Fazendo uso de alguma PIC (prática integrativa complementar - ex: medicina chinesa)?',
            // 'Fez escaldapés (atenção para restrições - ex: gestantes e diabeticos)',
            // 'Sentiu melhora dos sintomas com escaldapés (atenção para restrições - ex: gestantes e diabeticos)',
            // 'Fez inalação ou vaporização?',
            // 'Sentiu melhora dos sintomas com inalação ou vaporização',

        ];
    }
}
