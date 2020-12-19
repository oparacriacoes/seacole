<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;
use Lava;
use DB;
use Carbon\Carbon;
use App\Monitoramento;
use App\Paciente;

class ChartsController extends Controller
{
  public function index($chart_id)
  {
    $chart_view = 'graph-' . $chart_id;
    return view('pages.graficos.'.$chart_view);
  }

  public function novos_casos_monitorados()
  {
    /*$novos_casos_monitorados_select = DB::select("
    SELECT
        CAST(CONCAT(SUBSTRING(data_inicio,7,4),'-',SUBSTRING(data_inicio,4,2),'-',SUBSTRING(data_inicio,1,2)) AS DATE) AS date
      , COUNT(id) AS value
    FROM
      (SELECT
        id
        , CASE
          WHEN LENGTH(data_inicio) = 8 THEN CONCAT(SUBSTRING(data_inicio,1,6),20,SUBSTRING(data_inicio,7,2))
          ELSE data_inicio
        END AS data_inicio
      FROM
        (SELECT
          id
          , CASE WHEN data_inicio_ac_psicologico IS NULL THEN data_inicio_monitoramento ELSE data_inicio_ac_psicologico END AS data_inicio
        FROM pacientes)TB)TBB
    GROUP BY 1
    ORDER BY 1;
    ");*/
    $novos_casos_monitorados_select = DB::select("
    SELECT
        CAST(CONCAT(SUBSTRING(data_inicio,7,4),'-',SUBSTRING(data_inicio,4,2),'-',SUBSTRING(data_inicio,1,2)) AS DATE) AS date
      , COUNT(id) AS value
    FROM
      (SELECT
        id
        , CASE
          WHEN LENGTH(data_inicio) = 8 THEN CONCAT(SUBSTRING(data_inicio,1,6),20,SUBSTRING(data_inicio,7,2))
          ELSE data_inicio
        END AS data_inicio
      FROM
        (SELECT
          id
          , CASE WHEN data_inicio_ac_psicologico IS NULL THEN data_inicio_monitoramento ELSE data_inicio_ac_psicologico END AS data_inicio
        FROM pacientes)TB)TBB
        WHERE YEAR(CAST(CONCAT(SUBSTRING(data_inicio,7,4),'-',SUBSTRING(data_inicio,4,2),'-',SUBSTRING(data_inicio,1,2)) AS DATE)) <= (SELECT YEAR(SYSDATE()))
    GROUP BY 1
    ORDER BY 1;
    ");
    $novos_casos_monitorados = json_encode($novos_casos_monitorados_select);
    return $novos_casos_monitorados;
  }

  public function monitorados_exclusivo_psicologia()
  {
    $monitorados_exclusivo_psicologia_select = DB::select("
    SELECT
      monitoramento
        , SUM(litres) AS litres
    FROM
    (SELECT
        CASE
        WHEN agente_id IS NULL AND psicologo_id IS NOT NULL THEN 'Casos totais monitorados exclusivamente por equipe de psicologia'
      END AS monitoramento
        , CASE
        WHEN agente_id IS NULL AND psicologo_id IS NOT NULL THEN COUNT(id)
      END AS litres
    FROM pacientes
    GROUP BY agente_id, psicologo_id

    UNION ALL

    SELECT
        'Casos totais monitorados por agentes populares de saúde por equipe de psicologia' AS monitoramento
        , COUNT(id) AS litres
    FROM pacientes
    WHERE id NOT IN (SELECT id FROM pacientes WHERE (agente_id IS NULL AND psicologo_id IS NOT NULL))
    GROUP BY agente_id, psicologo_id
    )TB
    WHERE monitoramento IS NOT NULL
    GROUP BY monitoramento;
    ");
    $monitorados_exclusivo_psicologia = json_encode($monitorados_exclusivo_psicologia_select);
    return $monitorados_exclusivo_psicologia;
  }

  public function situacao_total_casos_monitorados()
  {
    $situacao_total_casos_monitorados_select = DB::select("
    SELECT
    	Case
    		WHEN situacao = 1 THEN 'Caso ativo GRAVE'
    		WHEN situacao = 2 THEN 'Caso ativo LEVE'
    		WHEN situacao = 3 THEN 'Contato caso confirmado - ativo'
    		WHEN situacao = 4 THEN 'Outras situações (sem relação com COVID-19) - ativos'
    		WHEN situacao = 5 THEN 'Exclusivo psicologia - ativo'
    		WHEN situacao = 6 THEN 'Monitoramento encerrado GRAVE - segue apenas com psicólogos'
    		WHEN situacao = 7 THEN 'Monitoramento encerrado LEVE - segue apenas com psicólogos'
    		WHEN situacao = 8 THEN 'Monitoramento encerrado contato - segue apenas com psicólogos'
    		WHEN situacao = 9 THEN 'Monitoramento encerrado outros - segue apenas com psicólogos'
    		WHEN situacao = 10 THEN 'Caso finalizado GRAVE'
    		WHEN situacao = 11 THEN 'Caso finalizado LEVE'
    		WHEN situacao = 12 THEN 'Contato com caso confirmado - finalizado'
    		WHEN situacao = 13 THEN 'Outras situações (sem relação com COVID-19) - finalizado'
    		WHEN situacao = 14 THEN 'Exclusivo psicologia - finalizado'
            ELSE 'Sem informação'
    	END AS situacao
        , COUNT(id) quantidade_casos
    FROM
    	pacientes
    GROUP BY situacao;
    ");
    return array($situacao_total_casos_monitorados_select);
  }

  public function situacao_total_casos_monitorados_1()
  {
    /*$situacao_total_casos_monitorados_1_select = DB::select("
    SELECT
      Case
        WHEN situacao = 1 THEN 'Caso ativo GRAVE'
        WHEN situacao = 2 THEN 'Caso ativo LEVE'
        WHEN situacao = 3 THEN 'Contato caso confirmado - ativo'
        WHEN situacao = 4 THEN 'Outras situações (sem relação com COVID-19) - ativos'
        WHEN situacao = 5 THEN 'Exclusivo psicologia - ativo'
        WHEN situacao = 6 THEN 'Monitoramento encerrado GRAVE - segue apenas com psicólogos'
        WHEN situacao = 7 THEN 'Monitoramento encerrado LEVE - segue apenas com psicólogos'
        WHEN situacao = 8 THEN 'Monitoramento encerrado contato - segue apenas com psicólogos'
        WHEN situacao = 9 THEN 'Monitoramento encerrado outros - segue apenas com psicólogos'
        WHEN situacao = 10 THEN 'Caso finalizado GRAVE'
        WHEN situacao = 11 THEN 'Caso finalizado LEVE'
        WHEN situacao = 12 THEN 'Contato com caso confirmado - finalizado'
        WHEN situacao = 13 THEN 'Outras situações (sem relação com COVID-19) - finalizado'
        WHEN situacao = 14 THEN 'Exclusivo psicologia - finalizado'
            ELSE 'Sem informação'
      END AS situacao
        , COUNT(id) quantidade
    FROM
      pacientes
    GROUP BY situacao
    ORDER BY 2 DESC;
    ");*/
    $situacao_total_casos_monitorados_1_select = DB::select("
    SELECT
      Case
        WHEN situacao = 1 THEN 'Caso ativo GRAVE'
        WHEN situacao = 2 THEN 'Caso ativo LEVE'
        WHEN situacao = 3 THEN 'Contato caso confirmado - ativo'
        WHEN situacao = 4 THEN 'Outras situações (sem relação com COVID-19) - ativos'
        WHEN situacao = 5 THEN 'Exclusivo psicologia - ativo'
        WHEN situacao = 6 THEN 'Monitoramento encerrado GRAVE - segue apenas com psicólogos'
        WHEN situacao = 7 THEN 'Monitoramento encerrado LEVE - segue apenas com psicólogos'
        WHEN situacao = 8 THEN 'Monitoramento encerrado contato - segue apenas com psicólogos'
        WHEN situacao = 9 THEN 'Monitoramento encerrado outros - segue apenas com psicólogos'
        WHEN situacao = 10 THEN 'Caso finalizado GRAVE'
        WHEN situacao = 11 THEN 'Caso finalizado LEVE'
        WHEN situacao = 12 THEN 'Contato com caso confirmado - finalizado'
        WHEN situacao = 13 THEN 'Outras situações (sem relação com COVID-19) - finalizado'
        WHEN situacao = 14 THEN 'Exclusivo psicologia - finalizado'
            ELSE 'Sem informação'
      END AS situacao
        , COUNT(id) quantidade
    FROM
      pacientes
    GROUP BY situacao
    ORDER BY COALESCE(CAST(situacao AS SIGNED),99);
    ");
    $situacao_total_casos_monitorados_1 = json_encode($situacao_total_casos_monitorados_1_select);
    return $situacao_total_casos_monitorados_1;
  }

  public function casos_monitorados_por_cidade()
  {
    $casos_monitorados_por_cidade_select = DB::select("
    SELECT
      Case
        WHEN endereco_cidade IS NULL THEN 'Sem informação'
            ELSE endereco_cidade
      END AS endereco_cidade
      , COUNT(id) quantidade
    FROM
      pacientes
    GROUP BY endereco_cidade
    ORDER BY quantidade
    DESC;
    ");
    $casos_monitorados_por_cidade = json_encode($casos_monitorados_por_cidade_select);
    return $casos_monitorados_por_cidade;
  }

  public function raca_cor_geral()
  {
    //CONSULTA GRÁFICO
    $graph_data_select = DB::select("
    SELECT
    	Case
    		WHEN cor_raca IS NULL THEN 'Sem informação'
            ELSE cor_raca
    	END AS cor_raca
    	, COUNT(id) quantidade
    FROM
    	pacientes
    GROUP BY cor_raca
    ORDER BY quantidade
    DESC;
    ");
    //CONSULTA LEGENDAS
    $legend_data_select = DB::select("
    SELECT CONCAT('Pessoas negras (pretas + parda) totalizam ',FORMAT((SUM(negros)*100)/(SELECT COUNT(id) FROM pacientes),2),'% do total.') AS legenda
    FROM
    (SELECT Case WHEN cor_raca IN ('Preta','Parda') THEN COUNT(id) END negros
    FROM pacientes
    GROUP BY cor_raca)TB;
    ");
    //$graph_data = json_encode($graph_data_select);
    //$legend_data = json_encode($legend_data_select);
    return array($graph_data_select,$legend_data_select);
  }

  public function genero_por_raca_cor()
  {
    //CONSULTA GRÁFICOS
    $genero_por_raca_cor_graph = DB::select("
    SELECT
      COALESCE(identidade_genero, 'Sem informação') AS identidade_genero
        , COALESCE(SUM(sem_informacao),0) AS sem_informacao
        , COALESCE(SUM(preta),0) AS preta
        , COALESCE(SUM(parda),0) AS parda
        , COALESCE(SUM(branca),0) AS branca
        , COALESCE(SUM(amarela),0) AS amarela
        , COALESCE(SUM(indigena),0) AS indigena
    FROM(
      SELECT
        identidade_genero
        , CASE WHEN cor_raca IS NULL THEN COUNT(id) END AS sem_informacao
        , CASE WHEN cor_raca = 'Preta' THEN COUNT(id) END AS preta
        , CASE WHEN cor_raca = 'Parda' THEN COUNT(id) END AS parda
        , CASE WHEN cor_raca = 'Branca' THEN COUNT(id) END AS branca
        , CASE WHEN cor_raca = 'Amarela' THEN COUNT(id) END AS amarela
        , CASE WHEN cor_raca = 'Indígena'THEN COUNT(id) END AS indigena
      FROM pacientes
      GROUP BY
        identidade_genero
        , cor_raca)TB
    GROUP BY
      identidade_genero;
    ");
    //CONSULTA LEGENDAS
    $genero_por_raca_cor_legend = DB::select("
    SELECT CONCAT('São',
    (SELECT COUNT(id) FROM pacientes WHERE cor_raca IN ('Preta','Parda') AND identidade_genero = 'mulher cis'),
    ' mulheres cis e ',
    (SELECT COUNT(id) FROM pacientes WHERE cor_raca IN ('Preta','Parda') AND identidade_genero = 'homem cis'),
    ' homens cis de Raça Negra (Preta + Parda)');
    ");
    return array($genero_por_raca_cor_graph,$genero_por_raca_cor_legend);
  }

  public function faixa_etaria_genero()
  {
    $faixa_etaria_genero_select = DB::select("
    SELECT
      idade
        , COALESCE(SUM(homem),0)* -1 AS homens
        , COALESCE(SUM(mulher),0) AS mulheres
    FROM
      (SELECT
        CASE
          WHEN idade <= 4 THEN '0-4'
          WHEN idade >= 5 AND idade <= 9 THEN '5-9'
          WHEN idade >= 10 AND idade <= 14 THEN '10-14'
          WHEN idade >= 15 AND idade <= 19 THEN '15-19'
          WHEN idade >= 20 AND idade <= 24 THEN '20-24'
          WHEN idade >= 25 AND idade <= 29 THEN '25-29'
          WHEN idade >= 30 AND idade <= 34 THEN '30-34'
          WHEN idade >= 35 AND idade <= 39 THEN '35-39'
          WHEN idade >= 40 AND idade <= 44 THEN '40-44'
          WHEN idade >= 45 AND idade <= 49 THEN '45-49'
          WHEN idade >= 50 AND idade <= 54 THEN '50-54'
          WHEN idade >= 55 AND idade <= 59 THEN '55-59'
          WHEN idade >= 60 AND idade <= 64 THEN '60-64'
          WHEN idade >= 65 AND idade <= 69 THEN '65-69'
          WHEN idade >= 70 AND idade <= 74 THEN '70-74'
          WHEN idade >= 75 AND idade <= 79 THEN '75-79'
          WHEN idade >= 80 AND idade <= 84 THEN '80-84'
          WHEN idade >= 85 AND idade <= 89 THEN '85-89'
          WHEN idade >= 90 AND idade <= 94 THEN '90-94'
          WHEN idade >= 95 AND idade <= 99 THEN '95-99'
          WHEN idade >= 100 AND idade <= 104 THEN '100-104'
          ELSE 'Não informado'
        END AS idade

        , CASE
          WHEN idade <= 4 THEN 0
          WHEN idade >= 5 AND idade <= 9 THEN 1
          WHEN idade >= 10 AND idade <= 14 THEN 2
          WHEN idade >= 15 AND idade <= 19 THEN 3
          WHEN idade >= 20 AND idade <= 24 THEN 4
          WHEN idade >= 25 AND idade <= 29 THEN 5
          WHEN idade >= 30 AND idade <= 34 THEN 6
          WHEN idade >= 35 AND idade <= 39 THEN 7
          WHEN idade >= 40 AND idade <= 44 THEN 8
          WHEN idade >= 45 AND idade <= 49 THEN 9
          WHEN idade >= 50 AND idade <= 54 THEN 10
          WHEN idade >= 55 AND idade <= 59 THEN 11
          WHEN idade >= 60 AND idade <= 64 THEN 12
          WHEN idade >= 65 AND idade <= 69 THEN 13
          WHEN idade >= 70 AND idade <= 74 THEN 14
          WHEN idade >= 75 AND idade <= 79 THEN 15
          WHEN idade >= 80 AND idade <= 84 THEN 16
          WHEN idade >= 85 AND idade <= 89 THEN 17
          WHEN idade >= 90 AND idade <= 94 THEN 18
          WHEN idade >= 95 AND idade <= 99 THEN 19
          WHEN idade >= 100 AND idade <= 104 THEN 20
                ELSE 21
        END AS ordem_faixa
        , CASE
          WHEN identidade_genero LIKE 'homem%' THEN COUNT(id)
        END AS homem
        , CASE
          WHEN identidade_genero LIKE 'mulher%' THEN COUNT(id)
        END AS mulher
      FROM
        (SELECT
          TIMESTAMPDIFF (YEAR,STR_TO_DATE(data_nascimento,'%d/%m/%Y'),CURDATE()) AS idade
          , id
                , identidade_genero
        FROM pacientes)TB
      GROUP BY idade, identidade_genero)TBB
    GROUP BY idade, ordem_faixa
    ORDER BY ordem_faixa;
    ");
    $faixa_etaria_genero = json_encode($faixa_etaria_genero_select);
    return $faixa_etaria_genero;
  }

  public function faixa_etaria_genero_2()
  {
    $faixa_etaria_genero_2_select = DB::select("
    SELECT
          faixa_idade AS idade
            , COALESCE(SUM(homem),0) AS homens
            , COALESCE(SUM(mulher),0) AS mulheres
            , COALESCE(SUM(sem_informacao),0) AS sem_informacao
        FROM
          (SELECT
            CASE
              WHEN idade <= 4 THEN '0-4'
              WHEN idade >= 5 AND idade <= 9 THEN '5-9'
              WHEN idade >= 10 AND idade <= 14 THEN '10-14'
              WHEN idade >= 15 AND idade <= 19 THEN '15-19'
              WHEN idade >= 20 AND idade <= 24 THEN '20-24'
              WHEN idade >= 25 AND idade <= 29 THEN '25-29'
              WHEN idade >= 30 AND idade <= 34 THEN '30-34'
              WHEN idade >= 35 AND idade <= 39 THEN '35-39'
              WHEN idade >= 40 AND idade <= 44 THEN '40-44'
              WHEN idade >= 45 AND idade <= 49 THEN '45-49'
              WHEN idade >= 50 AND idade <= 54 THEN '50-54'
              WHEN idade >= 55 AND idade <= 59 THEN '55-59'
              WHEN idade >= 60 AND idade <= 64 THEN '60-64'
              WHEN idade >= 65 AND idade <= 69 THEN '65-69'
              WHEN idade >= 70 AND idade <= 74 THEN '70-74'
              WHEN idade >= 75 AND idade <= 79 THEN '75-79'
              WHEN idade >= 80 AND idade <= 84 THEN '80-84'
              WHEN idade >= 85 AND idade <= 89 THEN '85-89'
              WHEN idade >= 90 AND idade <= 94 THEN '90-94'
              WHEN idade >= 95 AND idade <= 99 THEN '95-99'
              WHEN idade >= 100 AND idade <= 104 THEN '100-104'
              ELSE 'Não informado'
            END AS faixa_idade

            , CASE
              WHEN idade <= 4 THEN 0
              WHEN idade >= 5 AND idade <= 9 THEN 1
              WHEN idade >= 10 AND idade <= 14 THEN 2
              WHEN idade >= 15 AND idade <= 19 THEN 3
              WHEN idade >= 20 AND idade <= 24 THEN 4
              WHEN idade >= 25 AND idade <= 29 THEN 5
              WHEN idade >= 30 AND idade <= 34 THEN 6
              WHEN idade >= 35 AND idade <= 39 THEN 7
              WHEN idade >= 40 AND idade <= 44 THEN 8
              WHEN idade >= 45 AND idade <= 49 THEN 9
              WHEN idade >= 50 AND idade <= 54 THEN 10
              WHEN idade >= 55 AND idade <= 59 THEN 11
              WHEN idade >= 60 AND idade <= 64 THEN 12
              WHEN idade >= 65 AND idade <= 69 THEN 13
              WHEN idade >= 70 AND idade <= 74 THEN 14
              WHEN idade >= 75 AND idade <= 79 THEN 15
              WHEN idade >= 80 AND idade <= 84 THEN 16
              WHEN idade >= 85 AND idade <= 89 THEN 17
              WHEN idade >= 90 AND idade <= 94 THEN 18
              WHEN idade >= 95 AND idade <= 99 THEN 19
              WHEN idade >= 100 AND idade <= 104 THEN 20
                    ELSE 21
            END AS ordem_faixa
            , CASE
              WHEN identidade_genero LIKE 'homem%' THEN COUNT(id)
            END AS homem
            , CASE
              WHEN identidade_genero LIKE 'mulher%' THEN COUNT(id)
            END AS mulher
            , CASE
              WHEN identidade_genero IS NULL THEN COUNT(id)
            END AS sem_informacao

          FROM
            (SELECT
              TIMESTAMPDIFF (YEAR,STR_TO_DATE(data_nascimento,'%d/%m/%Y'),CURDATE()) AS idade
              , id
              , identidade_genero
            FROM pacientes)TB
          GROUP BY idade, identidade_genero)TBB
        GROUP BY faixa_idade, ordem_faixa
        ORDER BY ordem_faixa
    ");
    return array($faixa_etaria_genero_2_select);
  }

  public function faixa_etaria_raca_cor()
  {
    $faixa_etaria_raca_cor_graph = DB::select("
    SELECT
      faixa_idade
        , COALESCE(SUM(sem_informacao),0) AS sem_informacao
        , COALESCE(SUM(preta),0) AS preta
        , COALESCE(SUM(parda),0) AS parda
        , COALESCE(SUM(branca),0) AS branca
        , COALESCE(SUM(amarela),0) AS amarela
        , COALESCE(SUM(indigena),0) AS indigena
    FROM
      (SELECT
        CASE
          WHEN idade <= 4 THEN '0-4'
          WHEN idade >= 5 AND idade <= 9 THEN '5-9'
          WHEN idade >= 10 AND idade <= 14 THEN '10-14'
          WHEN idade >= 15 AND idade <= 19 THEN '15-19'
          WHEN idade >= 20 AND idade <= 24 THEN '20-24'
          WHEN idade >= 25 AND idade <= 29 THEN '25-29'
          WHEN idade >= 30 AND idade <= 34 THEN '30-34'
          WHEN idade >= 35 AND idade <= 39 THEN '35-39'
          WHEN idade >= 40 AND idade <= 44 THEN '40-44'
          WHEN idade >= 45 AND idade <= 49 THEN '45-49'
          WHEN idade >= 50 AND idade <= 54 THEN '50-54'
          WHEN idade >= 55 AND idade <= 59 THEN '55-59'
          WHEN idade >= 60 AND idade <= 64 THEN '60-64'
          WHEN idade >= 65 AND idade <= 69 THEN '65-69'
          WHEN idade >= 70 AND idade <= 74 THEN '70-74'
          WHEN idade >= 75 AND idade <= 79 THEN '75-79'
          WHEN idade >= 80 AND idade <= 84 THEN '80-84'
          WHEN idade >= 85 AND idade <= 89 THEN '85-89'
          WHEN idade >= 90 AND idade <= 94 THEN '90-94'
          WHEN idade >= 95 AND idade <= 99 THEN '95-99'
          WHEN idade >= 100 AND idade <= 104 THEN '100-104'
          ELSE 'Não informado'
        END AS faixa_idade

        , CASE
          WHEN idade <= 4 THEN 0
          WHEN idade >= 5 AND idade <= 9 THEN 1
          WHEN idade >= 10 AND idade <= 14 THEN 2
          WHEN idade >= 15 AND idade <= 19 THEN 3
          WHEN idade >= 20 AND idade <= 24 THEN 4
          WHEN idade >= 25 AND idade <= 29 THEN 5
          WHEN idade >= 30 AND idade <= 34 THEN 6
          WHEN idade >= 35 AND idade <= 39 THEN 7
          WHEN idade >= 40 AND idade <= 44 THEN 8
          WHEN idade >= 45 AND idade <= 49 THEN 9
          WHEN idade >= 50 AND idade <= 54 THEN 10
          WHEN idade >= 55 AND idade <= 59 THEN 11
          WHEN idade >= 60 AND idade <= 64 THEN 12
          WHEN idade >= 65 AND idade <= 69 THEN 13
          WHEN idade >= 70 AND idade <= 74 THEN 14
          WHEN idade >= 75 AND idade <= 79 THEN 15
          WHEN idade >= 80 AND idade <= 84 THEN 16
          WHEN idade >= 85 AND idade <= 89 THEN 17
          WHEN idade >= 90 AND idade <= 94 THEN 18
          WHEN idade >= 95 AND idade <= 99 THEN 19
          WHEN idade >= 100 AND idade <= 104 THEN 20
                ELSE 21
        END AS ordem_faixa
        , CASE WHEN cor_raca IS NULL THEN COUNT(id) END AS sem_informacao
        , CASE WHEN cor_raca = 'Preta' THEN COUNT(id) END AS preta
        , CASE WHEN cor_raca = 'Parda' THEN COUNT(id) END AS parda
        , CASE WHEN cor_raca = 'Branca' THEN COUNT(id) END AS branca
        , CASE WHEN cor_raca = 'Amarela' THEN COUNT(id) END AS amarela
        , CASE WHEN cor_raca = 'Indígena'THEN COUNT(id) END AS indigena
      FROM
        (SELECT
        TIMESTAMPDIFF (YEAR,STR_TO_DATE(data_nascimento,'%d/%m/%Y'),CURDATE()) AS idade
        , id
        , cor_raca
        FROM pacientes)TB
      GROUP BY idade, cor_raca)TBB
    GROUP BY faixa_idade, ordem_faixa
    ORDER BY ordem_faixa;
    ");

    $faixa_etaria_raca_cor_legend = DB::select("
    SELECT CONCAT('*Negras e negros (pretos + pardos): ',GROUP_CONCAT(idade)) AS legenda
    FROM
      (SELECT
        CONCAT(COALESCE(SUM(preta),0) + COALESCE(SUM(parda),0), faixa_idade) idade
      FROM
        (SELECT
        CASE
          WHEN idade <= 4 THEN '0-4'
          WHEN idade >= 5 AND idade <= 9 THEN ' pessoas de 5-9 anos'
          WHEN idade >= 10 AND idade <= 14 THEN ' pessoas de 10-14 anos'
          WHEN idade >= 15 AND idade <= 19 THEN ' pessoas de 15-19 anos'
          WHEN idade >= 20 AND idade <= 24 THEN ' pessoas de 20-24 anos'
          WHEN idade >= 25 AND idade <= 29 THEN ' pessoas de 25-29 anos'
          WHEN idade >= 30 AND idade <= 34 THEN ' pessoas de 30-34 anos'
          WHEN idade >= 35 AND idade <= 39 THEN ' pessoas de 35-39 anos'
          WHEN idade >= 40 AND idade <= 44 THEN ' pessoas de 40-44 anos'
          WHEN idade >= 45 AND idade <= 49 THEN ' pessoas de 45-49 anos'
          WHEN idade >= 50 AND idade <= 54 THEN ' pessoas de 50-54 anos'
          WHEN idade >= 55 AND idade <= 59 THEN ' pessoas de 55-59 anos'
          WHEN idade >= 60 AND idade <= 64 THEN ' pessoas de 60-64 anos'
          WHEN idade >= 65 AND idade <= 69 THEN ' pessoas de 65-69 anos'
          WHEN idade >= 70 AND idade <= 74 THEN ' pessoas de 70-74 anos'
          WHEN idade >= 75 AND idade <= 79 THEN ' pessoas de 75-79 anos'
          WHEN idade >= 80 AND idade <= 84 THEN ' pessoas de 80-84 anos'
          WHEN idade >= 85 AND idade <= 89 THEN ' pessoas de 85-89 anos'
          WHEN idade >= 90 AND idade <= 94 THEN ' pessoas de 90-94 anos'
          WHEN idade >= 95 AND idade <= 99 THEN ' pessoas de 95-99 anos'
          WHEN idade >= 100 AND idade <= 104 THEN ' pessoas de 100-104 anos'
          ELSE ' pessoas sem informação de idade'
        END AS faixa_idade

        , CASE
          WHEN idade <= 4 THEN 0
          WHEN idade >= 5 AND idade <= 9 THEN 1
          WHEN idade >= 10 AND idade <= 14 THEN 2
          WHEN idade >= 15 AND idade <= 19 THEN 3
          WHEN idade >= 20 AND idade <= 24 THEN 4
          WHEN idade >= 25 AND idade <= 29 THEN 5
          WHEN idade >= 30 AND idade <= 34 THEN 6
          WHEN idade >= 35 AND idade <= 39 THEN 7
          WHEN idade >= 40 AND idade <= 44 THEN 8
          WHEN idade >= 45 AND idade <= 49 THEN 9
          WHEN idade >= 50 AND idade <= 54 THEN 10
          WHEN idade >= 55 AND idade <= 59 THEN 11
          WHEN idade >= 60 AND idade <= 64 THEN 12
          WHEN idade >= 65 AND idade <= 69 THEN 13
          WHEN idade >= 70 AND idade <= 74 THEN 14
          WHEN idade >= 75 AND idade <= 79 THEN 15
          WHEN idade >= 80 AND idade <= 84 THEN 16
          WHEN idade >= 85 AND idade <= 89 THEN 17
          WHEN idade >= 90 AND idade <= 94 THEN 18
          WHEN idade >= 95 AND idade <= 99 THEN 19
          WHEN idade >= 100 AND idade <= 104 THEN 20
            ELSE 21
        END AS ordem_faixa
        , CASE WHEN cor_raca IS NULL THEN COUNT(id) END AS sem_informacao
        , CASE WHEN cor_raca = 'Preta' THEN COUNT(id) END AS preta
        , CASE WHEN cor_raca = 'Parda' THEN COUNT(id) END AS parda
        , CASE WHEN cor_raca = 'Branca' THEN COUNT(id) END AS branca
        , CASE WHEN cor_raca = 'Amarela' THEN COUNT(id) END AS amarela
        , CASE WHEN cor_raca = 'Indígena'THEN COUNT(id) END AS indigena
        FROM
        (SELECT
          TIMESTAMPDIFF (YEAR,STR_TO_DATE(data_nascimento,'%d/%m/%Y'),CURDATE()) AS idade
          , id
          , cor_raca
        FROM pacientes)TB
        GROUP BY idade, cor_raca)TBB
      GROUP BY faixa_idade, ordem_faixa
      ORDER BY ordem_faixa)TBBB;
    ");
    return array($faixa_etaria_raca_cor_graph,$faixa_etaria_raca_cor_legend);
  }

  public function numero_pessoas_residencia_raca_cor()
  {
    $numero_pessoas_residencia_raca_cor_graph = DB::select("
    SELECT
    	COALESCE(numero_pessoas_residencia, 'Sem inf.') AS numero_pessoas_residencia
        , COALESCE(SUM(sem_informacao),0) AS sem_informacao
        , COALESCE(SUM(preta),0) AS preta
        , COALESCE(SUM(parda),0) AS parda
        , COALESCE(SUM(branca),0) AS branca
        , COALESCE(SUM(amarela),0) AS amarela
        , COALESCE(SUM(indigena),0) AS indigena
    FROM
      (SELECT
        numero_pessoas_residencia
        , CASE WHEN cor_raca IS NULL THEN COUNT(id) END AS sem_informacao
        , CASE WHEN cor_raca = 'Preta' THEN COUNT(id) END AS preta
        , CASE WHEN cor_raca = 'Parda' THEN COUNT(id) END AS parda
        , CASE WHEN cor_raca = 'Branca' THEN COUNT(id) END AS branca
        , CASE WHEN cor_raca = 'Amarela' THEN COUNT(id) END AS amarela
        , CASE WHEN cor_raca = 'Indígena'THEN COUNT(id) END AS indigena
      FROM
        (SELECT
    		numero_pessoas_residencia
    		, id
    		, cor_raca
        FROM pacientes)TB
      GROUP BY numero_pessoas_residencia, cor_raca)TBB
    GROUP BY numero_pessoas_residencia
    ORDER BY numero_pessoas_residencia;
    ");

    $numero_pessoas_residencia_raca_cor_legend = DB::select("
    SELECT CONCAT('*Negras e negros (pretos + pardos): ',GROUP_CONCAT(numero_pessoas_residencia)) AS legenda
    FROM
    	(SELECT
    		CASE
    			WHEN numero_pessoas_residencia = 'Sem inf. ' THEN CONCAT(COALESCE(SUM(preta),0) + COALESCE(SUM(parda),0), ' pessoas sem informação ')
    			ELSE CONCAT(COALESCE(SUM(preta),0) + COALESCE(SUM(parda),0), ' pessoas com ', numero_pessoas_residencia, ' moradores por residencia')
    		END AS numero_pessoas_residencia
    	  FROM
    		(SELECT
    			COALESCE(numero_pessoas_residencia, 'Sem inf. ') AS numero_pessoas_residencia
    			, COALESCE(SUM(sem_informacao),0) AS sem_informacao
    			, COALESCE(SUM(preta),0) AS preta
    			, COALESCE(SUM(parda),0) AS parda
    			, COALESCE(SUM(branca),0) AS branca
    			, COALESCE(SUM(amarela),0) AS amarela
    			, COALESCE(SUM(indigena),0) AS indigena
    		FROM
    		  (SELECT
    			numero_pessoas_residencia
    			, CASE WHEN cor_raca IS NULL THEN COUNT(id) END AS sem_informacao
    			, CASE WHEN cor_raca = 'Preta' THEN COUNT(id) END AS preta
    			, CASE WHEN cor_raca = 'Parda' THEN COUNT(id) END AS parda
    			, CASE WHEN cor_raca = 'Branca' THEN COUNT(id) END AS branca
    			, CASE WHEN cor_raca = 'Amarela' THEN COUNT(id) END AS amarela
    			, CASE WHEN cor_raca = 'Indígena'THEN COUNT(id) END AS indigena
    		  FROM
    			(SELECT
    				numero_pessoas_residencia
    				, id
    				, cor_raca
    			FROM pacientes)TB
    		  GROUP BY numero_pessoas_residencia, cor_raca)TBB
    		GROUP BY numero_pessoas_residencia
    		ORDER BY numero_pessoas_residencia)TBBB
    	GROUP BY numero_pessoas_residencia)TBBBB;
    ");
    return array($numero_pessoas_residencia_raca_cor_graph,$numero_pessoas_residencia_raca_cor_legend);
  }

  public function classe_social_renda_bruta_familiar()
  {
    $classe_social_renda_bruta_familiar_graph = DB::select("
    SELECT
      renda_residencia
        , COALESCE(SUM(sem_informacao),0) AS sem_informacao
        , COALESCE(SUM(preta),0) AS preta
        , COALESCE(SUM(parda),0) AS parda
        , COALESCE(SUM(branca),0) AS branca
        , COALESCE(SUM(amarela),0) AS amarela
        , COALESCE(SUM(indigena),0) AS indigena
    FROM
      (SELECT
        CASE
          WHEN renda_residencia > 0 AND renda_residencia <= 1.254 THEN 'Classe E'
          WHEN renda_residencia >= 1.255 AND renda_residencia <= 2.004 THEN 'Classe D'
          WHEN renda_residencia >= 2.005 AND renda_residencia <= 8.640 THEN 'Classe C'
          WHEN renda_residencia >= 8.641 AND renda_residencia <= 11.261 THEN 'Classe B'
          WHEN renda_residencia >= 11.262 THEN 'Classe A'
          ELSE 'Sim inf.'
        END AS renda_residencia
        , CASE WHEN cor_raca IS NULL THEN COUNT(id) END AS sem_informacao
        , CASE WHEN cor_raca = 'Preta' THEN COUNT(id) END AS preta
        , CASE WHEN cor_raca = 'Parda' THEN COUNT(id) END AS parda
        , CASE WHEN cor_raca = 'Branca' THEN COUNT(id) END AS branca
        , CASE WHEN cor_raca = 'Amarela' THEN COUNT(id) END AS amarela
        , CASE WHEN cor_raca = 'Indígena'THEN COUNT(id) END AS indigena
      FROM pacientes
      GROUP BY renda_residencia, cor_raca)TBB
    GROUP BY renda_residencia
    ORDER BY renda_residencia;
    ");

    $classe_social_renda_bruta_familiar_legend = DB::select("
    SELECT CONCAT('*Negras e negros (pretos + pardos): ',GROUP_CONCAT(renda_residencia)) AS legenda
    FROM
      (SELECT
        CONCAT(COALESCE(SUM(preta),0) + COALESCE(SUM(parda),0), renda_residencia) renda_residencia
      FROM
        (SELECT
      renda_residencia
        , COALESCE(SUM(sem_informacao),0) AS sem_informacao
        , COALESCE(SUM(preta),0) AS preta
        , COALESCE(SUM(parda),0) AS parda
        , COALESCE(SUM(branca),0) AS branca
        , COALESCE(SUM(amarela),0) AS amarela
        , COALESCE(SUM(indigena),0) AS indigena
    FROM
      (SELECT
        CASE
          WHEN renda_residencia > 0 AND renda_residencia <= 1.254 THEN ' Classe E'
          WHEN renda_residencia >= 1.255 AND renda_residencia <= 2.004 THEN ' Classe D'
          WHEN renda_residencia >= 2.005 AND renda_residencia <= 8.640 THEN ' Classe C'
          WHEN renda_residencia >= 8.641 AND renda_residencia <= 11.261 THEN ' Classe B'
          WHEN renda_residencia >= 11.262 THEN ' Classe A'
          ELSE ' Sem inf.'
        END AS renda_residencia
        , CASE WHEN cor_raca IS NULL THEN COUNT(id) END AS sem_informacao
        , CASE WHEN cor_raca = 'Preta' THEN COUNT(id) END AS preta
        , CASE WHEN cor_raca = 'Parda' THEN COUNT(id) END AS parda
        , CASE WHEN cor_raca = 'Branca' THEN COUNT(id) END AS branca
        , CASE WHEN cor_raca = 'Amarela' THEN COUNT(id) END AS amarela
        , CASE WHEN cor_raca = 'Indígena'THEN COUNT(id) END AS indigena
      FROM pacientes
      GROUP BY renda_residencia, cor_raca)TBB
    GROUP BY renda_residencia
    ORDER BY renda_residencia)TBBB
      GROUP BY renda_residencia
      ORDER BY renda_residencia)TBBBB;
    ");
    return array($classe_social_renda_bruta_familiar_graph,$classe_social_renda_bruta_familiar_legend);
  }

  public function classe_social_renda_per_capta_raca_cor()
  {
    $classe_social_renda_per_capta_raca_cor_graph = DB::select("
    SELECT
      renda_residencia
        , COALESCE(SUM(sem_informacao),0) AS sem_informacao
        , COALESCE(SUM(preta),0) AS preta
        , COALESCE(SUM(parda),0) AS parda
        , COALESCE(SUM(branca),0) AS branca
        , COALESCE(SUM(amarela),0) AS amarela
        , COALESCE(SUM(indigena),0) AS indigena
    FROM
      (SELECT
        CASE
          WHEN renda_residencia/numero_pessoas_residencia > 0 AND renda_residencia/numero_pessoas_residencia <= 1.254 THEN 'Classe E'
          WHEN renda_residencia/numero_pessoas_residencia >= 1.255 AND renda_residencia/numero_pessoas_residencia <= 2.004 THEN 'Classe D'
          WHEN renda_residencia/numero_pessoas_residencia >= 2.005 AND renda_residencia/numero_pessoas_residencia <= 8.640 THEN 'Classe C'
          WHEN renda_residencia/numero_pessoas_residencia >= 8.641 AND renda_residencia/numero_pessoas_residencia <= 11.261 THEN 'Classe B'
          WHEN renda_residencia/numero_pessoas_residencia >= 11.262 THEN 'Classe A'
          ELSE 'Sim inf.'
        END AS renda_residencia
        , CASE WHEN cor_raca IS NULL THEN COUNT(id) END AS sem_informacao
        , CASE WHEN cor_raca = 'Preta' THEN COUNT(id) END AS preta
        , CASE WHEN cor_raca = 'Parda' THEN COUNT(id) END AS parda
        , CASE WHEN cor_raca = 'Branca' THEN COUNT(id) END AS branca
        , CASE WHEN cor_raca = 'Amarela' THEN COUNT(id) END AS amarela
        , CASE WHEN cor_raca = 'Indígena'THEN COUNT(id) END AS indigena
      FROM pacientes
      GROUP BY renda_residencia, numero_pessoas_residencia, cor_raca)TBB
    GROUP BY renda_residencia
    ORDER BY renda_residencia;
    ");

    $classe_social_renda_per_capta_raca_cor_legend = DB::select("
    SELECT CONCAT('*Negras e negros (pretos + pardos): ',GROUP_CONCAT(renda_residencia)) AS legenda
    FROM
      (SELECT
        CONCAT(COALESCE(SUM(preta),0) + COALESCE(SUM(parda),0), renda_residencia) renda_residencia
      FROM
        (SELECT
      renda_residencia
        , COALESCE(SUM(sem_informacao),0) AS sem_informacao
        , COALESCE(SUM(preta),0) AS preta
        , COALESCE(SUM(parda),0) AS parda
        , COALESCE(SUM(branca),0) AS branca
        , COALESCE(SUM(amarela),0) AS amarela
        , COALESCE(SUM(indigena),0) AS indigena
    FROM
      (SELECT
        CASE
          WHEN renda_residencia/numero_pessoas_residencia > 0 AND renda_residencia/numero_pessoas_residencia <= 1.254 THEN ' Classe E'
          WHEN renda_residencia/numero_pessoas_residencia >= 1.255 AND renda_residencia/numero_pessoas_residencia <= 2.004 THEN ' Classe D'
          WHEN renda_residencia/numero_pessoas_residencia >= 2.005 AND renda_residencia/numero_pessoas_residencia <= 8.640 THEN ' Classe C'
          WHEN renda_residencia/numero_pessoas_residencia >= 8.641 AND renda_residencia/numero_pessoas_residencia <= 11.261 THEN ' Classe B'
          WHEN renda_residencia/numero_pessoas_residencia >= 11.262 THEN ' Classe A'
          ELSE ' Sem inf.'
        END AS renda_residencia
        , CASE WHEN cor_raca IS NULL THEN COUNT(id) END AS sem_informacao
        , CASE WHEN cor_raca = 'Preta' THEN COUNT(id) END AS preta
        , CASE WHEN cor_raca = 'Parda' THEN COUNT(id) END AS parda
        , CASE WHEN cor_raca = 'Branca' THEN COUNT(id) END AS branca
        , CASE WHEN cor_raca = 'Amarela' THEN COUNT(id) END AS amarela
        , CASE WHEN cor_raca = 'Indígena'THEN COUNT(id) END AS indigena
      FROM pacientes
      GROUP BY renda_residencia, numero_pessoas_residencia, cor_raca)TBB
    GROUP BY renda_residencia
    ORDER BY renda_residencia)TBBB
      GROUP BY renda_residencia
      ORDER BY renda_residencia)TBBBB;
    ");
    return array($classe_social_renda_per_capta_raca_cor_graph,$classe_social_renda_per_capta_raca_cor_legend);
  }

  public function raca_cor_por_auxilio_emergencial()
  {
    $raca_cor_por_auxilio_emergencial = DB::select("
    SELECT
      cor_raca
        , COALESCE(SUM(sem_informacao),0) AS sem_informacao
        , COALESCE(SUM(sim),0) AS sim
        , COALESCE(SUM(nao),0) AS nao
        , COALESCE(SUM(sim_preta),0) AS sim_preta
        , COALESCE(SUM(nao_preta),0) AS nao_preta
        , COALESCE(SUM(sim_parda),0) AS sim_parda
        , COALESCE(SUM(nao_parda),0) AS nao_parda
    FROM   (
      SELECT
        CASE
          WHEN cor_raca IS NULL THEN 'Sem info.'
                WHEN cor_raca IN ('Preta','Parda') THEN 'Negra'
        ELSE cor_raca END AS cor_raca
            , CASE
          WHEN auxilio_emergencial IS NULL THEN COUNT(id)
        END AS sem_informacao
            , CASE
          WHEN auxilio_emergencial = 'sim' AND cor_raca NOT IN ('Preta','Parda') THEN COUNT(id)
        END AS sim
            , CASE
          WHEN auxilio_emergencial = 'não' AND cor_raca NOT IN ('Preta','Parda') THEN COUNT(id)
            END AS nao
            , CASE
          WHEN auxilio_emergencial = 'sim' AND cor_raca = 'Preta' THEN COUNT(id)
            END AS sim_preta
            , CASE
          WHEN auxilio_emergencial = 'não' AND cor_raca = 'Preta' THEN COUNT(id)
            END AS nao_preta
            , CASE
          WHEN auxilio_emergencial = 'sim' AND cor_raca = 'Parda' THEN COUNT(id)
        END AS sim_parda
            , CASE
          WHEN auxilio_emergencial = 'não' AND cor_raca = 'Parda' THEN COUNT(id)
        END AS nao_parda
      FROM pacientes
        GROUP BY auxilio_emergencial, cor_raca)TBB
    GROUP BY cor_raca
    ORDER BY cor_raca;
    ");
    return array($raca_cor_por_auxilio_emergencial);
  }

  public function insumos_oferecidos_pelo_projeto_raca_cor_1()
  {
    /*$insumos_oferecidos_pelo_projeto = DB::select("
    SELECT
        cor_raca
        , COALESCE((CASE WHEN cor_raca IN ('Preta','Parda') THEN SUM(sim_isolamento_residencial) END), 0) AS sim_isolamento_residencial_N
        , COALESCE((CASE WHEN cor_raca IN ('Preta','Parda') THEN SUM(nao_isolamento_residencial) END), 0) AS nao_isolamento_residencial_N
        , COALESCE((CASE WHEN cor_raca IN ('Preta','Parda') THEN SUM(sem_info_isolamento_residencial) END), 0) AS sem_info_isolamento_residencial_N
        , COALESCE((CASE WHEN cor_raca IN ('Preta','Parda') THEN SUM(sim_alimentacao_disponivel) END), 0) AS sim_alimentacao_disponivel_N
        , COALESCE((CASE WHEN cor_raca IN ('Preta','Parda') THEN SUM(nao_alimentacao_disponivel) END), 0) AS nao_alimentacao_disponivel_N
        , COALESCE((CASE WHEN cor_raca IN ('Preta','Parda') THEN SUM(sem_info_alimentacao_disponivel) END), 0) AS sem_info_alimentacao_disponivel_N
        , COALESCE((CASE WHEN cor_raca IN ('Preta','Parda') THEN SUM(sim_auxilio_terceiros) END), 0) AS sim_auxilio_terceiros_N
        , COALESCE((CASE WHEN cor_raca IN ('Preta','Parda') THEN SUM(nao_auxilio_terceiros) END), 0) AS nao_auxilio_terceiros_N
        , COALESCE((CASE WHEN cor_raca IN ('Preta','Parda') THEN SUM(sem_info_auxilio_terceiros) END), 0) AS sem_info_auxilio_terceiros_N
        , COALESCE((CASE WHEN cor_raca IN ('Preta','Parda') THEN SUM(sim_tarefas_autocuidado)END), 0) AS sim_tarefas_autocuidado_N
        , COALESCE((CASE WHEN cor_raca IN ('Preta','Parda') THEN SUM(nao_tarefas_autocuidado)END), 0) AS nao_tarefas_autocuidado_N
        , COALESCE((CASE WHEN cor_raca IN ('Preta','Parda') THEN SUM(sem_info_tarefas_autocuidado) END), 0) AS sem_info_tarefas_autocuidado_N

        , COALESCE((CASE WHEN cor_raca NOT IN ('Preta','Parda') THEN SUM(sim_isolamento_residencial) END), 0) AS sim_isolamento_residencial
        , COALESCE((CASE WHEN cor_raca NOT IN ('Preta','Parda') THEN SUM(nao_isolamento_residencial) END), 0) AS nao_isolamento_residencial
        , COALESCE((CASE WHEN cor_raca NOT IN ('Preta','Parda') THEN SUM(sem_info_isolamento_residencial) END), 0) AS sem_info_isolamento_residencial
        , COALESCE((CASE WHEN cor_raca NOT IN ('Preta','Parda') THEN SUM(sim_alimentacao_disponivel) END), 0) AS sim_alimentacao_disponivel
        , COALESCE((CASE WHEN cor_raca NOT IN ('Preta','Parda') THEN SUM(nao_alimentacao_disponivel) END), 0) AS nao_alimentacao_disponivel
        , COALESCE((CASE WHEN cor_raca NOT IN ('Preta','Parda') THEN SUM(sem_info_alimentacao_disponivel) END), 0) AS sem_info_alimentacao_disponivel
        , COALESCE((CASE WHEN cor_raca NOT IN ('Preta','Parda') THEN SUM(sim_auxilio_terceiros) END), 0) AS sim_auxilio_terceiros
        , COALESCE((CASE WHEN cor_raca NOT IN ('Preta','Parda') THEN SUM(nao_auxilio_terceiros) END), 0) AS nao_auxilio_terceiros
        , COALESCE((CASE WHEN cor_raca NOT IN ('Preta','Parda') THEN SUM(sem_info_auxilio_terceiros) END), 0) AS sem_info_auxilio_terceiros
        , COALESCE((CASE WHEN cor_raca NOT IN ('Preta','Parda') THEN SUM(sim_tarefas_autocuidado) END), 0) AS sim_tarefas_autocuidado
        , COALESCE((CASE WHEN cor_raca NOT IN ('Preta','Parda') THEN SUM(nao_tarefas_autocuidado) END), 0) AS nao_tarefas_autocuidado
        , COALESCE((CASE WHEN cor_raca NOT IN ('Preta','Parda') THEN SUM(sem_info_tarefas_autocuidado) END), 0) AS sem_info_tarefas_autocuidado
    FROM
    (
        SELECT
                COALESCE(cor_raca, 'Sem inf.') AS cor_raca
                , CASE WHEN isolamento_residencial = 'sim' THEN COUNT(id) END AS sim_isolamento_residencial
                , CASE WHEN isolamento_residencial = 'não' THEN COUNT(id) END AS nao_isolamento_residencial
                , CASE WHEN isolamento_residencial IS NULL THEN COUNT(id) END AS sem_info_isolamento_residencial
                , CASE WHEN alimentacao_disponivel = 'sim' THEN COUNT(id) END AS sim_alimentacao_disponivel
                , CASE WHEN alimentacao_disponivel = 'não' THEN COUNT(id) END AS nao_alimentacao_disponivel
                , CASE WHEN alimentacao_disponivel IS NULL THEN COUNT(id) END AS sem_info_alimentacao_disponivel
                , CASE WHEN auxilio_terceiros = 'sim' THEN COUNT(id) END AS sim_auxilio_terceiros
                , CASE WHEN auxilio_terceiros = 'não' THEN COUNT(id) END AS nao_auxilio_terceiros
                , CASE WHEN auxilio_terceiros IS NULL THEN COUNT(id) END AS sem_info_auxilio_terceiros
                , CASE WHEN tarefas_autocuidado = 'sim' THEN COUNT(id) END AS sim_tarefas_autocuidado
                , CASE WHEN tarefas_autocuidado = 'não' THEN COUNT(id) END AS nao_tarefas_autocuidado
                , CASE WHEN tarefas_autocuidado IS NULL THEN COUNT(id) END AS sem_info_tarefas_autocuidado
        FROM pacientes
        GROUP BY cor_raca, isolamento_residencial, alimentacao_disponivel, auxilio_terceiros, tarefas_autocuidado)TB
    GROUP BY cor_raca;
    ");*/
    $insumos_oferecidos_pelo_projeto_raca_cor_1 = DB::select("
    SELECT
        CONCAT('Sim \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Há condição de ficar isolada, sozinha, em um cômodo da casa?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND isolamento_residencial = 'sim' THEN COUNT(id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND isolamento_residencial = 'sim' THEN COUNT(id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND isolamento_residencial = 'sim' THEN COUNT(id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND isolamento_residencial = 'sim' THEN COUNT(id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND isolamento_residencial = 'sim' THEN COUNT(id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND isolamento_residencial = 'sim' THEN COUNT(id) END AS nao_info_sim
        FROM pacientes
        GROUP BY cor_raca, isolamento_residencial)TB
      GROUP BY pergunta

      UNION ALL

      SELECT
        CONCAT('Não \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_nao),0) AS branca
        , COALESCE(SUM(indigena_nao),0) AS indigena
        , COALESCE(SUM(amarela_nao),0) AS amarela
        , COALESCE(SUM(preta_nao)+SUM(parda_nao),0) AS negro
        , COALESCE(SUM(nao_info_nao),0) AS nao_info
      FROM
        (SELECT
          'Há condição de ficar isolada, sozinha, em um cômodo da casa?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND isolamento_residencial = 'não' THEN COUNT(id) END AS preta_nao
          , CASE WHEN cor_raca = 'Parda' AND isolamento_residencial = 'não' THEN COUNT(id) END AS parda_nao
          , CASE WHEN cor_raca = 'Indígena' AND isolamento_residencial = 'não' THEN COUNT(id) END AS indigena_nao
          , CASE WHEN cor_raca = 'Branca' AND isolamento_residencial = 'não' THEN COUNT(id) END AS branca_nao
          , CASE WHEN cor_raca = 'Amarela' AND isolamento_residencial = 'não' THEN COUNT(id) END AS amarela_nao
          , CASE WHEN cor_raca IS NULL AND isolamento_residencial = 'não' THEN COUNT(id) END AS nao_info_nao
        FROM pacientes
        GROUP BY cor_raca, isolamento_residencial)TB
      GROUP BY pergunta

      UNION ALL

      SELECT
        CONCAT('Sim \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Tem comida disponível, sem precisar sair?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND alimentacao_disponivel = 'sim' THEN COUNT(id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND alimentacao_disponivel = 'sim' THEN COUNT(id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND alimentacao_disponivel = 'sim' THEN COUNT(id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND alimentacao_disponivel = 'sim' THEN COUNT(id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND alimentacao_disponivel = 'sim' THEN COUNT(id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND alimentacao_disponivel = 'sim' THEN COUNT(id) END AS nao_info_sim
        FROM pacientes
        GROUP BY cor_raca, alimentacao_disponivel)TB
      GROUP BY pergunta

      UNION ALL

      SELECT
        CONCAT('Não \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_nao),0) AS branca
        , COALESCE(SUM(indigena_nao),0) AS indigena
        , COALESCE(SUM(amarela_nao),0) AS amarela
        , COALESCE(SUM(preta_nao)+SUM(parda_nao),0) AS negro
        , COALESCE(SUM(nao_info_nao),0) AS nao_info
      FROM
        (SELECT
          'Tem comida disponível, sem precisar sair?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND alimentacao_disponivel = 'não' THEN COUNT(id) END AS preta_nao
          , CASE WHEN cor_raca = 'Parda' AND alimentacao_disponivel = 'não' THEN COUNT(id) END AS parda_nao
          , CASE WHEN cor_raca = 'Indígena' AND alimentacao_disponivel = 'não' THEN COUNT(id) END AS indigena_nao
          , CASE WHEN cor_raca = 'Branca' AND alimentacao_disponivel = 'não' THEN COUNT(id) END AS branca_nao
          , CASE WHEN cor_raca = 'Amarela' AND alimentacao_disponivel = 'não' THEN COUNT(id) END AS amarela_nao
          , CASE WHEN cor_raca IS NULL AND alimentacao_disponivel = 'não' THEN COUNT(id) END AS nao_info_nao
        FROM pacientes
        GROUP BY cor_raca, alimentacao_disponivel)TB
      GROUP BY pergunta

      UNION ALL

      SELECT
        CONCAT('Sim \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Tem alguém para auxiliá-lo(a)?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND auxilio_terceiros = 'sim' THEN COUNT(id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND auxilio_terceiros = 'sim' THEN COUNT(id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND auxilio_terceiros = 'sim' THEN COUNT(id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND auxilio_terceiros = 'sim' THEN COUNT(id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND auxilio_terceiros = 'sim' THEN COUNT(id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND auxilio_terceiros = 'sim' THEN COUNT(id) END AS nao_info_sim
        FROM pacientes
        GROUP BY cor_raca, auxilio_terceiros)TB
      GROUP BY pergunta

      UNION ALL

      SELECT
        CONCAT('Não \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_nao),0) AS branca
        , COALESCE(SUM(indigena_nao),0) AS indigena
        , COALESCE(SUM(amarela_nao),0) AS amarela
        , COALESCE(SUM(preta_nao)+SUM(parda_nao),0) AS negro
        , COALESCE(SUM(nao_info_nao),0) AS nao_info
      FROM
        (SELECT
          'Tem alguém para auxiliá-lo(a)?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND auxilio_terceiros = 'não' THEN COUNT(id) END AS preta_nao
          , CASE WHEN cor_raca = 'Parda' AND auxilio_terceiros = 'não' THEN COUNT(id) END AS parda_nao
          , CASE WHEN cor_raca = 'Indígena' AND auxilio_terceiros = 'não' THEN COUNT(id) END AS indigena_nao
          , CASE WHEN cor_raca = 'Branca' AND auxilio_terceiros = 'não' THEN COUNT(id) END AS branca_nao
          , CASE WHEN cor_raca = 'Amarela' AND auxilio_terceiros = 'não' THEN COUNT(id) END AS amarela_nao
          , CASE WHEN cor_raca IS NULL AND auxilio_terceiros = 'não' THEN COUNT(id) END AS nao_info_nao
        FROM pacientes
        GROUP BY cor_raca, auxilio_terceiros)TB
      GROUP BY pergunta

      UNION ALL

      SELECT
        CONCAT('Sim \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Consegue realizar tarefas de autocuidado? (como tomar banho, cozinhar, lavar a própria roupa)' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND tarefas_autocuidado = 'sim' THEN COUNT(id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND tarefas_autocuidado = 'sim' THEN COUNT(id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND tarefas_autocuidado = 'sim' THEN COUNT(id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND tarefas_autocuidado = 'sim' THEN COUNT(id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND tarefas_autocuidado = 'sim' THEN COUNT(id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND tarefas_autocuidado = 'sim' THEN COUNT(id) END AS nao_info_sim
        FROM pacientes
        GROUP BY cor_raca, tarefas_autocuidado)TB
      GROUP BY pergunta

      UNION ALL

      SELECT
        CONCAT('Não \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_nao),0) AS branca
        , COALESCE(SUM(indigena_nao),0) AS indigena
        , COALESCE(SUM(amarela_nao),0) AS amarela
        , COALESCE(SUM(preta_nao)+SUM(parda_nao),0) AS negro
        , COALESCE(SUM(nao_info_nao),0) AS nao_info
      FROM
        (SELECT
          'Consegue realizar tarefas de autocuidado? (como tomar banho, cozinhar, lavar a própria roupa)' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND tarefas_autocuidado = 'não' THEN COUNT(id) END AS preta_nao
          , CASE WHEN cor_raca = 'Parda' AND tarefas_autocuidado = 'não' THEN COUNT(id) END AS parda_nao
          , CASE WHEN cor_raca = 'Indígena' AND tarefas_autocuidado = 'não' THEN COUNT(id) END AS indigena_nao
          , CASE WHEN cor_raca = 'Branca' AND tarefas_autocuidado = 'não' THEN COUNT(id) END AS branca_nao
          , CASE WHEN cor_raca = 'Amarela' AND tarefas_autocuidado = 'não' THEN COUNT(id) END AS amarela_nao
          , CASE WHEN cor_raca IS NULL AND tarefas_autocuidado = 'não' THEN COUNT(id) END AS nao_info_nao
        FROM pacientes
        GROUP BY cor_raca, tarefas_autocuidado)TB
      GROUP BY pergunta;
    ");
    return json_encode($insumos_oferecidos_pelo_projeto_raca_cor_1);
  }

  public function insumos_oferecidos_pelo_projeto_raca_cor_2()
  {
    $insumos_oferecidos_pelo_projeto_raca_cor_2 = DB::select("
    SELECT
        CONCAT('Sim \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Precisa de ajuda para comprar remédios de uso contínuo?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND precisa_tipo_ajuda LIKE '%Comprar remédios de uso contínuo%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND precisa_tipo_ajuda LIKE '%Comprar remédios de uso contínuo%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND precisa_tipo_ajuda LIKE '%Comprar remédios de uso contínuo%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND precisa_tipo_ajuda LIKE '%Comprar remédios de uso contínuo%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND precisa_tipo_ajuda LIKE '%Comprar remédios de uso contínuo%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND precisa_tipo_ajuda LIKE '%Comprar remédios de uso contínuo%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN insumos_oferecidos iof ON pac.id = iof.paciente_id
        GROUP BY cor_raca, precisa_tipo_ajuda)TB
      GROUP BY pergunta


      UNION ALL

      SELECT
        CONCAT('Não \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_nao),0) AS branca
        , COALESCE(SUM(indigena_nao),0) AS indigena
        , COALESCE(SUM(amarela_nao),0) AS amarela
        , COALESCE(SUM(preta_nao)+SUM(parda_nao),0) AS negro
        , COALESCE(SUM(nao_info_nao),0) AS nao_info
      FROM
        (SELECT
          'Precisa de ajuda para comprar remédios de uso contínuo?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND precisa_tipo_ajuda IS NOT NULL AND (precisa_tipo_ajuda = 'N;' OR precisa_tipo_ajuda NOT LIKE '%Comprar remédios de uso contínuo%') THEN COUNT(pac.id) END AS preta_nao
          , CASE WHEN cor_raca = 'Parda' AND precisa_tipo_ajuda IS NOT NULL AND (precisa_tipo_ajuda = 'N;' OR precisa_tipo_ajuda NOT LIKE '%Comprar remédios de uso contínuo%') THEN COUNT(pac.id) END AS parda_nao
          , CASE WHEN cor_raca = 'Indígena' AND precisa_tipo_ajuda IS NOT NULL AND (precisa_tipo_ajuda = 'N;' OR precisa_tipo_ajuda NOT LIKE '%Comprar remédios de uso contínuo%') THEN COUNT(pac.id) END AS indigena_nao
          , CASE WHEN cor_raca = 'Branca' AND precisa_tipo_ajuda IS NOT NULL AND (precisa_tipo_ajuda = 'N;' OR precisa_tipo_ajuda NOT LIKE '%Comprar remédios de uso contínuo%') THEN COUNT(pac.id) END AS branca_nao
          , CASE WHEN cor_raca = 'Amarela' AND precisa_tipo_ajuda IS NOT NULL AND (precisa_tipo_ajuda = 'N;' OR precisa_tipo_ajuda NOT LIKE '%Comprar remédios de uso contínuo%') THEN COUNT(pac.id) END AS amarela_nao
          , CASE WHEN cor_raca IS NULL AND precisa_tipo_ajuda IS NOT NULL AND (precisa_tipo_ajuda = 'N;' OR precisa_tipo_ajuda NOT LIKE '%Comprar remédios de uso contínuo%') THEN COUNT(pac.id) END AS nao_info_nao
        FROM pacientes pac
        LEFT JOIN insumos_oferecidos iof ON pac.id = iof.paciente_id
        GROUP BY cor_raca, precisa_tipo_ajuda)TB
      GROUP BY pergunta

      UNION ALL

    /*PERGUNTA 2*/


    SELECT
        CONCAT('Sim \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Precisa de ajuda para comprar remédios para o tratamento do quadro atual?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND precisa_tipo_ajuda LIKE '%Comprar remédios para o tratamento do quadro atual%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND precisa_tipo_ajuda LIKE '%Comprar remédios para o tratamento do quadro atual%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND precisa_tipo_ajuda LIKE '%Comprar remédios para o tratamento do quadro atual%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND precisa_tipo_ajuda LIKE '%Comprar remédios para o tratamento do quadro atual%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND precisa_tipo_ajuda LIKE '%Comprar remédios para o tratamento do quadro atual%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND precisa_tipo_ajuda LIKE '%Comprar remédios para o tratamento do quadro atual%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN insumos_oferecidos iof ON pac.id = iof.paciente_id
        GROUP BY cor_raca, precisa_tipo_ajuda)TB
      GROUP BY pergunta


      UNION ALL

      SELECT
        CONCAT('Não \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_nao),0) AS branca
        , COALESCE(SUM(indigena_nao),0) AS indigena
        , COALESCE(SUM(amarela_nao),0) AS amarela
        , COALESCE(SUM(preta_nao)+SUM(parda_nao),0) AS negro
        , COALESCE(SUM(nao_info_nao),0) AS nao_info
      FROM
        (SELECT
          'Precisa de ajuda para comprar remédios para o tratamento do quadro atual?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND precisa_tipo_ajuda IS NOT NULL AND (precisa_tipo_ajuda = 'N;' OR precisa_tipo_ajuda NOT LIKE '%Comprar remédios para o tratamento do quadro atual%') THEN COUNT(pac.id) END AS preta_nao
          , CASE WHEN cor_raca = 'Parda' AND precisa_tipo_ajuda IS NOT NULL AND (precisa_tipo_ajuda = 'N;' OR precisa_tipo_ajuda NOT LIKE '%Comprar remédios para o tratamento do quadro atual%') THEN COUNT(pac.id) END AS parda_nao
          , CASE WHEN cor_raca = 'Indígena' AND precisa_tipo_ajuda IS NOT NULL AND (precisa_tipo_ajuda = 'N;' OR precisa_tipo_ajuda NOT LIKE '%Comprar remédios para o tratamento do quadro atual%') THEN COUNT(pac.id) END AS indigena_nao
          , CASE WHEN cor_raca = 'Branca' AND precisa_tipo_ajuda IS NOT NULL AND (precisa_tipo_ajuda = 'N;' OR precisa_tipo_ajuda NOT LIKE '%Comprar remédios para o tratamento do quadro atual%') THEN COUNT(pac.id) END AS branca_nao
          , CASE WHEN cor_raca = 'Amarela' AND precisa_tipo_ajuda IS NOT NULL AND (precisa_tipo_ajuda = 'N;' OR precisa_tipo_ajuda NOT LIKE '%Comprar remédios para o tratamento do quadro atual%') THEN COUNT(pac.id) END AS amarela_nao
          , CASE WHEN cor_raca IS NULL AND precisa_tipo_ajuda IS NOT NULL AND (precisa_tipo_ajuda = 'N;' OR precisa_tipo_ajuda NOT LIKE '%Comprar remédios para o tratamento do quadro atual%') THEN COUNT(pac.id) END AS nao_info_nao
        FROM pacientes pac
        LEFT JOIN insumos_oferecidos iof ON pac.id = iof.paciente_id
        GROUP BY cor_raca, precisa_tipo_ajuda)TB
      GROUP BY pergunta


      UNION ALL



    SELECT
        CONCAT('Sim \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Precisa de ajuda para comprar alimento ou outro produtos de necessidade básica?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND precisa_tipo_ajuda LIKE '%Comprar alimento ou outro produtos de necessidade básica%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND precisa_tipo_ajuda LIKE '%Comprar alimento ou outro produtos de necessidade básica%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND precisa_tipo_ajuda LIKE '%Comprar alimento ou outro produtos de necessidade básica%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND precisa_tipo_ajuda LIKE '%Comprar alimento ou outro produtos de necessidade básica%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND precisa_tipo_ajuda LIKE '%Comprar alimento ou outro produtos de necessidade básica%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND precisa_tipo_ajuda LIKE '%Comprar alimento ou outro produtos de necessidade básica%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN insumos_oferecidos iof ON pac.id = iof.paciente_id
        GROUP BY cor_raca, precisa_tipo_ajuda)TB
      GROUP BY pergunta


      UNION ALL

      SELECT
        CONCAT('Não \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_nao),0) AS branca
        , COALESCE(SUM(indigena_nao),0) AS indigena
        , COALESCE(SUM(amarela_nao),0) AS amarela
        , COALESCE(SUM(preta_nao)+SUM(parda_nao),0) AS negro
        , COALESCE(SUM(nao_info_nao),0) AS nao_info
      FROM
        (SELECT
          'Precisa de ajuda para comprar alimento ou outro produtos de necessidade básica?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND precisa_tipo_ajuda IS NOT NULL AND (precisa_tipo_ajuda = 'N;' OR precisa_tipo_ajuda NOT LIKE '%Comprar alimento ou outro produtos de necessidade básica%') THEN COUNT(pac.id) END AS preta_nao
          , CASE WHEN cor_raca = 'Parda' AND precisa_tipo_ajuda IS NOT NULL AND (precisa_tipo_ajuda = 'N;' OR precisa_tipo_ajuda NOT LIKE '%Comprar alimento ou outro produtos de necessidade básica%') THEN COUNT(pac.id) END AS parda_nao
          , CASE WHEN cor_raca = 'Indígena' AND precisa_tipo_ajuda IS NOT NULL AND (precisa_tipo_ajuda = 'N;' OR precisa_tipo_ajuda NOT LIKE '%Comprar alimento ou outro produtos de necessidade básica%') THEN COUNT(pac.id) END AS indigena_nao
          , CASE WHEN cor_raca = 'Branca' AND precisa_tipo_ajuda IS NOT NULL AND (precisa_tipo_ajuda = 'N;' OR precisa_tipo_ajuda NOT LIKE '%Comprar alimento ou outro produtos de necessidade básica%') THEN COUNT(pac.id) END AS branca_nao
          , CASE WHEN cor_raca = 'Amarela' AND precisa_tipo_ajuda IS NOT NULL AND (precisa_tipo_ajuda = 'N;' OR precisa_tipo_ajuda NOT LIKE '%Comprar alimento ou outro produtos de necessidade básica%') THEN COUNT(pac.id) END AS amarela_nao
          , CASE WHEN cor_raca IS NULL AND precisa_tipo_ajuda IS NOT NULL AND (precisa_tipo_ajuda = 'N;' OR precisa_tipo_ajuda NOT LIKE '%Comprar alimento ou outro produtos de necessidade básica%') THEN COUNT(pac.id) END AS nao_info_nao
        FROM pacientes pac
        LEFT JOIN insumos_oferecidos iof ON pac.id = iof.paciente_id
        GROUP BY cor_raca, precisa_tipo_ajuda)TB
      GROUP BY pergunta


    UNION ALL



    SELECT
        CONCAT('Sim \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Precisa de ajuda para outros?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND precisa_tipo_ajuda LIKE '%Outros%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND precisa_tipo_ajuda LIKE '%Outros%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND precisa_tipo_ajuda LIKE '%Outros%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND precisa_tipo_ajuda LIKE '%Outros%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND precisa_tipo_ajuda LIKE '%Outros%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND precisa_tipo_ajuda LIKE '%Outros%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN insumos_oferecidos iof ON pac.id = iof.paciente_id
        GROUP BY cor_raca, precisa_tipo_ajuda)TB
      GROUP BY pergunta


      UNION ALL

      SELECT
        CONCAT('Não \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_nao),0) AS branca
        , COALESCE(SUM(indigena_nao),0) AS indigena
        , COALESCE(SUM(amarela_nao),0) AS amarela
        , COALESCE(SUM(preta_nao)+SUM(parda_nao),0) AS negro
        , COALESCE(SUM(nao_info_nao),0) AS nao_info
      FROM
        (SELECT
          'Precisa de ajuda para outros?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND precisa_tipo_ajuda IS NOT NULL AND (precisa_tipo_ajuda = 'N;' OR precisa_tipo_ajuda NOT LIKE '%Outros%') THEN COUNT(pac.id) END AS preta_nao
          , CASE WHEN cor_raca = 'Parda' AND precisa_tipo_ajuda IS NOT NULL AND (precisa_tipo_ajuda = 'N;' OR precisa_tipo_ajuda NOT LIKE '%Outros%') THEN COUNT(pac.id) END AS parda_nao
          , CASE WHEN cor_raca = 'Indígena' AND precisa_tipo_ajuda IS NOT NULL AND (precisa_tipo_ajuda = 'N;' OR precisa_tipo_ajuda NOT LIKE '%Outros%') THEN COUNT(pac.id) END AS indigena_nao
          , CASE WHEN cor_raca = 'Branca' AND precisa_tipo_ajuda IS NOT NULL AND (precisa_tipo_ajuda = 'N;' OR precisa_tipo_ajuda NOT LIKE '%Outros%') THEN COUNT(pac.id) END AS branca_nao
          , CASE WHEN cor_raca = 'Amarela' AND precisa_tipo_ajuda IS NOT NULL AND (precisa_tipo_ajuda = 'N;' OR precisa_tipo_ajuda NOT LIKE '%Outros%') THEN COUNT(pac.id) END AS amarela_nao
          , CASE WHEN cor_raca IS NULL AND precisa_tipo_ajuda IS NOT NULL AND (precisa_tipo_ajuda = 'N;' OR precisa_tipo_ajuda NOT LIKE '%Outros%') THEN COUNT(pac.id) END AS nao_info_nao
        FROM pacientes pac
        LEFT JOIN insumos_oferecidos iof ON pac.id = iof.paciente_id
        GROUP BY cor_raca, precisa_tipo_ajuda)TB
      GROUP BY pergunta
    ");
    return json_encode($insumos_oferecidos_pelo_projeto_raca_cor_2);
  }

  public function insumos_oferecidos_pelo_projeto_raca_cor_3()
  {
    $insumos_oferecidos_pelo_projeto_raca_cor_3 = DB::select("
    SELECT
        CONCAT('Sim \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Foi entregue: Termometro?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND material_entregue LIKE '%Termometro%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND material_entregue LIKE '%Termometro%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND material_entregue LIKE '%Termometro%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND material_entregue LIKE '%Termometro%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND material_entregue LIKE '%Termometro%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND material_entregue LIKE '%Termometro%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN insumos_oferecidos iof ON pac.id = iof.paciente_id
        GROUP BY cor_raca, material_entregue)TB
      GROUP BY pergunta


      UNION ALL

      SELECT
        CONCAT('Não \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_nao),0) AS branca
        , COALESCE(SUM(indigena_nao),0) AS indigena
        , COALESCE(SUM(amarela_nao),0) AS amarela
        , COALESCE(SUM(preta_nao)+SUM(parda_nao),0) AS negro
        , COALESCE(SUM(nao_info_nao),0) AS nao_info
      FROM
        (SELECT
          'Foi entregue: Termometro' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Termometro%') THEN COUNT(pac.id) END AS preta_nao
          , CASE WHEN cor_raca = 'Parda' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Termometro%') THEN COUNT(pac.id) END AS parda_nao
          , CASE WHEN cor_raca = 'Indígena' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Termometro%') THEN COUNT(pac.id) END AS indigena_nao
          , CASE WHEN cor_raca = 'Branca' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Termometro%') THEN COUNT(pac.id) END AS branca_nao
          , CASE WHEN cor_raca = 'Amarela' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Termometro%') THEN COUNT(pac.id) END AS amarela_nao
          , CASE WHEN cor_raca IS NULL AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Termometro%') THEN COUNT(pac.id) END AS nao_info_nao
        FROM pacientes pac
        LEFT JOIN insumos_oferecidos iof ON pac.id = iof.paciente_id
        GROUP BY cor_raca, material_entregue)TB
      GROUP BY pergunta


      UNION ALL

      /*Dipirona*/


    SELECT
        CONCAT('Sim \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Foi entregue: Dipirona?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND material_entregue LIKE '%Dipirona%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND material_entregue LIKE '%Dipirona%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND material_entregue LIKE '%Dipirona%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND material_entregue LIKE '%Dipirona%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND material_entregue LIKE '%Dipirona%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND material_entregue LIKE '%Dipirona%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN insumos_oferecidos iof ON pac.id = iof.paciente_id
        GROUP BY cor_raca, material_entregue)TB
      GROUP BY pergunta


      UNION ALL

      SELECT
        CONCAT('Não \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_nao),0) AS branca
        , COALESCE(SUM(indigena_nao),0) AS indigena
        , COALESCE(SUM(amarela_nao),0) AS amarela
        , COALESCE(SUM(preta_nao)+SUM(parda_nao),0) AS negro
        , COALESCE(SUM(nao_info_nao),0) AS nao_info
      FROM
        (SELECT
          'Foi entregue: Dipirona?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Dipirona%') THEN COUNT(pac.id) END AS preta_nao
          , CASE WHEN cor_raca = 'Parda' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Dipirona%') THEN COUNT(pac.id) END AS parda_nao
          , CASE WHEN cor_raca = 'Indígena' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Dipirona%') THEN COUNT(pac.id) END AS indigena_nao
          , CASE WHEN cor_raca = 'Branca' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Dipirona%') THEN COUNT(pac.id) END AS branca_nao
          , CASE WHEN cor_raca = 'Amarela' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Dipirona%') THEN COUNT(pac.id) END AS amarela_nao
          , CASE WHEN cor_raca IS NULL AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Dipirona%') THEN COUNT(pac.id) END AS nao_info_nao
        FROM pacientes pac
        LEFT JOIN insumos_oferecidos iof ON pac.id = iof.paciente_id
        GROUP BY cor_raca, material_entregue)TB
      GROUP BY pergunta


      UNION ALL

      /*Paracetamol*/


    SELECT
        CONCAT('Sim \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Foi entregue: Paracetamol?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND material_entregue LIKE '%Paracetamol%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND material_entregue LIKE '%Paracetamol%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND material_entregue LIKE '%Paracetamol%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND material_entregue LIKE '%Paracetamol%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND material_entregue LIKE '%Paracetamol%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND material_entregue LIKE '%Paracetamol%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN insumos_oferecidos iof ON pac.id = iof.paciente_id
        GROUP BY cor_raca, material_entregue)TB
      GROUP BY pergunta


      UNION ALL

      SELECT
        CONCAT('Não \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_nao),0) AS branca
        , COALESCE(SUM(indigena_nao),0) AS indigena
        , COALESCE(SUM(amarela_nao),0) AS amarela
        , COALESCE(SUM(preta_nao)+SUM(parda_nao),0) AS negro
        , COALESCE(SUM(nao_info_nao),0) AS nao_info
      FROM
        (SELECT
          'Foi entregue: Paracetamol?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Paracetamol%') THEN COUNT(pac.id) END AS preta_nao
          , CASE WHEN cor_raca = 'Parda' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Paracetamol%') THEN COUNT(pac.id) END AS parda_nao
          , CASE WHEN cor_raca = 'Indígena' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Paracetamol%') THEN COUNT(pac.id) END AS indigena_nao
          , CASE WHEN cor_raca = 'Branca' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Paracetamol%') THEN COUNT(pac.id) END AS branca_nao
          , CASE WHEN cor_raca = 'Amarela' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Paracetamol%') THEN COUNT(pac.id) END AS amarela_nao
          , CASE WHEN cor_raca IS NULL AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Paracetamol%') THEN COUNT(pac.id) END AS nao_info_nao
        FROM pacientes pac
        LEFT JOIN insumos_oferecidos iof ON pac.id = iof.paciente_id
        GROUP BY cor_raca, material_entregue)TB
      GROUP BY pergunta


      UNION ALL

      /*Oximetro*/


    SELECT
        CONCAT('Sim \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Foi entregue: Oximetro?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND material_entregue LIKE '%Oximetro%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND material_entregue LIKE '%Oximetro%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND material_entregue LIKE '%Oximetro%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND material_entregue LIKE '%Oximetro%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND material_entregue LIKE '%Oximetro%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND material_entregue LIKE '%Oximetro%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN insumos_oferecidos iof ON pac.id = iof.paciente_id
        GROUP BY cor_raca, material_entregue)TB
      GROUP BY pergunta


      UNION ALL

      SELECT
        CONCAT('Não \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_nao),0) AS branca
        , COALESCE(SUM(indigena_nao),0) AS indigena
        , COALESCE(SUM(amarela_nao),0) AS amarela
        , COALESCE(SUM(preta_nao)+SUM(parda_nao),0) AS negro
        , COALESCE(SUM(nao_info_nao),0) AS nao_info
      FROM
        (SELECT
          'Foi entregue: Oximetro?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Oximetro%') THEN COUNT(pac.id) END AS preta_nao
          , CASE WHEN cor_raca = 'Parda' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Oximetro%') THEN COUNT(pac.id) END AS parda_nao
          , CASE WHEN cor_raca = 'Indígena' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Oximetro%') THEN COUNT(pac.id) END AS indigena_nao
          , CASE WHEN cor_raca = 'Branca' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Oximetro%') THEN COUNT(pac.id) END AS branca_nao
          , CASE WHEN cor_raca = 'Amarela' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Oximetro%') THEN COUNT(pac.id) END AS amarela_nao
          , CASE WHEN cor_raca IS NULL AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Oximetro%') THEN COUNT(pac.id) END AS nao_info_nao
        FROM pacientes pac
        LEFT JOIN insumos_oferecidos iof ON pac.id = iof.paciente_id
        GROUP BY cor_raca, material_entregue)TB
      GROUP BY pergunta


      UNION ALL

      /*Mascaras de tecido*/


    SELECT
        CONCAT('Sim \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Foi entregue: Mascaras de tecido?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND material_entregue LIKE '%Mascaras de tecido%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND material_entregue LIKE '%Mascaras de tecido%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND material_entregue LIKE '%Mascaras de tecido%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND material_entregue LIKE '%Mascaras de tecido%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND material_entregue LIKE '%Mascaras de tecido%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND material_entregue LIKE '%Mascaras de tecido%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN insumos_oferecidos iof ON pac.id = iof.paciente_id
        GROUP BY cor_raca, material_entregue)TB
      GROUP BY pergunta


      UNION ALL

      SELECT
        CONCAT('Não \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_nao),0) AS branca
        , COALESCE(SUM(indigena_nao),0) AS indigena
        , COALESCE(SUM(amarela_nao),0) AS amarela
        , COALESCE(SUM(preta_nao)+SUM(parda_nao),0) AS negro
        , COALESCE(SUM(nao_info_nao),0) AS nao_info
      FROM
        (SELECT
          'Foi entregue: Mascaras de tecido?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Mascaras de tecido%') THEN COUNT(pac.id) END AS preta_nao
          , CASE WHEN cor_raca = 'Parda' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Mascaras de tecido%') THEN COUNT(pac.id) END AS parda_nao
          , CASE WHEN cor_raca = 'Indígena' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Mascaras de tecido%') THEN COUNT(pac.id) END AS indigena_nao
          , CASE WHEN cor_raca = 'Branca' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Mascaras de tecido%') THEN COUNT(pac.id) END AS branca_nao
          , CASE WHEN cor_raca = 'Amarela' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Mascaras de tecido%') THEN COUNT(pac.id) END AS amarela_nao
          , CASE WHEN cor_raca IS NULL AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Mascaras de tecido%') THEN COUNT(pac.id) END AS nao_info_nao
        FROM pacientes pac
        LEFT JOIN insumos_oferecidos iof ON pac.id = iof.paciente_id
        GROUP BY cor_raca, material_entregue)TB
      GROUP BY pergunta


      UNION ALL

      /*Material de limpeza*/


    SELECT
        CONCAT('Sim \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Foi entregue: Material de limpeza?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND material_entregue LIKE '%Material de limpeza%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND material_entregue LIKE '%Material de limpeza%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND material_entregue LIKE '%Material de limpeza%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND material_entregue LIKE '%Material de limpeza%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND material_entregue LIKE '%Material de limpeza%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND material_entregue LIKE '%Material de limpeza%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN insumos_oferecidos iof ON pac.id = iof.paciente_id
        GROUP BY cor_raca, material_entregue)TB
      GROUP BY pergunta


      UNION ALL

      SELECT
        CONCAT('Não \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_nao),0) AS branca
        , COALESCE(SUM(indigena_nao),0) AS indigena
        , COALESCE(SUM(amarela_nao),0) AS amarela
        , COALESCE(SUM(preta_nao)+SUM(parda_nao),0) AS negro
        , COALESCE(SUM(nao_info_nao),0) AS nao_info
      FROM
        (SELECT
          'Foi entregue: Material de limpeza?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Material de limpeza%') THEN COUNT(pac.id) END AS preta_nao
          , CASE WHEN cor_raca = 'Parda' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Material de limpeza%') THEN COUNT(pac.id) END AS parda_nao
          , CASE WHEN cor_raca = 'Indígena' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Material de limpeza%') THEN COUNT(pac.id) END AS indigena_nao
          , CASE WHEN cor_raca = 'Branca' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Material de limpeza%') THEN COUNT(pac.id) END AS branca_nao
          , CASE WHEN cor_raca = 'Amarela' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Material de limpeza%') THEN COUNT(pac.id) END AS amarela_nao
          , CASE WHEN cor_raca IS NULL AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Material de limpeza%') THEN COUNT(pac.id) END AS nao_info_nao
        FROM pacientes pac
        LEFT JOIN insumos_oferecidos iof ON pac.id = iof.paciente_id
        GROUP BY cor_raca, material_entregue)TB
      GROUP BY pergunta


      UNION ALL

      /*Cesta basica*/


    SELECT
        CONCAT('Sim \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Foi entregue: Cesta basica?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND material_entregue LIKE '%Cesta basica%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND material_entregue LIKE '%Cesta basica%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND material_entregue LIKE '%Cesta basica%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND material_entregue LIKE '%Cesta basica%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND material_entregue LIKE '%Cesta basica%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND material_entregue LIKE '%Cesta basica%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN insumos_oferecidos iof ON pac.id = iof.paciente_id
        GROUP BY cor_raca, material_entregue)TB
      GROUP BY pergunta


      UNION ALL

      SELECT
        CONCAT('Não \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_nao),0) AS branca
        , COALESCE(SUM(indigena_nao),0) AS indigena
        , COALESCE(SUM(amarela_nao),0) AS amarela
        , COALESCE(SUM(preta_nao)+SUM(parda_nao),0) AS negro
        , COALESCE(SUM(nao_info_nao),0) AS nao_info
      FROM
        (SELECT
          'Foi entregue: Cesta basica?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Cesta basica%') THEN COUNT(pac.id) END AS preta_nao
          , CASE WHEN cor_raca = 'Parda' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Cesta basica%') THEN COUNT(pac.id) END AS parda_nao
          , CASE WHEN cor_raca = 'Indígena' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Cesta basica%') THEN COUNT(pac.id) END AS indigena_nao
          , CASE WHEN cor_raca = 'Branca' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Cesta basica%') THEN COUNT(pac.id) END AS branca_nao
          , CASE WHEN cor_raca = 'Amarela' AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Cesta basica%') THEN COUNT(pac.id) END AS amarela_nao
          , CASE WHEN cor_raca IS NULL AND material_entregue IS NOT NULL AND (material_entregue NOT LIKE '%Cesta basica%') THEN COUNT(pac.id) END AS nao_info_nao
        FROM pacientes pac
        LEFT JOIN insumos_oferecidos iof ON pac.id = iof.paciente_id
        GROUP BY cor_raca, material_entregue)TB
      GROUP BY pergunta;
    ");
    return json_encode($insumos_oferecidos_pelo_projeto_raca_cor_3);
  }

  public function tratamento_prescrito_por_medico_projeto()
  {
    $tratamento_prescrito_por_medico_projeto = DB::select("
    SELECT
      cor_raca
        , COALESCE(SUM(sem_informacao),0) AS sem_informacao
        , COALESCE(SUM(sim),0) AS sim
        , COALESCE(SUM(nao),0) AS nao
        , COALESCE(SUM(sim_preta),0) AS sim_preta
        , COALESCE(SUM(nao_preta),0) AS nao_preta
        , COALESCE(SUM(sim_parda),0) AS sim_parda
        , COALESCE(SUM(nao_parda),0) AS nao_parda
    FROM   (
      SELECT
        CASE
          WHEN cor_raca IS NULL THEN 'Sem info.'
                WHEN cor_raca IN ('Preta','Parda') THEN 'Negra'
        ELSE cor_raca END AS cor_raca
      , CASE
          WHEN tratamento_prescrito IS NULL THEN COUNT(pac.id)
        END AS sem_informacao
      , CASE
          WHEN tratamento_prescrito = 'sim' AND cor_raca NOT IN ('Preta','Parda') THEN COUNT(pac.id)
        END AS sim
      , CASE
          WHEN tratamento_prescrito = 'não' AND cor_raca NOT IN ('Preta','Parda') THEN COUNT(pac.id)
            END AS nao
      , CASE
          WHEN tratamento_prescrito = 'sim' AND cor_raca = 'Preta' THEN COUNT(pac.id)
            END AS sim_preta
      , CASE
          WHEN tratamento_prescrito = 'não' AND cor_raca = 'Preta' THEN COUNT(pac.id)
            END AS nao_preta
      , CASE
          WHEN tratamento_prescrito = 'sim' AND cor_raca = 'Parda' THEN COUNT(pac.id)
        END AS sim_parda
      , CASE
          WHEN tratamento_prescrito = 'não' AND cor_raca = 'Parda' THEN COUNT(pac.id)
        END AS nao_parda
      FROM pacientes pac
      LEFT JOIN insumos_oferecidos iof ON iof.paciente_id = pac.id
        GROUP BY tratamento_prescrito, cor_raca)TBB
    GROUP BY cor_raca
    ORDER BY cor_raca;
    ");
    return array($tratamento_prescrito_por_medico_projeto);
  }

  public function tratamento_financiado()
  {
    /*$tratamento_financiado = DB::select("
    SELECT
      cor_raca
        , COALESCE(SUM(sem_informacao),0) AS sem_informacao
        , COALESCE(SUM(sim),0) AS sim
        , COALESCE(SUM(nao),0) AS nao
        , COALESCE(SUM(sim_preta),0) AS sim_preta
        , COALESCE(SUM(nao_preta),0) AS nao_preta
        , COALESCE(SUM(sim_parda),0) AS sim_parda
        , COALESCE(SUM(nao_parda),0) AS nao_parda
    FROM   (
      SELECT
        CASE
          WHEN cor_raca IS NULL THEN 'Sem info.'
                WHEN cor_raca IN ('Preta','Parda') THEN 'Negra'
        ELSE cor_raca END AS cor_raca
      , CASE
          WHEN tratamento_financiado IS NULL THEN COUNT(pac.id)
        END AS sem_informacao
      , CASE
          WHEN tratamento_financiado = 'sim' AND cor_raca NOT IN ('Preta','Parda') THEN COUNT(pac.id)
        END AS sim
      , CASE
          WHEN tratamento_financiado = 'não' AND cor_raca NOT IN ('Preta','Parda') THEN COUNT(pac.id)
            END AS nao
      , CASE
          WHEN tratamento_financiado = 'sim' AND cor_raca = 'Preta' THEN COUNT(pac.id)
            END AS sim_preta
      , CASE
          WHEN tratamento_financiado = 'não' AND cor_raca = 'Preta' THEN COUNT(pac.id)
            END AS nao_preta
      , CASE
          WHEN tratamento_financiado = 'sim' AND cor_raca = 'Parda' THEN COUNT(pac.id)
        END AS sim_parda
      , CASE
          WHEN tratamento_financiado = 'não' AND cor_raca = 'Parda' THEN COUNT(pac.id)
        END AS nao_parda
      FROM pacientes pac
      LEFT JOIN insumos_oferecidos iof ON iof.paciente_id = pac.id
        GROUP BY tratamento_financiado, cor_raca)TBB
    GROUP BY cor_raca
    ORDER BY cor_raca
    ");*/
    $tratamento_financiado = DB::select("
    SELECT
        CONCAT('Sim \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Precisa de ajuda para PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND tratamento_financiado LIKE '%PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND tratamento_financiado LIKE '%PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND tratamento_financiado LIKE '%PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND tratamento_financiado LIKE '%PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND tratamento_financiado LIKE '%PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND tratamento_financiado LIKE '%PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN insumos_oferecidos iof ON pac.id = iof.paciente_id
        GROUP BY cor_raca, tratamento_financiado)TB
      GROUP BY pergunta


      UNION ALL

      SELECT
        CONCAT('Não \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_nao),0) AS branca
        , COALESCE(SUM(indigena_nao),0) AS indigena
        , COALESCE(SUM(amarela_nao),0) AS amarela
        , COALESCE(SUM(preta_nao)+SUM(parda_nao),0) AS negro
        , COALESCE(SUM(nao_info_nao),0) AS nao_info
      FROM
        (SELECT
          'Precisa de ajuda para PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND tratamento_financiado IS NOT NULL AND (tratamento_financiado = 'N;' OR tratamento_financiado NOT LIKE '%PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)%') THEN COUNT(pac.id) END AS preta_nao
          , CASE WHEN cor_raca = 'Parda' AND tratamento_financiado IS NOT NULL AND (tratamento_financiado = 'N;' OR tratamento_financiado NOT LIKE '%PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)%') THEN COUNT(pac.id) END AS parda_nao
          , CASE WHEN cor_raca = 'Indígena' AND tratamento_financiado IS NOT NULL AND (tratamento_financiado = 'N;' OR tratamento_financiado NOT LIKE '%PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)%') THEN COUNT(pac.id) END AS indigena_nao
          , CASE WHEN cor_raca = 'Branca' AND tratamento_financiado IS NOT NULL AND (tratamento_financiado = 'N;' OR tratamento_financiado NOT LIKE '%PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)%') THEN COUNT(pac.id) END AS branca_nao
          , CASE WHEN cor_raca = 'Amarela' AND tratamento_financiado IS NOT NULL AND (tratamento_financiado = 'N;' OR tratamento_financiado NOT LIKE '%PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)%') THEN COUNT(pac.id) END AS amarela_nao
          , CASE WHEN cor_raca IS NULL AND tratamento_financiado IS NOT NULL AND (tratamento_financiado = 'N;' OR tratamento_financiado NOT LIKE '%PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)%') THEN COUNT(pac.id) END AS nao_info_nao
        FROM pacientes pac
        LEFT JOIN insumos_oferecidos iof ON pac.id = iof.paciente_id
        GROUP BY cor_raca, tratamento_financiado)TB
      GROUP BY pergunta


      UNION ALL


      SELECT
        CONCAT('Sim \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Alopático (medicamentos convencionais)?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND tratamento_financiado LIKE '%Alopático (medicamentos convencionais)%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND tratamento_financiado LIKE '%Alopático (medicamentos convencionais)%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND tratamento_financiado LIKE '%Alopático (medicamentos convencionais)%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND tratamento_financiado LIKE '%Alopático (medicamentos convencionais)%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND tratamento_financiado LIKE '%Alopático (medicamentos convencionais)%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND tratamento_financiado LIKE '%Alopático (medicamentos convencionais)%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN insumos_oferecidos iof ON pac.id = iof.paciente_id
        GROUP BY cor_raca, tratamento_financiado)TB
      GROUP BY pergunta


      UNION ALL

      SELECT
        CONCAT('Não \n\n ',pergunta) AS pergunta
        , COALESCE(SUM(branca_nao),0) AS branca
        , COALESCE(SUM(indigena_nao),0) AS indigena
        , COALESCE(SUM(amarela_nao),0) AS amarela
        , COALESCE(SUM(preta_nao)+SUM(parda_nao),0) AS negro
        , COALESCE(SUM(nao_info_nao),0) AS nao_info
      FROM
        (SELECT
          'Alopático (medicamentos convencionais)?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND tratamento_financiado IS NOT NULL AND (tratamento_financiado = 'N;' OR tratamento_financiado NOT LIKE '%Alopático (medicamentos convencionais)%') THEN COUNT(pac.id) END AS preta_nao
          , CASE WHEN cor_raca = 'Parda' AND tratamento_financiado IS NOT NULL AND (tratamento_financiado = 'N;' OR tratamento_financiado NOT LIKE '%Alopático (medicamentos convencionais)%') THEN COUNT(pac.id) END AS parda_nao
          , CASE WHEN cor_raca = 'Indígena' AND tratamento_financiado IS NOT NULL AND (tratamento_financiado = 'N;' OR tratamento_financiado NOT LIKE '%Alopático (medicamentos convencionais)%') THEN COUNT(pac.id) END AS indigena_nao
          , CASE WHEN cor_raca = 'Branca' AND tratamento_financiado IS NOT NULL AND (tratamento_financiado = 'N;' OR tratamento_financiado NOT LIKE '%Alopático (medicamentos convencionais)%') THEN COUNT(pac.id) END AS branca_nao
          , CASE WHEN cor_raca = 'Amarela' AND tratamento_financiado IS NOT NULL AND (tratamento_financiado = 'N;' OR tratamento_financiado NOT LIKE '%Alopático (medicamentos convencionais)%') THEN COUNT(pac.id) END AS amarela_nao
          , CASE WHEN cor_raca IS NULL AND tratamento_financiado IS NOT NULL AND (tratamento_financiado = 'N;' OR tratamento_financiado NOT LIKE '%Alopático (medicamentos convencionais)%') THEN COUNT(pac.id) END AS nao_info_nao
        FROM pacientes pac
        LEFT JOIN insumos_oferecidos iof ON pac.id = iof.paciente_id
        GROUP BY cor_raca, tratamento_financiado)TB
      GROUP BY pergunta
    ");
    return $tratamento_financiado;
  }

  public function dias_sintoma_por_raca_cor()
  {
    $dias_sintoma_por_raca_cor = DB::select("
    SELECT
    	dias
        , COALESCE(SUM(sem_informacao),0) AS sem_informacao
        , COALESCE(SUM(preta),0) AS preta
        , COALESCE(SUM(parda),0) AS parda
        , COALESCE(SUM(branca),0) AS branca
        , COALESCE(SUM(amarela),0) AS amarela
        , COALESCE(SUM(indigena),0) AS indigena
    FROM
    	(SELECT
    		DATEDIFF(data_inicio_monitoramento, data_inicio_sintoma) AS dias
    		, CASE WHEN cor_raca IS NULL THEN COUNT(id) END AS sem_informacao
    		, CASE WHEN cor_raca = 'Preta' THEN COUNT(id) END AS preta
    		, CASE WHEN cor_raca = 'Parda' THEN COUNT(id) END AS parda
    		, CASE WHEN cor_raca = 'Branca' THEN COUNT(id) END AS branca
    		, CASE WHEN cor_raca = 'Amarela' THEN COUNT(id) END AS amarela
    		, CASE WHEN cor_raca = 'Indígena'THEN COUNT(id) END AS indigena
    	FROM
    		(SELECT
    			id
    			, cor_raca
    			, CAST(CONCAT(SUBSTRING(data_inicio_monitoramento,7,4),'-',SUBSTRING(data_inicio_monitoramento,4,2),'-',SUBSTRING(data_inicio_monitoramento,1,2)) AS DATE) AS data_inicio_monitoramento
    			, CAST(CONCAT(SUBSTRING(data_inicio_sintoma,7,4),'-',SUBSTRING(data_inicio_sintoma,4,2),'-',SUBSTRING(data_inicio_sintoma,1,2)) AS DATE) AS data_inicio_sintoma
    		FROM
    		(SELECT
    			id
    			, cor_raca
    			, CASE
    				WHEN LENGTH(data_inicio_monitoramento) = 8 THEN CONCAT(SUBSTRING(data_inicio_monitoramento,1,6),20,SUBSTRING(data_inicio_monitoramento,7,2))
    				ELSE data_inicio_monitoramento
    			END AS data_inicio_monitoramento
    			, CASE
    				WHEN LENGTH(data_inicio_sintoma) = 8 THEN CONCAT(SUBSTRING(data_inicio_sintoma,1,6),20,SUBSTRING(data_inicio_sintoma,7,2))
    				ELSE data_inicio_sintoma
    			END AS data_inicio_sintoma
    		FROM pacientes
    		WHERE situacao IN (1,2,3,6,7,8,9,10,11,12))TB)TBB
    		GROUP BY 1,cor_raca)TBBB
    WHERE dias >= 0
    GROUP BY dias
    ORDER BY dias;
    ");
    return array($dias_sintoma_por_raca_cor);
  }

  public function dias_sintoma_mais_menos_dez_dias()
  {
    /*$dias_sintoma_mais_menos_dez_dias = DB::select("
    SELECT
      cor_raca
        , COALESCE(SUM(mais_10),0) AS mais_10
        , COALESCE(SUM(menos_10),0) AS menos_10
        , COALESCE(SUM(mais_10_preta),0) AS mais_10_preta
        , COALESCE(SUM(menos_10_preta),0) AS menos_10_preta
        , COALESCE(SUM(mais_10_parda),0) AS mais_10_parda
        , COALESCE(SUM(menos_10_parda),0) AS menos_10_parda
    FROM
      (SELECT
        CASE
          WHEN cor_raca IS NULL THEN 'Sem info.'
            WHEN cor_raca IN ('Preta','Parda') THEN 'Negra'
        ELSE cor_raca END AS cor_raca
        , CASE
          WHEN DATEDIFF(data_inicio_monitoramento, data_inicio_sintoma) > 10 AND cor_raca NOT IN ('Preta','Parda') THEN COUNT(id)
        END AS mais_10
        , CASE
          WHEN DATEDIFF(data_inicio_monitoramento, data_inicio_sintoma) <= 10  AND cor_raca NOT IN ('Preta','Parda') THEN COUNT(id)
          END AS menos_10
        , CASE
          WHEN DATEDIFF(data_inicio_monitoramento, data_inicio_sintoma) > 10 AND cor_raca = 'Preta' THEN COUNT(id)
          END AS mais_10_preta
        , CASE
          WHEN DATEDIFF(data_inicio_monitoramento, data_inicio_sintoma) <= 10 AND cor_raca = 'Preta' THEN COUNT(id)
          END AS menos_10_preta
        , CASE
          WHEN DATEDIFF(data_inicio_monitoramento, data_inicio_sintoma) > 10 AND cor_raca = 'Parda' THEN COUNT(id)
        END AS mais_10_parda
        , CASE
          WHEN DATEDIFF(data_inicio_monitoramento, data_inicio_sintoma) <= 10 AND cor_raca = 'Parda' THEN COUNT(id)
        END AS menos_10_parda
      FROM
        (SELECT
          id
          , cor_raca
          , CAST(CONCAT(SUBSTRING(data_inicio_monitoramento,7,4),'-',SUBSTRING(data_inicio_monitoramento,4,2),'-',SUBSTRING(data_inicio_monitoramento,1,2)) AS DATE) AS data_inicio_monitoramento
          , CAST(CONCAT(SUBSTRING(data_inicio_sintoma,7,4),'-',SUBSTRING(data_inicio_sintoma,4,2),'-',SUBSTRING(data_inicio_sintoma,1,2)) AS DATE) AS data_inicio_sintoma
        FROM
        (SELECT
          id
          , cor_raca
          , CASE
            WHEN LENGTH(data_inicio_monitoramento) = 8 THEN CONCAT(SUBSTRING(data_inicio_monitoramento,1,6),20,SUBSTRING(data_inicio_monitoramento,7,2))
            ELSE data_inicio_monitoramento
          END AS data_inicio_monitoramento
          , CASE
            WHEN LENGTH(data_inicio_sintoma) = 8 THEN CONCAT(SUBSTRING(data_inicio_sintoma,1,6),20,SUBSTRING(data_inicio_sintoma,7,2))
            ELSE data_inicio_sintoma
          END AS data_inicio_sintoma
        FROM pacientes
        WHERE situacao IN (1,2,3,6,7,8,9,10,11,12))TB)TBB
        GROUP BY cor_raca, data_inicio_monitoramento, data_inicio_sintoma)TBBB
    GROUP BY cor_raca;
    ");*/
    $dias_sintoma_mais_menos_dez_dias = DB::select("
    SELECT
      cor_raca
      , COALESCE(SUM(mais_10),0) +COALESCE(SUM(menos_10),0) AS total_raca
        , 'Mais de dez dias' AS mais_10_label
        , COALESCE(SUM(mais_10),0) AS mais_10
        , 'Menos de dez dias' AS menos_10_label
        , COALESCE(SUM(menos_10),0) AS menos_10
    FROM
      (SELECT
        CASE
          WHEN cor_raca IS NULL THEN 'Sem info.'
            WHEN cor_raca IN ('Preta','Parda') THEN 'Negra'
        ELSE cor_raca END AS cor_raca
        , CASE
          WHEN DATEDIFF(data_inicio_monitoramento, data_inicio_sintoma) > 10 THEN COUNT(id)
        END AS mais_10
        , CASE
          WHEN DATEDIFF(data_inicio_monitoramento, data_inicio_sintoma) <= 10 THEN COUNT(id)
          END AS menos_10
      FROM
        (SELECT
          id
          , cor_raca
          , CAST(CONCAT(SUBSTRING(data_inicio_monitoramento,7,4),'-',SUBSTRING(data_inicio_monitoramento,4,2),'-',SUBSTRING(data_inicio_monitoramento,1,2)) AS DATE) AS data_inicio_monitoramento
          , CAST(CONCAT(SUBSTRING(data_inicio_sintoma,7,4),'-',SUBSTRING(data_inicio_sintoma,4,2),'-',SUBSTRING(data_inicio_sintoma,1,2)) AS DATE) AS data_inicio_sintoma
        FROM
        (SELECT
          id
          , cor_raca
          , CASE
            WHEN LENGTH(data_inicio_monitoramento) = 8 THEN CONCAT(SUBSTRING(data_inicio_monitoramento,1,6),20,SUBSTRING(data_inicio_monitoramento,7,2))
            ELSE data_inicio_monitoramento
          END AS data_inicio_monitoramento
          , CASE
            WHEN LENGTH(data_inicio_sintoma) = 8 THEN CONCAT(SUBSTRING(data_inicio_sintoma,1,6),20,SUBSTRING(data_inicio_sintoma,7,2))
            ELSE data_inicio_sintoma
          END AS data_inicio_sintoma
        FROM pacientes
        WHERE situacao IN (1,2,3,6,7,8,9,10,11,12))TB)TBB
        GROUP BY cor_raca, data_inicio_monitoramento, data_inicio_sintoma)TBBB
    GROUP BY cor_raca;
    ");
    return $dias_sintoma_mais_menos_dez_dias;
  }

  public function total_dias_monitoramento_relacao_covid()
  {
    $total_dias_monitoramento_relacao_covid = DB::select("
    SELECT
      dias
        , COALESCE(SUM(sem_informacao),0) AS sem_informacao
        , COALESCE(SUM(preta),0) AS preta
        , COALESCE(SUM(parda),0) AS parda
        , COALESCE(SUM(branca),0) AS branca
        , COALESCE(SUM(amarela),0) AS amarela
        , COALESCE(SUM(indigena),0) AS indigena
    FROM
      (SELECT
        DATEDIFF(data_inicio_monitoramento, data_finalizacao_caso) AS dias
        , CASE WHEN cor_raca IS NULL THEN COUNT(id) END AS sem_informacao
        , CASE WHEN cor_raca = 'Preta' THEN COUNT(id) END AS preta
        , CASE WHEN cor_raca = 'Parda' THEN COUNT(id) END AS parda
        , CASE WHEN cor_raca = 'Branca' THEN COUNT(id) END AS branca
        , CASE WHEN cor_raca = 'Amarela' THEN COUNT(id) END AS amarela
        , CASE WHEN cor_raca = 'Indígena'THEN COUNT(id) END AS indigena
      FROM
        (SELECT
          id
          , cor_raca
          , CAST(CONCAT(SUBSTRING(data_inicio_monitoramento,7,4),'-',SUBSTRING(data_inicio_monitoramento,4,2),'-',SUBSTRING(data_inicio_monitoramento,1,2)) AS DATE) AS data_inicio_monitoramento
          , CAST(CONCAT(SUBSTRING(data_finalizacao_caso,7,4),'-',SUBSTRING(data_finalizacao_caso,4,2),'-',SUBSTRING(data_finalizacao_caso,1,2)) AS DATE) AS data_finalizacao_caso
        FROM
        (SELECT
          id
          , cor_raca
          , CASE
            WHEN LENGTH(data_inicio_monitoramento) = 8 THEN CONCAT(SUBSTRING(data_inicio_monitoramento,1,6),20,SUBSTRING(data_inicio_monitoramento,7,2))
            ELSE data_inicio_monitoramento
          END AS data_inicio_monitoramento
          , CASE
            WHEN LENGTH(data_finalizacao_caso) = 8 THEN CONCAT(SUBSTRING(data_finalizacao_caso,1,6),20,SUBSTRING(data_finalizacao_caso,7,2))
            ELSE data_finalizacao_caso
          END AS data_finalizacao_caso
        FROM pacientes
        WHERE situacao IN (1,2,3,6,7,8,9,10,11,12))TB)TBB
        GROUP BY 1,cor_raca)TBBB
    WHERE dias >= 0
    GROUP BY dias
    ORDER BY dias;
    ");
    return array($total_dias_monitoramento_relacao_covid);
  }

  public function casos_monitorados_por_agente()
  {
    /*$casos_monitorados_por_agente = DB::select("
    SELECT
    	us.name AS nome_agente
        , COUNT(pac.id) AS quantidade_pacientes
    FROM
    	pacientes pac
        LEFT JOIN agentes ag ON pac.agente_id = ag.id
        LEFT JOIN users us ON ag.user_id = us.id
    GROUP BY us.name;
    ");*/
    $casos_monitorados_por_agente = DB::select("
    SELECT
    	us.name AS nome_agente
        , COUNT(pac.id) AS quantidade_pacientes
    FROM
    	pacientes pac
        LEFT JOIN agentes ag ON pac.agente_id = ag.id
        LEFT JOIN users us ON ag.user_id = us.id
    WHERE us.name IS NOT NULL
    GROUP BY us.name;
    ");
    return $casos_monitorados_por_agente;
  }

  public function casos_avaliados_equipe_medica()
  {
    /*$casos_avaliados_equipe_medica = DB::select("
    SELECT
    	us.name AS medicos
        , COUNT(pac.id) AS quantidade_pacientes
    FROM
    	pacientes pac
        LEFT JOIN medicos md ON pac.medico_id = md.id
        LEFT JOIN users us ON md.user_id = us.id
    GROUP BY us.name;
    ");*/
    $casos_avaliados_equipe_medica = DB::select("
    SELECT
    	COALESCE(us.name, 'Sem acompanhamento médico direto') AS medicos
        , COUNT(pac.id) AS quantidade_pacientes
    FROM
    	pacientes pac
        LEFT JOIN medicos md ON pac.medico_id = md.id
        LEFT JOIN users us ON md.user_id = us.id
    GROUP BY us.name;
    ");
    return $casos_avaliados_equipe_medica;
  }

  public function acompanhamento_psicologico()
  {
    /*$acompanhamento_psicologico = DB::select("
    SELECT
    	us.name AS psicologo
        , COUNT(pac.id) AS quantidade_pacientes
    FROM
    	pacientes pac
        LEFT JOIN psicologos ps ON pac.psicologo_id = ps.id
        LEFT JOIN users us ON ps.user_id = us.id
    GROUP BY us.name;
    ");*/
    $acompanhamento_psicologico = DB::select("
    SELECT
    	COALESCE(us.name, 'Sem acompanhamento psicológico') AS psicologo
        , COUNT(pac.id) AS quantidade_pacientes
    FROM
    	pacientes pac
        LEFT JOIN psicologos ps ON pac.psicologo_id = ps.id
        LEFT JOIN users us ON ps.user_id = us.id
    GROUP BY us.name;
    ");
    return $acompanhamento_psicologico;
  }

  public function acompanhamento_psicologico_individual_emgrupo()
  {
    $acompanhamento_psicologico_individual_emgrupo = DB::select("
    SELECT
      CASE
        WHEN acompanhamento_psicologico LIKE 'a:1%' AND acompanhamento_psicologico LIKE '%s:10%' THEN 'Acompanhamento individual'
        WHEN acompanhamento_psicologico LIKE 'a:1%' AND acompanhamento_psicologico LIKE '%s:8%' THEN 'Acompanhamento em grupo'
        WHEN acompanhamento_psicologico LIKE 'a:2%' THEN 'Acompanhamento individual e em grupo'
            ELSE 'Não informado'
      END AS acompanhamento
        , COUNT(id) AS pacientes
    FROM pacientes
    GROUP BY acompanhamento_psicologico
    ");
    return $acompanhamento_psicologico_individual_emgrupo;
  }

  public function avaliacao_medica_por_raca_cor()
  {
    $avaliacao_medica_por_raca_cor = DB::select("
    SELECT
      cor_raca
        , COALESCE(SUM(com_acompanhamento),0) AS com_acompanhamento
        , COALESCE(SUM(sem_acompanhamento),0) AS sem_acompanhamento
        , COALESCE(SUM(com_acompanhamento_preta),0) AS com_acompanhamento_preta
        , COALESCE(SUM(sem_acompanhamento_preta),0) AS sem_acompanhamento_preta
        , COALESCE(SUM(com_acompanhamento_parda),0) AS com_acompanhamento_parda
        , COALESCE(SUM(sem_acompanhamento_parda),0) AS sem_acompanhamento_parda
    FROM   (
      SELECT
        CASE
          WHEN cor_raca IS NULL THEN 'Sem info.'
                WHEN cor_raca IN ('Preta','Parda') THEN 'Negra'
        ELSE cor_raca END AS cor_raca
      , CASE
          WHEN medico_id IS NOT NULL AND cor_raca NOT IN ('Preta','Parda') THEN COUNT(pac.id)
        END AS com_acompanhamento
      , CASE
          WHEN medico_id IS NULL AND cor_raca NOT IN ('Preta','Parda') THEN COUNT(pac.id)
            END AS sem_acompanhamento
      , CASE
          WHEN medico_id IS NOT NULL AND cor_raca = 'Preta' THEN COUNT(pac.id)
            END AS com_acompanhamento_preta
      , CASE
          WHEN medico_id IS NULL AND cor_raca = 'Preta' THEN COUNT(pac.id)
            END AS sem_acompanhamento_preta
      , CASE
          WHEN medico_id IS NOT NULL AND cor_raca = 'Parda' THEN COUNT(pac.id)
        END AS com_acompanhamento_parda
      , CASE
          WHEN medico_id IS NULL AND cor_raca = 'Parda' THEN COUNT(pac.id)
        END AS sem_acompanhamento_parda
      FROM pacientes pac
        GROUP BY medico_id, cor_raca)TBB
    GROUP BY cor_raca
    ORDER BY cor_raca
    ");
    return array($avaliacao_medica_por_raca_cor);
  }

  public function avaliacao_psicologos_por_raca_cor()
  {
    $avaliacao_psicologos_por_raca_cor = DB::select("
    SELECT
      cor_raca
        , COALESCE(SUM(com_acompanhamento),0) AS com_acompanhamento
        , COALESCE(SUM(sem_acompanhamento),0) AS sem_acompanhamento
        , COALESCE(SUM(com_acompanhamento_preta),0) AS com_acompanhamento_preta
        , COALESCE(SUM(sem_acompanhamento_preta),0) AS sem_acompanhamento_preta
        , COALESCE(SUM(com_acompanhamento_parda),0) AS com_acompanhamento_parda
        , COALESCE(SUM(sem_acompanhamento_parda),0) AS sem_acompanhamento_parda
    FROM   (
      SELECT
        CASE
          WHEN cor_raca IS NULL THEN 'Sem info.'
                WHEN cor_raca IN ('Preta','Parda') THEN 'Negra'
        ELSE cor_raca END AS cor_raca
      , CASE
          WHEN psicologo_id IS NOT NULL AND cor_raca NOT IN ('Preta','Parda') THEN COUNT(pac.id)
        END AS com_acompanhamento
      , CASE
          WHEN psicologo_id IS NULL AND cor_raca NOT IN ('Preta','Parda') THEN COUNT(pac.id)
            END AS sem_acompanhamento
      , CASE
          WHEN psicologo_id IS NOT NULL AND cor_raca = 'Preta' THEN COUNT(pac.id)
            END AS com_acompanhamento_preta
      , CASE
          WHEN psicologo_id IS NULL AND cor_raca = 'Preta' THEN COUNT(pac.id)
            END AS sem_acompanhamento_preta
      , CASE
          WHEN psicologo_id IS NOT NULL AND cor_raca = 'Parda' THEN COUNT(pac.id)
        END AS com_acompanhamento_parda
      , CASE
          WHEN psicologo_id IS NULL AND cor_raca = 'Parda' THEN COUNT(pac.id)
        END AS sem_acompanhamento_parda
      FROM pacientes pac
        GROUP BY psicologo_id, cor_raca)TBB
    GROUP BY cor_raca
    ORDER BY cor_raca
    ");
    return array($avaliacao_psicologos_por_raca_cor);
  }

  public function gestacao_alto_risco()
  {
    $gestacao_alto_risco = DB::select("
    SELECT
      cor_raca
        , COALESCE(SUM(sem_informacao),0) AS sem_informacao
        , COALESCE(SUM(sim),0) AS sim
        , COALESCE(SUM(nao),0) AS nao
        , COALESCE(SUM(sim_preta),0) AS sim_preta
        , COALESCE(SUM(nao_preta),0) AS nao_preta
        , COALESCE(SUM(sim_parda),0) AS sim_parda
        , COALESCE(SUM(nao_parda),0) AS nao_parda
    FROM   (
      SELECT
        CASE
          WHEN cor_raca IS NULL THEN 'Sem info.'
                WHEN cor_raca IN ('Preta','Parda') THEN 'Negra'
        ELSE cor_raca END AS cor_raca
      , CASE
          WHEN gestacao_alto_risco IS NULL THEN COUNT(pac.id)
        END AS sem_informacao
      , CASE
          WHEN gestacao_alto_risco = 'sim' AND cor_raca NOT IN ('Preta','Parda') THEN COUNT(pac.id)
        END AS sim
      , CASE
          WHEN gestacao_alto_risco = 'não' AND cor_raca NOT IN ('Preta','Parda') THEN COUNT(pac.id)
            END AS nao
      , CASE
          WHEN gestacao_alto_risco = 'sim' AND cor_raca = 'Preta' THEN COUNT(pac.id)
            END AS sim_preta
      , CASE
          WHEN gestacao_alto_risco = 'não' AND cor_raca = 'Preta' THEN COUNT(pac.id)
            END AS nao_preta
      , CASE
          WHEN gestacao_alto_risco = 'sim' AND cor_raca = 'Parda' THEN COUNT(pac.id)
        END AS sim_parda
      , CASE
          WHEN gestacao_alto_risco = 'não' AND cor_raca = 'Parda' THEN COUNT(pac.id)
        END AS nao_parda
      FROM pacientes pac
        GROUP BY gestacao_alto_risco, cor_raca)TBB
    GROUP BY cor_raca
    ORDER BY cor_raca
    ");
    return array($gestacao_alto_risco);
  }

  public function acompanhamento_sistema_saude()
  {
    $acompanhamento_sistema_saude = DB::select("
    SELECT
      cor_raca
        , COALESCE(SUM(sem_informacao),0) AS sem_informacao
        , COALESCE(SUM(sim),0) AS sim
        , COALESCE(SUM(nao),0) AS nao
        , COALESCE(SUM(sim_preta),0) AS sim_preta
        , COALESCE(SUM(nao_preta),0) AS nao_preta
        , COALESCE(SUM(sim_parda),0) AS sim_parda
        , COALESCE(SUM(nao_parda),0) AS nao_parda
    FROM   (
      SELECT
        CASE
          WHEN cor_raca IS NULL THEN 'Sem info.'
                WHEN cor_raca IN ('Preta','Parda') THEN 'Negra'
        ELSE cor_raca END AS cor_raca
      , CASE
          WHEN acompanhamento_ubs IS NULL THEN COUNT(pac.id)
        END AS sem_informacao
      , CASE
          WHEN acompanhamento_ubs = 'sim' AND cor_raca NOT IN ('Preta','Parda') THEN COUNT(pac.id)
        END AS sim
      , CASE
          WHEN acompanhamento_ubs = 'não' AND cor_raca NOT IN ('Preta','Parda') THEN COUNT(pac.id)
            END AS nao
      , CASE
          WHEN acompanhamento_ubs = 'sim' AND cor_raca = 'Preta' THEN COUNT(pac.id)
            END AS sim_preta
      , CASE
          WHEN acompanhamento_ubs = 'não' AND cor_raca = 'Preta' THEN COUNT(pac.id)
            END AS nao_preta
      , CASE
          WHEN acompanhamento_ubs = 'sim' AND cor_raca = 'Parda' THEN COUNT(pac.id)
        END AS sim_parda
      , CASE
          WHEN acompanhamento_ubs = 'não' AND cor_raca = 'Parda' THEN COUNT(pac.id)
        END AS nao_parda
      FROM pacientes pac
        GROUP BY acompanhamento_ubs, cor_raca)TBB
    GROUP BY cor_raca
    ORDER BY cor_raca
    ");
    return array($acompanhamento_sistema_saude);
  }

  public function saude_mental()
  {
    $saude_mental = DB::select("
    SELECT
      cor_raca
        , COALESCE(SUM(sem_informacao),0) AS sem_informacao
        , COALESCE(SUM(sim),0) AS sim
        , COALESCE(SUM(nao),0) AS nao
        , COALESCE(SUM(sim_preta),0) AS sim_preta
        , COALESCE(SUM(nao_preta),0) AS nao_preta
        , COALESCE(SUM(sim_parda),0) AS sim_parda
        , COALESCE(SUM(nao_parda),0) AS nao_parda
    FROM   (
      SELECT
        CASE
          WHEN cor_raca IS NULL THEN 'Sem info.'
                WHEN cor_raca IN ('Preta','Parda') THEN 'Negra'
        ELSE cor_raca END AS cor_raca
      , CASE
          WHEN quadro_atual IS NULL THEN COUNT(pac.id)
        END AS sem_informacao
      , CASE
          WHEN quadro_atual = 'sim' AND cor_raca NOT IN ('Preta','Parda') THEN COUNT(pac.id)
        END AS sim
      , CASE
          WHEN quadro_atual = 'não' AND cor_raca NOT IN ('Preta','Parda') THEN COUNT(pac.id)
            END AS nao
      , CASE
          WHEN quadro_atual = 'sim' AND cor_raca = 'Preta' THEN COUNT(pac.id)
            END AS sim_preta
      , CASE
          WHEN quadro_atual = 'não' AND cor_raca = 'Preta' THEN COUNT(pac.id)
            END AS nao_preta
      , CASE
          WHEN quadro_atual = 'sim' AND cor_raca = 'Parda' THEN COUNT(pac.id)
        END AS sim_parda
      , CASE
          WHEN quadro_atual = 'não' AND cor_raca = 'Parda' THEN COUNT(pac.id)
        END AS nao_parda
      FROM pacientes pac
      LEFT JOIN saude_mentals sm ON sm.paciente_id = pac.id
        GROUP BY quadro_atual, cor_raca)TBB
    GROUP BY cor_raca
    ORDER BY cor_raca
    ");
    return array($saude_mental);
  }

  public function servicos_referencia_internacao()
  {
    $servicos_referencia_internacao = DB::select("
    SELECT
      dias
      , COUNT(*) AS pacientes
    FROM
      (SELECT
        COUNT(mon.data_monitoramento) dias
      FROM
        pacientes pac
        LEFT JOIN monitoramentos mon ON mon.paciente_id = pac.id
      GROUP BY pac.id
      ORDER BY 1)TB
    GROUP BY dias ;
    ");
    return array($servicos_referencia_internacao);
  }

  public function idas_sistema_saude_x_prescricao_medicamentos_brancas()
  {
    $idas_sistema_saude_x_prescricao_medicamentos = DB::select("
    SELECT
    	medicamentos_cidade
        , COUNT(*) AS quantidade
    FROM
    	(SELECT
    		CASE
    			WHEN medicamento IS NULL
    				THEN 'Não recebeu nenhum medicamento'
    			WHEN medicamento IN ('Medico do SUS receitou, Azitromicina', 'médico hospital, Azitromicina', 'médico sus, Azitromicina', 'Último dia de Azitromicina')
    				THEN 'Recebeu somente azitromicina'
    			WHEN medicamento LIKE '%azitromicina%'
    				THEN 'Azitromicina e outros medicamentos'
    			ELSE 'Somente outros medicamentos' END AS medicamentos_cidade
    		, pac.id
    	FROM
    		pacientes pac
    		LEFT JOIN monitoramentos mon ON mon.paciente_id = pac.id
    	WHERE cor_raca = 'Branca'
    	ORDER BY 1)TB
    GROUP BY medicamentos_cidade;
    ");
    return array($idas_sistema_saude_x_prescricao_medicamentos);
  }

  public function idas_sistema_saude_x_prescricao_medicamentos_pretas()
  {
    $idas_sistema_saude_x_prescricao_medicamentos_pretas = DB::select("
    SELECT
    	medicamentos_cidade
        , COUNT(*) AS quantidade
    FROM
    	(SELECT
    		CASE
    			WHEN medicamento IS NULL
    				THEN 'Não recebeu nenhum medicamento'
    			WHEN medicamento IN ('Medico do SUS receitou, Azitromicina', 'médico hospital, Azitromicina', 'médico sus, Azitromicina', 'Último dia de Azitromicina')
    				THEN 'Recebeu somente azitromicina'
    			WHEN medicamento LIKE '%azitromicina%'
    				THEN 'Azitromicina e outros medicamentos'
    			ELSE 'Somente outros medicamentos' END AS medicamentos_cidade
    		, pac.id
    	FROM
    		pacientes pac
    		LEFT JOIN monitoramentos mon ON mon.paciente_id = pac.id
    	WHERE cor_raca = 'Preta'
    	ORDER BY 1)TB
    GROUP BY medicamentos_cidade;
    ");
    return array($idas_sistema_saude_x_prescricao_medicamentos_pretas);
  }

  public function idas_sistema_saude_x_prescricao_medicamentos_pardas()
  {
    $idas_sistema_saude_x_prescricao_medicamentos_pardas = DB::select("
    SELECT
    	medicamentos_cidade
        , COUNT(*) AS quantidade
    FROM
    	(SELECT
    		CASE
    			WHEN medicamento IS NULL
    				THEN 'Não recebeu nenhum medicamento'
    			WHEN medicamento IN ('Medico do SUS receitou, Azitromicina', 'médico hospital, Azitromicina', 'médico sus, Azitromicina', 'Último dia de Azitromicina')
    				THEN 'Recebeu somente azitromicina'
    			WHEN medicamento LIKE '%azitromicina%'
    				THEN 'Azitromicina e outros medicamentos'
    			ELSE 'Somente outros medicamentos' END AS medicamentos_cidade
    		, pac.id
    	FROM
    		pacientes pac
    		LEFT JOIN monitoramentos mon ON mon.paciente_id = pac.id
    	WHERE cor_raca = 'Parda'
    	ORDER BY 1)TB
    GROUP BY medicamentos_cidade;
    ");
    return array($idas_sistema_saude_x_prescricao_medicamentos_pardas);
  }

  public function uso_cronico_alcool_drogas_raca_cor()
  {
    $uso_cronico_alcool_drogas_raca_cor = DB::select("
    SELECT
        condicao
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Uso crônico de alcool ' AS condicao
          , CASE WHEN cor_raca = 'Preta' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        WHERE cronico_alcool = 'sim'
        GROUP BY cor_raca, cronico_alcool)TB
      GROUP BY condicao

      UNION ALL

      SELECT
        condicao
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Uso crônico de outras drogas' AS condicao
          , CASE WHEN cor_raca = 'Preta' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        WHERE outras_drogas = 'sim'
        GROUP BY cor_raca, outras_drogas)TB
      GROUP BY condicao
    ");
    return json_encode($uso_cronico_alcool_drogas_raca_cor);
  }

  public function gestante_posparto_amamenta()
  {
    $gestante_posparto_amamenta = DB::select("
    SELECT
        condicao
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Gestante' AS condicao
          , CASE WHEN cor_raca = 'Preta' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        WHERE gestante = 'sim'
        GROUP BY cor_raca, gestante)TB
      GROUP BY condicao

      UNION ALL

      SELECT
        condicao
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Está no pós-parto (40 dias após o parto)' AS condicao
          , CASE WHEN cor_raca = 'Preta' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        WHERE pos_parto = 'sim'
        GROUP BY cor_raca, pos_parto)TB
      GROUP BY condicao

      UNION ALL

      SELECT
        condicao
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Amamenta' AS condicao
          , CASE WHEN cor_raca = 'Preta' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        WHERE amamenta = 'sim'
        GROUP BY cor_raca, amamenta)TB
      GROUP BY condicao
    ");
    return json_encode($gestante_posparto_amamenta);
  }

  public function como_acessa_sistema_saude()
  {
    $como_acessa_sistema_saude = DB::select("
    SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'É usuária/o do SUS (público)' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND sistema_saude LIKE '%31%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND sistema_saude LIKE '%31%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND sistema_saude LIKE '%31%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND sistema_saude LIKE '%31%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND sistema_saude LIKE '%31%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND sistema_saude LIKE '%31%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN quadro_atual qa ON pac.id = qa.paciente_id
        GROUP BY cor_raca, sistema_saude)TB
      GROUP BY pergunta

      UNION ALL

      SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Tem convênio/plano de saúde' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND sistema_saude LIKE '%29%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND sistema_saude LIKE '%29%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND sistema_saude LIKE '%29%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND sistema_saude LIKE '%29%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND sistema_saude LIKE '%29%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND sistema_saude LIKE '%29%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN quadro_atual qa ON pac.id = qa.paciente_id
        GROUP BY cor_raca, sistema_saude)TB
      GROUP BY pergunta


      UNION ALL

      SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Usuária/o de serviços pagos \'populares\' (Ex: Dr Consulta)' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND sistema_saude LIKE '%59%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND sistema_saude LIKE '%59%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND sistema_saude LIKE '%59%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND sistema_saude LIKE '%59%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND sistema_saude LIKE '%59%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND sistema_saude LIKE '%59%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN quadro_atual qa ON pac.id = qa.paciente_id
        GROUP BY cor_raca, sistema_saude)TB
      GROUP BY pergunta


      UNION ALL

      SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Usuária/o de serviços particulares não cobertos por convênios' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND sistema_saude LIKE '%65%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND sistema_saude LIKE '%65%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND sistema_saude LIKE '%65%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND sistema_saude LIKE '%65%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND sistema_saude LIKE '%65%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND sistema_saude LIKE '%65%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN quadro_atual qa ON pac.id = qa.paciente_id
        GROUP BY cor_raca, sistema_saude)TB
      GROUP BY pergunta
    ");
    return json_encode($como_acessa_sistema_saude);
  }

  public function diagnostico_covid_19()
  {
    $diagnostico_covid_19 = DB::select("
    SELECT
        COALESCE(sintomas_iniciais, 'Não info.') AS sintomas_iniciais
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          sintomas_iniciais
          , CASE WHEN cor_raca = 'Preta' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        GROUP BY cor_raca, sintomas_iniciais)TB
      GROUP BY sintomas_iniciais
    ");
    return json_encode($diagnostico_covid_19);
  }

  public function testes_realizados()
  {
    $testes_realizados = DB::select("
    SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'PCR' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND teste_utilizado LIKE '%PCR%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND teste_utilizado LIKE '%PCR%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND teste_utilizado LIKE '%PCR%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND teste_utilizado LIKE '%PCR%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND teste_utilizado LIKE '%PCR%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND teste_utilizado LIKE '%PCR%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN quadro_atual qa ON pac.id = qa.paciente_id
        GROUP BY cor_raca, teste_utilizado)TB
      GROUP BY pergunta




    UNION ALL
    SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Sorologias (IgM/IgG)' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND teste_utilizado LIKE '%sorologias (IgM/IgG)%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND teste_utilizado LIKE '%sorologias (IgM/IgG)%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND teste_utilizado LIKE '%sorologias (IgM/IgG)%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND teste_utilizado LIKE '%sorologias (IgM/IgG)%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND teste_utilizado LIKE '%sorologias (IgM/IgG)%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND teste_utilizado LIKE '%sorologias (IgM/IgG)%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN quadro_atual qa ON pac.id = qa.paciente_id
        GROUP BY cor_raca, teste_utilizado)TB
      GROUP BY pergunta

    UNION ALL
    SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Teste rápido' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND teste_utilizado LIKE '%teste rápido%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND teste_utilizado LIKE '%teste rápido%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND teste_utilizado LIKE '%teste rápido%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND teste_utilizado LIKE '%teste rápido%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND teste_utilizado LIKE '%teste rápido%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND teste_utilizado LIKE '%teste rápido%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN quadro_atual qa ON pac.id = qa.paciente_id
        GROUP BY cor_raca, teste_utilizado)TB
      GROUP BY pergunta

      UNION ALL

      SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Não informado' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND teste_utilizado LIKE '%não informado%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND teste_utilizado LIKE '%não informado%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND teste_utilizado LIKE '%não informado%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND teste_utilizado LIKE '%não informado%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND teste_utilizado LIKE '%não informado%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND teste_utilizado LIKE '%não informado%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN quadro_atual qa ON pac.id = qa.paciente_id
        GROUP BY cor_raca, teste_utilizado)TB
      GROUP BY pergunta
    ");
    return json_encode($testes_realizados);
  }

  public function desfecho()
  {
    $desfecho = DB::select("
    SELECT
        COALESCE(desfecho, 'Não info.') AS desfecho
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          desfecho
          , CASE WHEN cor_raca = 'Preta' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN quadro_atual qa ON pac.id = qa.paciente_id
        GROUP BY cor_raca, desfecho)TB
      GROUP BY desfecho
    ");
    return json_encode($desfecho);
  }

  public function sequelas()
  {
    $sequelas = DB::select("
    SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Perda persistente de paladar' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND sequelas LIKE '%perda persistente de paladar%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND sequelas LIKE '%perda persistente de paladar%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND sequelas LIKE '%perda persistente de paladar%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND sequelas LIKE '%perda persistente de paladar%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND sequelas LIKE '%perda persistente de paladar%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND sequelas LIKE '%perda persistente de paladar%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN quadro_atual qa ON pac.id = qa.paciente_id
        GROUP BY cor_raca, sequelas)TB
      GROUP BY pergunta




    UNION ALL


    SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Tosse persistente' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND sequelas LIKE '%tosse persistente%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND sequelas LIKE '%tosse persistente%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND sequelas LIKE '%tosse persistente%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND sequelas LIKE '%tosse persistente%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND sequelas LIKE '%tosse persistente%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND sequelas LIKE '%tosse persistente%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN quadro_atual qa ON pac.id = qa.paciente_id
        GROUP BY cor_raca, sequelas)TB
      GROUP BY pergunta


    UNION ALL

    SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Falta de ar persistente' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND sequelas LIKE '%falta de ar persistente%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND sequelas LIKE '%falta de ar persistente%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND sequelas LIKE '%falta de ar persistente%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND sequelas LIKE '%falta de ar persistente%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND sequelas LIKE '%falta de ar persistente%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND sequelas LIKE '%falta de ar persistente%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN quadro_atual qa ON pac.id = qa.paciente_id
        GROUP BY cor_raca, sequelas)TB
      GROUP BY pergunta


    UNION ALL

    SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Dor de cabeça persistente' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND sequelas LIKE '%dor de cabeça persistente%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND sequelas LIKE '%dor de cabeça persistente%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND sequelas LIKE '%dor de cabeça persistente%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND sequelas LIKE '%dor de cabeça persistente%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND sequelas LIKE '%dor de cabeça persistente%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND sequelas LIKE '%dor de cabeça persistente%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN quadro_atual qa ON pac.id = qa.paciente_id
        GROUP BY cor_raca, sequelas)TB
      GROUP BY pergunta

      UNION ALL

      SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Eventos tromboliticos' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND sequelas LIKE '%eventos tromboliticos%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND sequelas LIKE '%eventos tromboliticos%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND sequelas LIKE '%eventos tromboliticos%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND sequelas LIKE '%eventos tromboliticos%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND sequelas LIKE '%eventos tromboliticos%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND sequelas LIKE '%eventos tromboliticos%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN quadro_atual qa ON pac.id = qa.paciente_id
        GROUP BY cor_raca, sequelas)TB
      GROUP BY pergunta

      UNION ALL


      SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Danos renais' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND sequelas LIKE '%danos renais%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND sequelas LIKE '%danos renais%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND sequelas LIKE '%danos renais%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND sequelas LIKE '%danos renais%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND sequelas LIKE '%danos renais%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND sequelas LIKE '%danos renais%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN quadro_atual qa ON pac.id = qa.paciente_id
        GROUP BY cor_raca, sequelas)TB
      GROUP BY pergunta
    ");
    return json_encode($sequelas);
  }

  public function precisou_ir_servico_saude()
  {
    $precisou_ir_servico_saude = DB::select("
    /*UBS*/
    SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'UBS (Unidade Básica de Saúde - posto de saúde)' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND precisou_servico LIKE '%UBS%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND precisou_servico LIKE '%UBS%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND precisou_servico LIKE '%UBS%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND precisou_servico LIKE '%UBS%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND precisou_servico LIKE '%UBS%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND precisou_servico LIKE '%UBS%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN servico_internacaos sint ON pac.id = sint.paciente_id
        GROUP BY cor_raca, precisou_servico)TB
      GROUP BY pergunta



      UNION ALL


      /*UPA*/
    SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'UPA (Unidade de Pronto Atendimento)' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND precisou_servico LIKE '%UPA%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND precisou_servico LIKE '%UPA%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND precisou_servico LIKE '%UPA%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND precisou_servico LIKE '%UPA%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND precisou_servico LIKE '%UPA%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND precisou_servico LIKE '%UPA%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN servico_internacaos sint ON pac.id = sint.paciente_id
        GROUP BY cor_raca, precisou_servico)TB
      GROUP BY pergunta

      UNION ALL

      /*ama*/
    SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'AMA' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND precisou_servico LIKE '%ama%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND precisou_servico LIKE '%ama%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND precisou_servico LIKE '%ama%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND precisou_servico LIKE '%ama%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND precisou_servico LIKE '%ama%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND precisou_servico LIKE '%ama%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN servico_internacaos sint ON pac.id = sint.paciente_id
        GROUP BY cor_raca, precisou_servico)TB
      GROUP BY pergunta


      UNION ALL

      /*Hospital público*/
    SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Hospital público' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND precisou_servico LIKE '%Hospital público%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND precisou_servico LIKE '%Hospital público%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND precisou_servico LIKE '%Hospital público%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND precisou_servico LIKE '%Hospital público%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND precisou_servico LIKE '%Hospital público%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND precisou_servico LIKE '%Hospital público%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN servico_internacaos sint ON pac.id = sint.paciente_id
        GROUP BY cor_raca, precisou_servico)TB
      GROUP BY pergunta


      UNION ALL

      /*hospital privado*/
    SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Hospital privado' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND precisou_servico LIKE '%hospital privado%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND precisou_servico LIKE '%hospital privado%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND precisou_servico LIKE '%hospital privado%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND precisou_servico LIKE '%hospital privado%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND precisou_servico LIKE '%hospital privado%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND precisou_servico LIKE '%hospital privado%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN servico_internacaos sint ON pac.id = sint.paciente_id
        GROUP BY cor_raca, precisou_servico)TB
      GROUP BY pergunta
    ");
    return json_encode($precisou_ir_servico_saude);
  }

  public function recebeu_medicacoes_covid_19()
  {
    $recebeu_medicacoes_covid_19 = DB::select("
    /*Azitromicina*/
    SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Recebeu Azitromicina' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND recebeu_med_covid LIKE '%Azitromicina%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND recebeu_med_covid LIKE '%Azitromicina%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND recebeu_med_covid LIKE '%Azitromicina%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND recebeu_med_covid LIKE '%Azitromicina%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND recebeu_med_covid LIKE '%Azitromicina%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND recebeu_med_covid LIKE '%Azitromicina%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN servico_internacaos sint ON pac.id = sint.paciente_id
        GROUP BY cor_raca, recebeu_med_covid)TB
      GROUP BY pergunta


      UNION ALL

      /*outro antibiótico*/
    SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Recebeu outro antibiótico' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND recebeu_med_covid LIKE '%outro antibiótico%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND recebeu_med_covid LIKE '%outro antibiótico%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND recebeu_med_covid LIKE '%outro antibiótico%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND recebeu_med_covid LIKE '%outro antibiótico%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND recebeu_med_covid LIKE '%outro antibiótico%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND recebeu_med_covid LIKE '%outro antibiótico%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN servico_internacaos sint ON pac.id = sint.paciente_id
        GROUP BY cor_raca, recebeu_med_covid)TB
      GROUP BY pergunta


      UNION ALL

      /*ivermectina*/
    SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Recebeu ivermectina' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND recebeu_med_covid LIKE '%ivermectina%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND recebeu_med_covid LIKE '%ivermectina%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND recebeu_med_covid LIKE '%ivermectina%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND recebeu_med_covid LIKE '%ivermectina%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND recebeu_med_covid LIKE '%ivermectina%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND recebeu_med_covid LIKE '%ivermectina%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN servico_internacaos sint ON pac.id = sint.paciente_id
        GROUP BY cor_raca, recebeu_med_covid)TB
      GROUP BY pergunta


      UNION ALL



      /*cloroquina/hidroxicloroquina*/
    SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Recebeu cloroquina/hidroxicloroquina' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND recebeu_med_covid LIKE '%cloroquina/hidroxicloroquina%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND recebeu_med_covid LIKE '%cloroquina/hidroxicloroquina%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND recebeu_med_covid LIKE '%cloroquina/hidroxicloroquina%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND recebeu_med_covid LIKE '%cloroquina/hidroxicloroquina%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND recebeu_med_covid LIKE '%cloroquina/hidroxicloroquina%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND recebeu_med_covid LIKE '%cloroquina/hidroxicloroquina%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN servico_internacaos sint ON pac.id = sint.paciente_id
        GROUP BY cor_raca, recebeu_med_covid)TB
      GROUP BY pergunta


      UNION ALL


      /*oseltamivir (tamiflu)*/
    SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Recebeu oseltamivir (tamiflu)' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND recebeu_med_covid LIKE '%oseltamivir (tamiflu)%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND recebeu_med_covid LIKE '%oseltamivir (tamiflu)%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND recebeu_med_covid LIKE '%oseltamivir (tamiflu)%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND recebeu_med_covid LIKE '%oseltamivir (tamiflu)%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND recebeu_med_covid LIKE '%oseltamivir (tamiflu)%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND recebeu_med_covid LIKE '%oseltamivir (tamiflu)%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN servico_internacaos sint ON pac.id = sint.paciente_id
        GROUP BY cor_raca, recebeu_med_covid)TB
      GROUP BY pergunta
    ");
    return json_encode($recebeu_medicacoes_covid_19);
  }

  public function recebeu_medicacoes_covid_19_2()
  {
    $recebeu_medicacoes_covid_19_2 = DB::select("
    /*algum antialérgico*/
    SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Recebeu algum antialérgico' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND recebeu_med_covid LIKE '%algum antialérgico%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND recebeu_med_covid LIKE '%algum antialérgico%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND recebeu_med_covid LIKE '%algum antialérgico%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND recebeu_med_covid LIKE '%algum antialérgico%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND recebeu_med_covid LIKE '%algum antialérgico%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND recebeu_med_covid LIKE '%algum antialérgico%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN servico_internacaos sint ON pac.id = sint.paciente_id
        GROUP BY cor_raca, recebeu_med_covid)TB
      GROUP BY pergunta


      UNION ALL

      /*algum corticóide*/
    SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Recebeu algum corticóide' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND recebeu_med_covid LIKE '%algum corticóide%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND recebeu_med_covid LIKE '%algum corticóide%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND recebeu_med_covid LIKE '%algum corticóide%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND recebeu_med_covid LIKE '%algum corticóide%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND recebeu_med_covid LIKE '%algum corticóide%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND recebeu_med_covid LIKE '%algum corticóide%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN servico_internacaos sint ON pac.id = sint.paciente_id
        GROUP BY cor_raca, recebeu_med_covid)TB
      GROUP BY pergunta


      UNION ALL


      /*algum antiinflamatório*/
    SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Recebeu algum antiinflamatório' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND recebeu_med_covid LIKE '%algum antiinflamatório%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND recebeu_med_covid LIKE '%algum antiinflamatório%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND recebeu_med_covid LIKE '%algum antiinflamatório%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND recebeu_med_covid LIKE '%algum antiinflamatório%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND recebeu_med_covid LIKE '%algum antiinflamatório%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND recebeu_med_covid LIKE '%algum antiinflamatório%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN servico_internacaos sint ON pac.id = sint.paciente_id
        GROUP BY cor_raca, recebeu_med_covid)TB
      GROUP BY pergunta


      UNION ALL


      /*itamina*/
    SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Recebeu Vitamina D' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND recebeu_med_covid LIKE '%itamina%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND recebeu_med_covid LIKE '%itamina%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND recebeu_med_covid LIKE '%itamina%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND recebeu_med_covid LIKE '%itamina%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND recebeu_med_covid LIKE '%itamina%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND recebeu_med_covid LIKE '%itamina%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN servico_internacaos sint ON pac.id = sint.paciente_id
        GROUP BY cor_raca, recebeu_med_covid)TB
      GROUP BY pergunta


      UNION ALL



      /*inco*/
    SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Recebeu Zinco' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND recebeu_med_covid LIKE '%inco%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND recebeu_med_covid LIKE '%inco%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND recebeu_med_covid LIKE '%inco%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND recebeu_med_covid LIKE '%inco%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND recebeu_med_covid LIKE '%inco%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND recebeu_med_covid LIKE '%inco%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN servico_internacaos sint ON pac.id = sint.paciente_id
        GROUP BY cor_raca, recebeu_med_covid)TB
      GROUP BY pergunta
    ");
    return json_encode($recebeu_medicacoes_covid_19_2);
  }

  public function problemas_servicos_referencia()
  {
    $problemas_servicos_referencia = DB::select("
    SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'UBS (Unidade Básica de Saúde - posto de saúde)' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND teve_algum_problema LIKE '%UBS%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND teve_algum_problema LIKE '%UBS%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND teve_algum_problema LIKE '%UBS%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND teve_algum_problema LIKE '%UBS%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND teve_algum_problema LIKE '%UBS%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND teve_algum_problema LIKE '%UBS%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN servico_internacaos sint ON pac.id = sint.paciente_id
        GROUP BY cor_raca, teve_algum_problema)TB
      GROUP BY pergunta



      UNION ALL


      /*UPA*/
    SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'UPA (Unidade de Pronto Atendimento)' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND teve_algum_problema LIKE '%UPA%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND teve_algum_problema LIKE '%UPA%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND teve_algum_problema LIKE '%UPA%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND teve_algum_problema LIKE '%UPA%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND teve_algum_problema LIKE '%UPA%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND teve_algum_problema LIKE '%UPA%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN servico_internacaos sint ON pac.id = sint.paciente_id
        GROUP BY cor_raca, teve_algum_problema)TB
      GROUP BY pergunta

      UNION ALL

      /*ama*/
    SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'AMA' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND teve_algum_problema LIKE '%ama%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND teve_algum_problema LIKE '%ama%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND teve_algum_problema LIKE '%ama%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND teve_algum_problema LIKE '%ama%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND teve_algum_problema LIKE '%ama%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND teve_algum_problema LIKE '%ama%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN servico_internacaos sint ON pac.id = sint.paciente_id
        GROUP BY cor_raca, teve_algum_problema)TB
      GROUP BY pergunta


      UNION ALL

      /*Hospital público*/
    SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Hospital público' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND teve_algum_problema LIKE '%Hospital público%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND teve_algum_problema LIKE '%Hospital público%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND teve_algum_problema LIKE '%Hospital público%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND teve_algum_problema LIKE '%Hospital público%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND teve_algum_problema LIKE '%Hospital público%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND teve_algum_problema LIKE '%Hospital público%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN servico_internacaos sint ON pac.id = sint.paciente_id
        GROUP BY cor_raca, teve_algum_problema)TB
      GROUP BY pergunta


      UNION ALL

      /*hospital privado*/
    SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Hospital privado' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND teve_algum_problema LIKE '%hospital privado%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND teve_algum_problema LIKE '%hospital privado%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND teve_algum_problema LIKE '%hospital privado%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND teve_algum_problema LIKE '%hospital privado%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND teve_algum_problema LIKE '%hospital privado%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND teve_algum_problema LIKE '%hospital privado%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN servico_internacaos sint ON pac.id = sint.paciente_id
        GROUP BY cor_raca, teve_algum_problema)TB
      GROUP BY pergunta
    ");
    return json_encode($problemas_servicos_referencia);
  }

  public function internacao_pelo_quadro()
  {
    $internacao_pelo_quadro = DB::select("
    SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Ambulância financiada pelo projeto?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN servico_internacaos si ON si.paciente_id = pac.id
        WHERE precisou_ambulancia = 'sim'
        GROUP BY cor_raca, precisou_ambulancia)TB
      GROUP BY pergunta

      UNION ALL

      SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Internação pelo quadro (suspeito ou confirmado)?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN servico_internacaos si ON si.paciente_id = pac.id
        WHERE precisou_internacao = 'sim'
        AND (sintomas_iniciais = 'Suspeito' OR sintomas_iniciais = 'Confirmado')
        GROUP BY cor_raca, precisou_internacao)TB
      GROUP BY pergunta
    ");
    return json_encode($internacao_pelo_quadro);
  }

  public function tempo_de_internacao()
  {
    $tempo_de_internacao = DB::select("
    SELECT
      tempo_internacao
        , COALESCE(SUM(sem_informacao),0) AS sem_informacao
        , COALESCE(SUM(preta),0) AS preta
        , COALESCE(SUM(parda),0) AS parda
        , COALESCE(SUM(branca),0) AS branca
        , COALESCE(SUM(amarela),0) AS amarela
        , COALESCE(SUM(indigena),0) AS indigena
        , tempo_internacao_order
    FROM
      (SELECT
        REPLACE(si.tempo_internacao, ' dias', '') AS tempo_internacao
        , CAST(REPLACE(si.tempo_internacao, ' dias', '') AS SIGNED)  AS tempo_internacao_order
        , CASE WHEN cor_raca IS NULL THEN COUNT(pac.id) END AS sem_informacao
        , CASE WHEN cor_raca = 'Preta' THEN COUNT(pac.id) END AS preta
        , CASE WHEN cor_raca = 'Parda' THEN COUNT(pac.id) END AS parda
        , CASE WHEN cor_raca = 'Branca' THEN COUNT(pac.id) END AS branca
        , CASE WHEN cor_raca = 'Amarela' THEN COUNT(pac.id) END AS amarela
        , CASE WHEN cor_raca = 'Indígena'THEN COUNT(pac.id) END AS indigena
      FROM pacientes pac
        INNER JOIN servico_internacaos si ON si.paciente_id = pac.id
        WHERE tempo_internacao IS NOT NULL
      GROUP BY tempo_internacao, cor_raca)TB
    GROUP BY tempo_internacao, tempo_internacao_order
    ORDER BY tempo_internacao_order;
    ");
    return $tempo_de_internacao;
  }

  public function condicoes_saude()
  {
    $condicoes_saude = DB::select("
    SELECT
        doenca_cronica
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
        CASE
          WHEN doenca_cronica LIKE '%1%' THEN 'Hipertensão arterial sistêmica (HAS)'
          WHEN doenca_cronica LIKE '%2%' THEN 'Diabetes Mellitus (DM)'
          WHEN doenca_cronica LIKE '%3%' THEN 'Dislipidemia'
          WHEN doenca_cronica LIKE '%6%' THEN 'Cardiopatias e outras doenças cardiovasculares'
          WHEN doenca_cronica LIKE '%10%' THEN 'Doença renal'
        END AS doenca_cronica
        , CASE WHEN cor_raca = 'Preta' THEN COUNT(pac.id) END AS preta_sim
        , CASE WHEN cor_raca = 'Parda' THEN COUNT(pac.id) END AS parda_sim
        , CASE WHEN cor_raca = 'Indígena' THEN COUNT(pac.id) END AS indigena_sim
        , CASE WHEN cor_raca = 'Branca' THEN COUNT(pac.id) END AS branca_sim
        , CASE WHEN cor_raca = 'Amarela' THEN COUNT(pac.id) END AS amarela_sim
        , CASE WHEN cor_raca IS NULL THEN COUNT(pac.id) END AS nao_info_sim
      FROM pacientes pac
      GROUP BY cor_raca, doenca_cronica)TB
    WHERE doenca_cronica IS NOT NULL
    GROUP BY doenca_cronica;
    ");
    return $condicoes_saude;
  }

  public function condicoes_saude_2()
  {
    $condicoes_saude_2 = DB::select("
    SELECT
        doenca_cronica
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
        CASE
          WHEN doenca_cronica LIKE '%4%' THEN 'Asma / Bronquite'
          WHEN doenca_cronica LIKE '%7%' THEN 'Outras doenças Respiratórias'
          WHEN doenca_cronica LIKE '%5%' THEN 'Tuberculose ativa'
          WHEN tuberculose = 'sim' AND doenca_cronica NOT LIKE '%5%' THEN 'Já teve tuberculose?'
          WHEN tabagista = 'sim' THEN 'Tabagismo'
        END AS doenca_cronica
        , CASE WHEN cor_raca = 'Preta' THEN COUNT(pac.id) END AS preta_sim
        , CASE WHEN cor_raca = 'Parda' THEN COUNT(pac.id) END AS parda_sim
        , CASE WHEN cor_raca = 'Indígena' THEN COUNT(pac.id) END AS indigena_sim
        , CASE WHEN cor_raca = 'Branca' THEN COUNT(pac.id) END AS branca_sim
        , CASE WHEN cor_raca = 'Amarela' THEN COUNT(pac.id) END AS amarela_sim
        , CASE WHEN cor_raca IS NULL THEN COUNT(pac.id) END AS nao_info_sim
      FROM pacientes pac
      GROUP BY cor_raca, doenca_cronica, tuberculose, tabagista)TB
    WHERE doenca_cronica IS NOT NULL
    GROUP BY doenca_cronica;
    ");
    return $condicoes_saude_2;
  }

  public function condicoes_saude_3()
  {
    $condicoes_saude_3 = DB::select("
    SELECT
        doenca_cronica
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
        CASE
          WHEN doenca_cronica LIKE '%12%' THEN 'Câncer'
          WHEN doenca_cronica LIKE '%8%' THEN 'Artrite/Artrose/Reumatismo'
          WHEN doenca_cronica LIKE '%9%' THEN 'Doença autoimune'
          WHEN doenca_cronica LIKE '%11%' THEN 'Doença neurológica'
        END AS doenca_cronica
        , CASE WHEN cor_raca = 'Preta' THEN COUNT(pac.id) END AS preta_sim
        , CASE WHEN cor_raca = 'Parda' THEN COUNT(pac.id) END AS parda_sim
        , CASE WHEN cor_raca = 'Indígena' THEN COUNT(pac.id) END AS indigena_sim
        , CASE WHEN cor_raca = 'Branca' THEN COUNT(pac.id) END AS branca_sim
        , CASE WHEN cor_raca = 'Amarela' THEN COUNT(pac.id) END AS amarela_sim
        , CASE WHEN cor_raca IS NULL THEN COUNT(pac.id) END AS nao_info_sim
      FROM pacientes pac
      GROUP BY cor_raca, doenca_cronica)TB
    WHERE doenca_cronica IS NOT NULL
    GROUP BY doenca_cronica;
    ");
    return $condicoes_saude_3;
  }

}
