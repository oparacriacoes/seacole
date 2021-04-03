<form id="insumo_form" action="{{ route('paciente.insumos', $paciente->id) }}" method="post">
    @csrf
    <div class="form-row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="condicao_ficar_isolada">Há condição de ficar isolada, sozinha, em um cômodo da casa?</label>
                <div class="position-relative1 form-check">
                    <x-forms.input-check :model="$insumos" property="condicao_ficar_isolada" value="sim">Sim</x-forms.input-check>
                </div>
                <div class="position-relative1 form-check">
                    <x-forms.input-check :model="$insumos" property="condicao_ficar_isolada" value="não">Não</x-forms.input-check>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="tem_comida">Tem comida disponível, sem precisar sair?</label>
                <div class="position-relative1 form-check">
                    <x-forms.input-check :model="$insumos" property="tem_comida" value="sim">Sim</x-forms.input-check>
                </div>
                <div class="position-relative1 form-check">
                    <x-forms.input-check :model="$insumos" property="tem_comida" value="não">Não</x-forms.input-check>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="tem_alguem">Tem alguém para auxiliá-lo(a)?</label>
                <div class="position-relative1 form-check">
                    <x-forms.input-check :model="$insumos" property="tem_alguem" value="sim">Sim</x-forms.input-check>
                </div>
                <div class="position-relative1 form-check">
                    <x-forms.input-check :model="$insumos" property="tem_alguem" value="não">Não</x-forms.input-check>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="tarefas_autocuidado">Consegue realizar tarefas de autocuidado? (como tomar banho, cozinhar, lavar a própria roupa)</label>
                <div class="position-relative1 form-check">
                    <x-forms.input-check :model="$insumos" property="tarefas_autocuidado" value="sim">Sim</x-forms.input-check>
                </div>
                <div class="position-relative1 form-check">
                    <x-forms.input-check :model="$insumos" property="tarefas_autocuidado" value="não">Não</x-forms.input-check>
                </div>
            </div>
        </div>
    </div>

    <div class="divider"></div>

    <div class="form-row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="precisa_tipo_ajuda"><strong>Precisa de algum tipo de ajuda?</strong></label><br />
                <div class="form-check form-check-inline">
                    <input name="precisa_tipo_ajuda[]" class="form-check-input" id="comprar_remedios_continuo" type="checkbox" value="Comprar remédios de uso contínuo" <?php if ($insumos_ajuda &&  in_array('Comprar remédios de uso contínuo', $insumos_ajuda)) {
                                                                                                                                                                            echo 'checked=checked';
                                                                                                                                                                        } ?>>
                    <label class="form-check-label" for="comprar_remedios_continuo">Comprar remédios de uso contínuo</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="precisa_tipo_ajuda[]" class="form-check-input" id="comprar_remedios" type="checkbox" value="Comprar remédios para o tratamento do quadro atual" <?php if ($insumos_ajuda &&  in_array('Comprar remédios para o tratamento do quadro atual', $insumos_ajuda)) {
                                                                                                                                                                                        echo 'checked=checked';
                                                                                                                                                                                    } ?>>
                    <label class="form-check-label" for="comprar_remedios">Comprar remédios para o tratamento do quadro atual</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="precisa_tipo_ajuda[]" class="form-check-input" id="comprar_alimento" type="checkbox" value="Comprar alimento ou outro produtos de necessidade básica" <?php if ($insumos_ajuda &&  in_array('Comprar alimento ou outro produtos de necessidade básica', $insumos_ajuda)) {
                                                                                                                                                                                            echo 'checked=checked';
                                                                                                                                                                                        } ?>>
                    <label class="form-check-label" for="comprar_alimento">Comprar alimento ou outro produtos de necessidade básica</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="precisa_tipo_ajuda[]" class="form-check-input" type="checkbox" value="Outros" <?php if ($insumos_ajuda &&  in_array('Outros', $insumos_ajuda)) {
                                                                                                                    echo 'checked=checked';
                                                                                                                } ?>>
                    <label class="form-check-label" for="Outros">Outros</label>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="tratamento_prescrito"><strong>Tratamento foi prescrito por algum médico do projeto?</strong></label>
                <div class="position-relative1 form-check">
                    <x-forms.input-check :model="$insumos" property="tratamento_prescrito" value="sim">Sim</x-forms.input-check>
                </div>
                <div class="position-relative1 form-check">
                    <x-forms.input-check :model="$insumos" property="tratamento_prescrito" value="não">Não</x-forms.input-check>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="tratamento_financiado"><strong>Tratamento financiado</strong></label><br />
                <div class="form-check form-check-inline">
                    <input name="tratamento_financiado[]" class="form-check-input" id="alopatico" type="checkbox" value="Alopático (medicamentos convencionais)" <?php if ($insumos_tratamento &&  in_array('Alopático (medicamentos convencionais)', $insumos_tratamento)) {
                                                                                                                                                                        echo 'checked=checked';
                                                                                                                                                                    } ?>>
                    <label class="form-check-label" for="alopatico">Alopático (medicamentos convencionais)</label>
                </div>
                <div class="form-check form-check-inline">
                    <input name="tratamento_financiado[]" class="form-check-input" id="pics" type="checkbox" value="PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)" <?php if ($insumos_tratamento &&  in_array('PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)', $insumos_tratamento)) {
                                                                                                                                                                                            echo 'checked=checked';
                                                                                                                                                                                        } ?>>
                    <label class="form-check-label" for="febre">PICs (Práticas Integrativas Complementares - Ex: Medicina Chinesa)</label>
                </div>
            </div>
        </div>
    </div>

    <div class="divider"></div>

    <div class="form-row">
        <div class="col-md-12 mb-2">
            <strong>Foi entregue:</strong>
        </div>
        <div class="col-md-6">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Cartilha de cuidados" id="cartilha" name="material_entregue[]" <?php if ($insumos_materiais && in_array('Cartilha de cuidados', $insumos_materiais)) {
                                                                                                                                            echo 'checked=checked';
                                                                                                                                        } ?>>
                <label class="form-check-label" for="cartilha">
                    Cartilha de cuidados
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Termometro" id="termometro" name="material_entregue[]" <?php if ($insumos_materiais && in_array('Termometro', $insumos_materiais)) {
                                                                                                                                    echo 'checked=checked';
                                                                                                                                } ?>>
                <label class="form-check-label" for="termometro">
                    Termômetro
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Dipirona" id="dipirona" name="material_entregue[]" <?php if ($insumos_materiais && in_array('Dipirona', $insumos_materiais)) {
                                                                                                                                echo 'checked=checked';
                                                                                                                            } ?>>
                <label class="form-check-label" for="dipirona">
                    Dipirona
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Paracetamol" id="paracetamol" name="material_entregue[]" <?php if ($insumos_materiais && in_array('Paracetamol', $insumos_materiais)) {
                                                                                                                                    echo 'checked=checked';
                                                                                                                                } ?>>
                <label class="form-check-label" for="paracetamol">
                    Paracetamol
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Oximetro" id="oximetro" name="material_entregue[]" <?php if ($insumos_materiais && in_array('Oximetro', $insumos_materiais)) {
                                                                                                                                echo 'checked=checked';
                                                                                                                            } ?>>
                <label class="form-check-label" for="oximetro">
                    Oxímetro
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Mascaras de tecido" id="mascaras" name="material_entregue[]" <?php if ($insumos_materiais && in_array('Mascaras de tecido', $insumos_materiais)) {
                                                                                                                                        echo 'checked=checked';
                                                                                                                                    } ?>>
                <label class="form-check-label" for="mascaras">
                    Máscaras de tecido
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Material de limpeza" id="material_limpeza" name="material_entregue[]" <?php if ($insumos_materiais && in_array('Material de limpeza', $insumos_materiais)) {
                                                                                                                                                    echo 'checked=checked';
                                                                                                                                                } ?>>
                <label class="form-check-label" for="material_limpeza">
                    Material de limpeza
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Cesta basica" id="cesta_basica" name="material_entregue[]" <?php if ($insumos_materiais && in_array('Cesta basica', $insumos_materiais)) {
                                                                                                                                        echo 'checked=checked';
                                                                                                                                    } ?>>
                <label class="form-check-label" for="cesta_basica">
                    Cesta Básica
                </label>
            </div>
            <br>
            <div class="form-group">
                <label for="oximetro_devolvido"><strong>Se o caso já tiver sido encerrado: oxímetro foi devolvido?</strong></label>
                <div class="position-relative1 form-check">
                    <x-forms.input-check :model="$insumos" property="oximetro_devolvido" value="sim">Sim</x-forms.input-check>
                </div>
                <div class="position-relative1 form-check">
                    <x-forms.input-check :model="$insumos" property="oximetro_devolvido" value="não">Não</x-forms.input-check>
                </div>
            </div>
        </div>
    </div>

    <div class="position-relatives row fdorm-check">
        <div class="col-sm-12 offset-sm-2s pt-3">
            <button class="btn btn-secondary">Enviar</button>
        </div>
    </div>
</form>
