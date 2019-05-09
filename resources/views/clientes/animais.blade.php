<div class="tab-pane active" id="Geral">

    <div class="row">

        <input type="hidden" id="id" >
        <input type="hidden" name="cliente_id" id="cliente_id" value="{{$registro->id}}">
        <input type="hidden" name="_method" id="method" value="POST">

        <div class="form-group col-md-8">
            <label for="nome" class="control-label">Nome</label>


            <input type="text" class="form-control form-control-sm" id="nome" name="nome" placeholder="Nome" required=""  value="">

        </div>
        <div class="form-group col-md-4">
            <label for="sexo" class="control-label">Sexo</label>


            <select class="form-control form-control-sm" id="sexo" name="sexo" required="" >
                <option value="Macho">Macho</option>
                <option value="Fêmea">Fêmea</option>
            </select>

        </div>


    </div>

    <div class="row">

        <div class="form-group col-md-4">
            <label for="pelagem" class="control-label">Pelagem</label>


            <input type="text" class="form-control form-control-sm" id="pelagem" name="pelagem" placeholder="Pelagem" >

        </div>
        <div class="form-group col-md-4">
            <label for="porte" class="control-label">Porte</label>


            <select class="form-control form-control-sm" id="porte" name="porte" required="" >
                <option value="Mini">Mini</option>
                <option value="Pequeno">Pequeno</option>
                <option value="Médio">Médio</option>
                <option value="Grande">Grande</option>
                <option value="Gigante">Gigante</option>
            </select>

        </div>

        <div class="form-group col-md-4">
            <label for="nascimento" class="control-label">Data Nascimento</label>


            <input type="date" class="form-control form-control-sm" id="nascimento" name="nascimento" placeholder="Data Nascimento" required="" >

        </div>

    </div>

    <div class="row">

        <div class="form-group col-md-4">
            <label for="esterilizacao_id" class="control-label">Castrado?</label>


            <select class="form-control form-control-sm" id="esterilizacao_id" name="esterilizacao_id" required="" >
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>

        </div>
        <div class="form-group col-md-4">
            <label for="especie" class="control-label dynamic">Espécie</label>


            <select class="form-control form-control-sm" id="especie" name="especie" required=""  data-dependent="raca_id" onchange="atualiza_raca()">

                <option value="">Selecione...</option>
                <option value="Felino">Felino</option>
                <option value="Canino" >Canino</option>
                <option value="Outros">Outros</option>
            </select>

        </div>
        <div class="form-group col-md-4">
            <label for="raca_id" class="control-label">Raça</label>


            <select class="form-control form-control-sm" id="raca_id" name="raca_id" required="" >

                <option value="">Selecione...</option>

            </select>

        </div>

    </div>



    <div class="row">

        <div class="form-group col-md-4">
            <label for="status" class="control-label">Status</label>




            <select class="form-control form-control-sm" id="status" name="status" required="" >
                <option value="Vivo">Vivo</option>
                <option value="Obito">Obito</option>
            </select>



        </div>
        <div class="form-group col-md-8">
            <label for="observacoes" class="control-label">Observações</label>

            <textarea  class="form-control form-control-sm" id="observacoes" name="observacoes" placeholder="Observações" ></textarea>

        </div>


    </div>


</div>
<!-- /.tab-pane -->
