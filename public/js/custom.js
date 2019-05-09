function salvar(origem) {

    if(origem == 'novo'){

        document.getElementById('origem').value = 'novo';

    }else {

        document.getElementById('origem').value = 'voltar';
    }

    document.form1.submit()

}




