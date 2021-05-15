<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;
use Lava;
use DB;
use Carbon\Carbon;
use App\Monitoramento;
use App\Paciente;

class ChartsControllerBK extends Controller
{
    public function index($chart_id)
    {
        $chart_view = 'graph-' . $chart_id;
        return view('pages.graficos.'.$chart_view);
    }

    public function monitorados_exclusivo_psicologia()
    {
        // CHART::2
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
          'PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)?' AS pergunta
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
          'PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)?' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND (tratamento_financiado = 'N;' OR tratamento_financiado NOT LIKE '%PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)%') THEN COUNT(pac.id) END AS preta_nao
          , CASE WHEN cor_raca = 'Parda' AND (tratamento_financiado = 'N;' OR tratamento_financiado NOT LIKE '%PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)%') THEN COUNT(pac.id) END AS parda_nao
          , CASE WHEN cor_raca = 'Indígena' AND (tratamento_financiado = 'N;' OR tratamento_financiado NOT LIKE '%PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)%') THEN COUNT(pac.id) END AS indigena_nao
          , CASE WHEN cor_raca = 'Branca' AND (tratamento_financiado = 'N;' OR tratamento_financiado NOT LIKE '%PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)%') THEN COUNT(pac.id) END AS branca_nao
          , CASE WHEN cor_raca = 'Amarela' AND (tratamento_financiado = 'N;' OR tratamento_financiado NOT LIKE '%PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)%') THEN COUNT(pac.id) END AS amarela_nao
          , CASE WHEN cor_raca IS NULL AND (tratamento_financiado = 'N;' OR tratamento_financiado NOT LIKE '%PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)%') THEN COUNT(pac.id) END AS nao_info_nao
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
          , CASE WHEN cor_raca = 'Preta' AND (tratamento_financiado = 'N;' OR tratamento_financiado NOT LIKE '%Alopático (medicamentos convencionais)%') THEN COUNT(pac.id) END AS preta_nao
          , CASE WHEN cor_raca = 'Parda' AND (tratamento_financiado = 'N;' OR tratamento_financiado NOT LIKE '%Alopático (medicamentos convencionais)%') THEN COUNT(pac.id) END AS parda_nao
          , CASE WHEN cor_raca = 'Indígena' AND (tratamento_financiado = 'N;' OR tratamento_financiado NOT LIKE '%Alopático (medicamentos convencionais)%') THEN COUNT(pac.id) END AS indigena_nao
          , CASE WHEN cor_raca = 'Branca' AND (tratamento_financiado = 'N;' OR tratamento_financiado NOT LIKE '%Alopático (medicamentos convencionais)%') THEN COUNT(pac.id) END AS branca_nao
          , CASE WHEN cor_raca = 'Amarela' AND (tratamento_financiado = 'N;' OR tratamento_financiado NOT LIKE '%Alopático (medicamentos convencionais)%') THEN COUNT(pac.id) END AS amarela_nao
          , CASE WHEN cor_raca IS NULL AND (tratamento_financiado = 'N;' OR tratamento_financiado NOT LIKE '%Alopático (medicamentos convencionais)%') THEN COUNT(pac.id) END AS nao_info_nao
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
        ");*/
        $dias_sintoma_mais_menos_dez_dias = DB::select("
    SELECT
      quantidade_dias
        , SUM(pacientes) AS pacientes
    FROM
        (SELECT
        CASE
          WHEN DATEDIFF(data_inicio_monitoramento, data_inicio_sintoma) > 10 THEN 'Mais de dez dias'
          WHEN DATEDIFF(data_inicio_monitoramento, data_inicio_sintoma) <= 10 THEN 'Menos de dez dias'
          END AS quantidade_dias
          , COUNT(id) AS pacientes
      FROM
        (SELECT
          id
          , CAST(CONCAT(SUBSTRING(data_inicio_monitoramento,7,4),'-',SUBSTRING(data_inicio_monitoramento,4,2),'-',SUBSTRING(data_inicio_monitoramento,1,2)) AS DATE) AS data_inicio_monitoramento
          , CAST(CONCAT(SUBSTRING(data_inicio_sintoma,7,4),'-',SUBSTRING(data_inicio_sintoma,4,2),'-',SUBSTRING(data_inicio_sintoma,1,2)) AS DATE) AS data_inicio_sintoma
        FROM
        (SELECT
          id
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
        GROUP BY data_inicio_monitoramento, data_inicio_sintoma)TBBB
    WHERE quantidade_dias IS NOT NULL
    GROUP BY quantidade_dias
    ;
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
        /*$acompanhamento_psicologico_individual_emgrupo = DB::select("
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
        ");*/
        $acompanhamento_psicologico_individual_emgrupo = DB::select("
    SELECT
      CASE
        WHEN acompanhamento_psicologico LIKE 'a:1%' AND acompanhamento_psicologico LIKE '%s:10%' THEN 'Acompanhamento individual'
        WHEN acompanhamento_psicologico LIKE 'a:1%' AND acompanhamento_psicologico LIKE '%s:8%' THEN 'Acompanhamento em grupo'
        WHEN acompanhamento_psicologico LIKE 'a:2%' THEN 'Acompanhamento individual e em grupo'
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
        /*$servicos_referencia_internacao = DB::select("
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
        ");*/
        $servicos_referencia_internacao = DB::select("
    SELECT
      COALESCE(CAST(quant_ida_servico AS UNSIGNED),0) idas_servico_saude
      , COUNT(pac.id) pacientes
    FROM
      pacientes pac
      LEFT JOIN servico_internacaos si ON si.paciente_id = pac.id
    GROUP BY idas_servico_saude
    ORDER BY 1;
    ");
        return $servicos_referencia_internacao;
    }

    public function idas_sistema_saude_x_prescricao_medicamentos_brancas()
    {
        /*$idas_sistema_saude_x_prescricao_medicamentos = DB::select("
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
        ");*/
        $idas_sistema_saude_x_prescricao_medicamentos = DB::select("
    SELECT
    	medicamentos
        , COUNT(*)
    FROM
    	(SELECT
    		CASE
    			WHEN medicamento IS NULL
    				THEN 'Não recebeu nenhum medicamento'
    			WHEN medicamento IN ('Medico do SUS receitou, Azitromicina', 'médico hospital, Azitromicina', 'médico sus, Azitromicina', 'Último dia de Azitromicina')
    				THEN 'Recebeu somente azitromicina'
    			WHEN medicamento LIKE '%azitromicina%'
    				THEN 'Azitromicina e outros medicamentos'
    			ELSE 'Somente outros medicamentos' END AS medicamentos
    		, pac.id
    	FROM
    		pacientes pac
    		LEFT JOIN monitoramentos mon ON mon.paciente_id = pac.id
            LEFT JOIN servico_internacaos si ON si.paciente_id = pac.id
    	WHERE cor_raca = 'Branca' AND CAST(quant_ida_servico AS UNSIGNED) > 1
    	ORDER BY 1)TB
    GROUP BY medicamentos;
    ");
        return $idas_sistema_saude_x_prescricao_medicamentos;
    }

    public function idas_sistema_saude_x_prescricao_medicamentos_pretas()
    {
        /*$idas_sistema_saude_x_prescricao_medicamentos_pretas = DB::select("
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
        ");*/
        $idas_sistema_saude_x_prescricao_medicamentos_pretas = DB::select("
    SELECT
    	medicamentos
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
    			ELSE 'Somente outros medicamentos' END AS medicamentos
    		, pac.id
    	FROM
    		pacientes pac
    		LEFT JOIN monitoramentos mon ON mon.paciente_id = pac.id
            LEFT JOIN servico_internacaos si ON si.paciente_id = pac.id
    	WHERE cor_raca = 'Preta' AND CAST(quant_ida_servico AS UNSIGNED) > 1
    	ORDER BY 1)TB
    GROUP BY medicamentos;
    ");
        return $idas_sistema_saude_x_prescricao_medicamentos_pretas;
    }

    public function idas_sistema_saude_x_prescricao_medicamentos_pardas()
    {
        /*$idas_sistema_saude_x_prescricao_medicamentos_pardas = DB::select("
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
        ");*/
        $idas_sistema_saude_x_prescricao_medicamentos_pardas = DB::select("
    SELECT
    	medicamentos
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
    			ELSE 'Somente outros medicamentos' END AS medicamentos
    		, pac.id
    	FROM
    		pacientes pac
    		LEFT JOIN monitoramentos mon ON mon.paciente_id = pac.id
            LEFT JOIN servico_internacaos si ON si.paciente_id = pac.id
    	WHERE cor_raca = 'Parda' AND CAST(quant_ida_servico AS UNSIGNED) > 1
    	ORDER BY 1)TB
    GROUP BY medicamentos;
    ");
        return $idas_sistema_saude_x_prescricao_medicamentos_pardas;
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
        /*$como_acessa_sistema_saude = DB::select("
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
        ");*/
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
        /*$desfecho = DB::select("
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
        ");*/
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
        WHERE situacao NOT IN (5, 14)
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
        /*$condicoes_saude = DB::select("
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
        ");*/
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

    public function avaliacao_medica_raca_cor()
    {
        $avaliacao_medica_raca_cor = DB::select("
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
        return $avaliacao_medica_raca_cor;
    }

    public function condicoes_saude_saude_mental()
    {
        $condicoes_saude_saude_mental = DB::select("
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
          WHEN doenca_cronica LIKE '%13%' THEN 'Ansiedade'
          WHEN doenca_cronica LIKE '%14%' THEN 'Depressão'
          WHEN doenca_cronica LIKE '%15%' THEN 'Demência'
          WHEN doenca_cronica LIKE '%16%' THEN 'Outras questões de saúde mental'
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
        return $condicoes_saude_saude_mental;
    }

    public function trimestre_gestacao_inicio_monitoramento()
    {
        $trimestre_gestacao_inicio_monitoramento = DB::select("
    SELECT
      trimestre_gestacao
      , COALESCE(SUM(branca_sim),0) AS branca
      , COALESCE(SUM(indigena_sim),0) AS indigena
      , COALESCE(SUM(amarela_sim),0) AS amarela
      , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
      , COALESCE(SUM(nao_info_sim),0) AS nao_info
    FROM
      (SELECT
        COALESCE(trimestre_gestacao, 'Não info.') AS trimestre_gestacao
        , CASE WHEN cor_raca = 'Preta' THEN COUNT(pac.id) END AS preta_sim
        , CASE WHEN cor_raca = 'Parda' THEN COUNT(pac.id) END AS parda_sim
        , CASE WHEN cor_raca = 'Indígena' THEN COUNT(pac.id) END AS indigena_sim
        , CASE WHEN cor_raca = 'Branca' THEN COUNT(pac.id) END AS branca_sim
        , CASE WHEN cor_raca = 'Amarela' THEN COUNT(pac.id) END AS amarela_sim
        , CASE WHEN cor_raca IS NULL THEN COUNT(pac.id) END AS nao_info_sim
      FROM pacientes pac
      WHERE gestante = 'sim'
      GROUP BY cor_raca, trimestre_gestacao)TB
    GROUP BY trimestre_gestacao
    ORDER BY 1
    ");
        return $trimestre_gestacao_inicio_monitoramento;
    }

    public function acumulo_sintomas()
    {
        $acumulo_sintomas = DB::select("
    SELECT
      quantidade_sintomas
      , COALESCE(SUM(confirmado_leve),0) AS confirmado_leve
      , COALESCE(SUM(confirmado_grave),0) AS confirmado_grave
      , COALESCE(SUM(descartado_leve),0) AS descartado_leve
      , COALESCE(SUM(descartado_grave),0) AS descartado_grave
      , COALESCE(SUM(suspeito_leve),0) AS suspeito_leve
      , COALESCE(SUM(suspeito_grave),0) AS suspeito_grave
    FROM(
      SELECT
        COALESCE(
          CASE
            WHEN sintomas_atuais LIKE 'a:1%' THEN 1
            WHEN sintomas_atuais LIKE 'a:2%' THEN 2
            WHEN sintomas_atuais LIKE 'a:3%' THEN 3
            WHEN sintomas_atuais LIKE 'a:4%' THEN 4
            WHEN sintomas_atuais LIKE 'a:5%' THEN 5
            WHEN sintomas_atuais LIKE 'a:6%' THEN 6
            WHEN sintomas_atuais LIKE 'a:7%' THEN 7
            WHEN sintomas_atuais LIKE 'a:8%' THEN 8
            WHEN sintomas_atuais LIKE 'a:9%' THEN 9
            WHEN sintomas_atuais LIKE 'a:10%' THEN 10
            WHEN sintomas_atuais LIKE 'a:11%' THEN 11
            WHEN sintomas_atuais LIKE 'a:12%' THEN 12
            WHEN sintomas_atuais LIKE 'a:13%' THEN 13
            WHEN sintomas_atuais LIKE 'a:14%' THEN 14
            WHEN sintomas_atuais LIKE 'a:15%' THEN 15
          END, 'Não info.') AS quantidade_sintomas
          , CASE WHEN sintomas_iniciais = 'confirmado' AND situacao IN (2,7,11) THEN COUNT(pac.id) END confirmado_leve
          , CASE WHEN sintomas_iniciais = 'confirmado' AND situacao IN (1,6,10) THEN COUNT(pac.id) END confirmado_grave
          , CASE WHEN sintomas_iniciais = 'descartado' AND situacao IN (2,7,11) THEN COUNT(pac.id) END descartado_leve
          , CASE WHEN sintomas_iniciais = 'descartado' AND situacao IN (1,6,10) THEN COUNT(pac.id) END descartado_grave
          , CASE WHEN sintomas_iniciais = 'suspeito' AND situacao IN (2,7,11) THEN COUNT(pac.id) END suspeito_leve
          , CASE WHEN sintomas_iniciais = 'suspeito' AND situacao IN (1,6,10) THEN COUNT(pac.id) END suspeito_grave
        , COUNT(pac.id) AS pacientes
      FROM pacientes pac
        INNER JOIN evolucao_sintomas es ON es.paciente_id = pac.id
      GROUP BY 1, situacao, sintomas_iniciais) TB
    GROUP BY 1
    ORDER BY 1
    ");
        return array($acumulo_sintomas);
    }

    public function local_internacao()
    {
        $local_internacao = DB::select("
    SELECT
        pergunta
        , COALESCE(SUM(branca_sim),0) AS branca
        , COALESCE(SUM(indigena_sim),0) AS indigena
        , COALESCE(SUM(amarela_sim),0) AS amarela
        , COALESCE(SUM(preta_sim)+SUM(parda_sim),0) AS negro
        , COALESCE(SUM(nao_info_sim),0) AS nao_info
      FROM
        (SELECT
          'Hospital público de referência' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND local_internacao LIKE '%Hospital público de referência%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND local_internacao LIKE '%Hospital público de referência%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND local_internacao LIKE '%Hospital público de referência%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND local_internacao LIKE '%Hospital público de referência%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND local_internacao LIKE '%Hospital público de referência%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND local_internacao LIKE '%Hospital público de referência%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN servico_internacaos sint ON pac.id = sint.paciente_id
        GROUP BY cor_raca, local_internacao)TB
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
          'Hospital de campanha' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND local_internacao LIKE '%Hospital de campanha%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND local_internacao LIKE '%Hospital de campanha%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND local_internacao LIKE '%Hospital de campanha%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND local_internacao LIKE '%Hospital de campanha%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND local_internacao LIKE '%Hospital de campanha%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND local_internacao LIKE '%Hospital de campanha%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN servico_internacaos sint ON pac.id = sint.paciente_id
        GROUP BY cor_raca, local_internacao)TB
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
          'Hospital particular de referência' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND local_internacao LIKE '%Hospital particular de referência%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND local_internacao LIKE '%Hospital particular de referência%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND local_internacao LIKE '%Hospital particular de referência%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND local_internacao LIKE '%Hospital particular de referência%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND local_internacao LIKE '%Hospital particular de referência%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND local_internacao LIKE '%Hospital particular de referência%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN servico_internacaos sint ON pac.id = sint.paciente_id
        GROUP BY cor_raca, local_internacao)TB
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
          'Hospital municipal do Ipiranga (encaminhado pelo projeto)' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND local_internacao LIKE '%Hospital municipal do Ipiranga (encaminhado pelo projeto)%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND local_internacao LIKE '%Hospital municipal do Ipiranga (encaminhado pelo projeto)%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND local_internacao LIKE '%Hospital municipal do Ipiranga (encaminhado pelo projeto)%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND local_internacao LIKE '%Hospital municipal do Ipiranga (encaminhado pelo projeto)%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND local_internacao LIKE '%Hospital municipal do Ipiranga (encaminhado pelo projeto)%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND local_internacao LIKE '%Hospital municipal do Ipiranga (encaminhado pelo projeto)%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN servico_internacaos sint ON pac.id = sint.paciente_id
        GROUP BY cor_raca, local_internacao)TB
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
          'Hospital privado financiado pelo projeto' AS pergunta
          , CASE WHEN cor_raca = 'Preta' AND local_internacao LIKE '%Hospital privado financiado pelo projeto%' THEN COUNT(pac.id) END AS preta_sim
          , CASE WHEN cor_raca = 'Parda' AND local_internacao LIKE '%Hospital privado financiado pelo projeto%' THEN COUNT(pac.id) END AS parda_sim
          , CASE WHEN cor_raca = 'Indígena' AND local_internacao LIKE '%Hospital privado financiado pelo projeto%' THEN COUNT(pac.id) END AS indigena_sim
          , CASE WHEN cor_raca = 'Branca' AND local_internacao LIKE '%Hospital privado financiado pelo projeto%' THEN COUNT(pac.id) END AS branca_sim
          , CASE WHEN cor_raca = 'Amarela' AND local_internacao LIKE '%Hospital privado financiado pelo projeto%' THEN COUNT(pac.id) END AS amarela_sim
          , CASE WHEN cor_raca IS NULL AND local_internacao LIKE '%Hospital privado financiado pelo projeto%' THEN COUNT(pac.id) END AS nao_info_sim
        FROM pacientes pac
        LEFT JOIN servico_internacaos sint ON pac.id = sint.paciente_id
        GROUP BY cor_raca, local_internacao)TB
      GROUP BY pergunta
    ");
        return $local_internacao;
    }

    public function internacao_diagnostico()
    {
        $internacao_diagnostico = DB::select("
    SELECT
       COALESCE(sintomas_iniciais, 'Não info.') AS sintomas_iniciais
        , COALESCE(SUM(branca_nao),0) AS branca
        , COALESCE(SUM(indigena_nao),0) AS indigena
        , COALESCE(SUM(amarela_nao),0) AS amarela
        , COALESCE(SUM(preta_nao)+SUM(parda_nao),0) AS negro
        , COALESCE(SUM(nao_info_nao),0) AS nao_info
      FROM
        (SELECT
          CASE WHEN precisou_internacao = 'sim' THEN CONCAT('Sim \n\n ',sintomas_iniciais) END AS sintomas_iniciais
          , CASE WHEN cor_raca = 'Preta' THEN COUNT(pac.id) END AS preta_nao
          , CASE WHEN cor_raca = 'Parda' THEN COUNT(pac.id) END AS parda_nao
          , CASE WHEN cor_raca = 'Indígena' THEN COUNT(pac.id) END AS indigena_nao
          , CASE WHEN cor_raca = 'Branca' THEN COUNT(pac.id) END AS branca_nao
          , CASE WHEN cor_raca = 'Amarela' THEN COUNT(pac.id) END AS amarela_nao
          , CASE WHEN cor_raca IS NULL  THEN COUNT(pac.id) END AS nao_info_nao
        FROM pacientes pac
        INNER JOIN evolucao_sintomas es ON es.paciente_id = pac.id
        INNER JOIN servico_internacaos si ON si.paciente_id = pac.id
        GROUP BY cor_raca, sintomas_iniciais, precisou_internacao

        UNION ALL

        SELECT
          CASE WHEN precisou_internacao = 'nao' THEN CONCAT('Não \n\n ',sintomas_iniciais) END AS sintomas_iniciais
          , CASE WHEN cor_raca = 'Preta' THEN COUNT(pac.id) END AS preta_nao
          , CASE WHEN cor_raca = 'Parda' THEN COUNT(pac.id) END AS parda_nao
          , CASE WHEN cor_raca = 'Indígena' THEN COUNT(pac.id) END AS indigena_nao
          , CASE WHEN cor_raca = 'Branca' THEN COUNT(pac.id) END AS branca_nao
          , CASE WHEN cor_raca = 'Amarela' THEN COUNT(pac.id) END AS amarela_nao
          , CASE WHEN cor_raca IS NULL  THEN COUNT(pac.id) END AS nao_info_nao
        FROM pacientes pac
        INNER JOIN evolucao_sintomas es ON es.paciente_id = pac.id
        INNER JOIN servico_internacaos si ON si.paciente_id = pac.id
        GROUP BY cor_raca, sintomas_iniciais, precisou_internacao)TB
      GROUP BY sintomas_iniciais
    ");
        return $internacao_diagnostico;
    }

    public function sintomas_manifestados_situacao_raca_cor_1()
    {
        $sintomas_manifestados_situacao_raca_cor_1 = DB::select("
    SELECT
      situacao AS situacao
      , COALESCE(SUM(branca),0) AS branca
      , COALESCE(SUM(indigena),0) AS indigena
      , COALESCE(SUM(amarela),0) AS amarela
      , COALESCE(SUM(preta)+SUM(parda),0) AS negro
      , COALESCE(SUM(nao_info),0) AS nao_info
    FROM
      (SELECT
        CASE
        WHEN situacao IN (2,7,11) AND sintomas_manifestados LIKE '%tosse%' THEN 'Leve - Tosse'
        WHEN situacao IN (1,6,10) AND sintomas_manifestados LIKE '%tosse%' THEN 'Grave - Tosse'

        WHEN situacao IN (2,7,11) AND sintomas_manifestados LIKE '%falta de ar%' THEN 'Leve - Falta de ar'
        WHEN situacao IN (1,6,10) AND sintomas_manifestados LIKE '%falta de ar%' THEN 'Grave - Falta de ar'

        WHEN situacao IN (2,7,11) AND sintomas_manifestados LIKE '%febre%' THEN 'Leve - Febre'
        WHEN situacao IN (1,6,10) AND sintomas_manifestados LIKE '%febre%' THEN 'Grave - Febre'

        WHEN situacao IN (2,7,11) AND sintomas_manifestados LIKE '%dor de cabeça%' THEN 'Leve - Dor de cabeça'
        WHEN situacao IN (1,6,10) AND sintomas_manifestados LIKE '%dor de cabeça%' THEN 'Grave - Dor de cabeça'
      END AS situacao
        , CASE WHEN cor_raca = 'Preta' THEN COUNT(pac.id) END AS preta
        , CASE WHEN cor_raca = 'Parda' THEN COUNT(pac.id) END AS parda
        , CASE WHEN cor_raca = 'Indígena' THEN COUNT(pac.id) END AS indigena
        , CASE WHEN cor_raca = 'Branca' THEN COUNT(pac.id) END AS branca
        , CASE WHEN cor_raca = 'Amarela' THEN COUNT(pac.id) END AS amarela
        , CASE WHEN cor_raca IS NULL THEN COUNT(pac.id) END AS nao_info
      FROM pacientes pac
      LEFT JOIN quadro_atual qa ON pac.id = qa.paciente_id
      GROUP BY cor_raca, sintomas_manifestados, situacao)TB
  WHERE situacao IS NOT NULL
    GROUP BY situacao
    ");
        return $sintomas_manifestados_situacao_raca_cor_1;
    }

    public function sintomas_manifestados_situacao_raca_cor_2()
    {
        $sintomas_manifestados_situacao_raca_cor_2 = DB::select("
    SELECT
      situacao AS situacao
      , COALESCE(SUM(branca),0) AS branca
      , COALESCE(SUM(indigena),0) AS indigena
      , COALESCE(SUM(amarela),0) AS amarela
      , COALESCE(SUM(preta)+SUM(parda),0) AS negro
      , COALESCE(SUM(nao_info),0) AS nao_info
    FROM
      (SELECT
        CASE
        WHEN situacao IN (2,7,11) AND sintomas_manifestados LIKE '%perda de olfato%' THEN 'Leve - Perda de olfato'
        WHEN situacao IN (1,6,10) AND sintomas_manifestados LIKE '%perda de olfato%' THEN 'Grave - Perda de olfato'

        WHEN situacao IN (2,7,11) AND sintomas_manifestados LIKE '%perda do paladar%' THEN 'Leve - Perda do paladar'
        WHEN situacao IN (1,6,10) AND sintomas_manifestados LIKE '%perda do paladar%' THEN 'Grave - Perda do paladar'

        WHEN situacao IN (2,7,11) AND sintomas_manifestados LIKE '%enjoo ou vômitos%' THEN 'Leve - Enjoo ou vômitos'
        WHEN situacao IN (1,6,10) AND sintomas_manifestados LIKE '%enjoo ou vômitos%' THEN 'Grave - Enjoo ou vômitos'

        WHEN situacao IN (2,7,11) AND sintomas_manifestados LIKE '%diarréia%' THEN 'Leve - Diarréia'
        WHEN situacao IN (1,6,10) AND sintomas_manifestados LIKE '%diarréia%' THEN 'Grave - Diarréia'
      END AS situacao
        , CASE WHEN cor_raca = 'Preta' THEN COUNT(pac.id) END AS preta
        , CASE WHEN cor_raca = 'Parda' THEN COUNT(pac.id) END AS parda
        , CASE WHEN cor_raca = 'Indígena' THEN COUNT(pac.id) END AS indigena
        , CASE WHEN cor_raca = 'Branca' THEN COUNT(pac.id) END AS branca
        , CASE WHEN cor_raca = 'Amarela' THEN COUNT(pac.id) END AS amarela
        , CASE WHEN cor_raca IS NULL THEN COUNT(pac.id) END AS nao_info
      FROM pacientes pac
      LEFT JOIN quadro_atual qa ON pac.id = qa.paciente_id
      GROUP BY cor_raca, sintomas_manifestados, situacao)TB
  WHERE situacao IS NOT NULL
    GROUP BY situacao
    ");
        return $sintomas_manifestados_situacao_raca_cor_2;
    }

    public function sintomas_manifestados_situacao_raca_cor_3()
    {
        $sintomas_manifestados_situacao_raca_cor_3 = DB::select("
    SELECT
      situacao AS situacao
      , COALESCE(SUM(branca),0) AS branca
      , COALESCE(SUM(indigena),0) AS indigena
      , COALESCE(SUM(amarela),0) AS amarela
      , COALESCE(SUM(preta)+SUM(parda),0) AS negro
      , COALESCE(SUM(nao_info),0) AS nao_info
    FROM
      (SELECT
        CASE
        WHEN situacao IN (2,7,11) AND sintomas_manifestados LIKE '%aumento da pressão%' THEN 'Leve - Aumento da pressão'
        WHEN situacao IN (1,6,10) AND sintomas_manifestados LIKE '%aumento da pressão%' THEN 'Grave - Aumento da pressão'

        WHEN situacao IN (2,7,11) AND sintomas_manifestados LIKE '%queda brusca de pressão%' THEN 'Leve - Queda brusca de Pressão'
        WHEN situacao IN (1,6,10) AND sintomas_manifestados LIKE '%queda brusca de pressão%' THEN 'Grave - Queda brusca de Pressão'

        WHEN situacao IN (2,7,11) AND sintomas_manifestados LIKE '%dor torácica (dor no peito)%' THEN 'Leve - Dor torácica (dor no peito)'
        WHEN situacao IN (1,6,10) AND sintomas_manifestados LIKE '%dor torácica (dor no peito)%' THEN 'Grave - Dor torácica (dor no peito)'
      END AS situacao
        , CASE WHEN cor_raca = 'Preta' THEN COUNT(pac.id) END AS preta
        , CASE WHEN cor_raca = 'Parda' THEN COUNT(pac.id) END AS parda
        , CASE WHEN cor_raca = 'Indígena' THEN COUNT(pac.id) END AS indigena
        , CASE WHEN cor_raca = 'Branca' THEN COUNT(pac.id) END AS branca
        , CASE WHEN cor_raca = 'Amarela' THEN COUNT(pac.id) END AS amarela
        , CASE WHEN cor_raca IS NULL THEN COUNT(pac.id) END AS nao_info
      FROM pacientes pac
      LEFT JOIN quadro_atual qa ON pac.id = qa.paciente_id
      GROUP BY cor_raca, sintomas_manifestados, situacao)TB
  WHERE situacao IS NOT NULL
    GROUP BY situacao
    ");
        return $sintomas_manifestados_situacao_raca_cor_3;
    }

    public function sintomas_manifestados_situacao_raca_cor_4()
    {
        $sintomas_manifestados_situacao_raca_cor_4 = DB::select("
    SELECT
      situacao AS situacao
      , COALESCE(SUM(branca),0) AS branca
      , COALESCE(SUM(indigena),0) AS indigena
      , COALESCE(SUM(amarela),0) AS amarela
      , COALESCE(SUM(preta)+SUM(parda),0) AS negro
      , COALESCE(SUM(nao_info),0) AS nao_info
    FROM
      (SELECT
        CASE
        WHEN situacao IN (2,7,11) AND sintomas_manifestados LIKE '%sonolência ou cansaço importantes%' THEN 'Leve - Sonolência ou cansaço importantes'
        WHEN situacao IN (1,6,10) AND sintomas_manifestados LIKE '%sonolência ou cansaço importantes%' THEN 'Grave - Sonolência ou cansaço importantes'

        WHEN situacao IN (2,7,11) AND sintomas_manifestados LIKE '%confusão mental%' THEN 'Leve - Confusão mental'
        WHEN situacao IN (1,6,10) AND sintomas_manifestados LIKE '%confusão mental%' THEN 'Grave - Confusão mental'

        WHEN situacao IN (2,7,11) AND sintomas_manifestados LIKE '%desmaio%' THEN 'Leve - Desmaio'
        WHEN situacao IN (1,6,10) AND sintomas_manifestados LIKE '%desmaio%' THEN 'Grave - Desmaio'

        WHEN situacao IN (2,7,11) AND sintomas_manifestados LIKE '%convulsão%' THEN 'Leve - Convulsão'
        WHEN situacao IN (1,6,10) AND sintomas_manifestados LIKE '%convulsão%' THEN 'Grave - Convulsão'
      END AS situacao
        , CASE WHEN cor_raca = 'Preta' THEN COUNT(pac.id) END AS preta
        , CASE WHEN cor_raca = 'Parda' THEN COUNT(pac.id) END AS parda
        , CASE WHEN cor_raca = 'Indígena' THEN COUNT(pac.id) END AS indigena
        , CASE WHEN cor_raca = 'Branca' THEN COUNT(pac.id) END AS branca
        , CASE WHEN cor_raca = 'Amarela' THEN COUNT(pac.id) END AS amarela
        , CASE WHEN cor_raca IS NULL THEN COUNT(pac.id) END AS nao_info
      FROM pacientes pac
      LEFT JOIN quadro_atual qa ON pac.id = qa.paciente_id
      GROUP BY cor_raca, sintomas_manifestados, situacao)TB
  WHERE situacao IS NOT NULL
    GROUP BY situacao
    ");
        return $sintomas_manifestados_situacao_raca_cor_4;
    }
}
