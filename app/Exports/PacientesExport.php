<?php

namespace App\Exports;

use App\Paciente;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class PacientesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
//        $pacientes = $pacientes->join('contacts', 'users.id', '=', 'contacts.user_id')
//        $pacientes = DB::select("SELECT P.id, PACIENTE.name AS PACIENTE, AGENTE.name AS AGENTE, MEDICO.name AS MEDICO, PSICOLOGO.name AS PSICOLOGO, P.situacao, P.data_nascimento, P.cor_raca, P.endereco_cep, P.endereco_rua,
//        P.endereco_numero, P.endereco_bairro, P.endereco_cidade, P.endereco_uf, P.ponto_referencia, P.endereco_complemento, P.fone_fixo, P.fone_celular, P.numero_pessoas_residencia, P.responsavel_residencia,
//        P.renda_residencia, P.doenca_cronica, P.outras_doencas, P.remedios_consumidos, P.acompanhamento_medico, P.isolamento_residencial, P.alimentacao_disponivel, P.auxilio_terceiros, P.tarefas_autocuidado,
//        P.teste_utilizado, P.data_teste_confirmatorio, P.caso_confirmado, P.sintomas_iniciais, AJ.tipo AS AJUDA_TIPO, DC.tipo AS DOENCA_CRONICA, EE.situacao AS ESTADO_EMOCIONAL_SITUACAO,
//        EE.medo AS ESTADO_EMOCIONAL_MEDO, ES.data_inicio_sintoma, ES.horario_sintoma, ES.sintoma_manifestado, ES.febre_temperatura_maxima, ES.data_medicao_temperatura, ES.temperatura_atual,
//        ES.cansaco_saturacao, ES.cansaco_frequencia_respiratoria, ES.pressao_arterial, I.nome_item, O.comentarios
//        FROM pacientes P
//        INNER JOIN users PACIENTE ON PACIENTE.id = P.user_id
//        LEFT JOIN agentes A ON A.id = P.agente_id LEFT JOIN users AGENTE ON AGENTE.id = A.user_id
//        LEFT JOIN medicos M ON M.id = P.medico_id LEFT JOIN users MEDICO ON MEDICO.id = M.user_id
//        LEFT JOIN psicologos PS ON PS.id = P.psicologo_id LEFT JOIN users PSICOLOGO ON PSICOLOGO.id = PS.user_id
//        LEFT JOIN ajuda_tipos AJ ON AJ.paciente_id = P.id AND AJ.id IN (SELECT MAX(id) FROM ajuda_tipos WHERE paciente_id = P.id)
//        LEFT JOIN doenca_cronicas DC ON DC.paciente_id = P.id AND DC.id IN (SELECT MAX(id) FROM doenca_cronicas WHERE paciente_id = P.id)
//        LEFT JOIN estado_emocionals EE ON EE.paciente_id = P.id AND EE.id IN (SELECT MAX(id) FROM estado_emocionals WHERE paciente_id = P.id)
//        LEFT JOIN evolucao_sintomas ES ON ES.paciente_id = P.id AND ES.id IN (SELECT MAX(id) FROM evolucao_sintomas WHERE paciente_id = P.id)
//        LEFT JOIN items I ON I.paciente_id = P.id AND I.id IN (SELECT MAX(id) FROM items WHERE paciente_id = P.id)
//        LEFT JOIN observacaos O ON O.paciente_id = P.id AND O.id IN (SELECT MAX(id) FROM observacaos WHERE paciente_id = P.id)
//        ORDER BY P.id;");
//        return $pacientes;
        return Paciente::all();
    }
}
