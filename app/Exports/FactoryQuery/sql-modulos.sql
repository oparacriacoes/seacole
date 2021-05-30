-- modulo para saude_mentals
case
    when sd.quadro_atual is true then 'Sim'
    when sd.quadro_atual is false then 'Não'
    else 'Não Informado'
end as quadro_atual,
sd.detalhes_medos

left join saude_mentals sd on sd.paciente_id = p.id

-- modulo para servicos referencia