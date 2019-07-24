function getEventCard(params){

    params.tipo = capitalize(params.tipo)

    let inicio = addZero(new Date(params.inicioEvento).getHours());
    let fim = addZero(new Date(params.fimEvento).getHours());

    let redesSociais = '';
    Object.keys(params.redesSociais).forEach(function(rede){
        let icon;
        switch(rede){
            
            case 'facebook':
                icon = '<i title="Facebook" class="fab fa-facebook-square"></i>';
                break;
            case 'linkedin':
                icon = '<i title="Linkedin" class="fab fa-linkedin"></i>';
                break;
            case 'instagram':
                icon = '<i title="Instagram" class="fab fa-instagram"></i>';
                break;
            case 'behance':
                icon = '<i title="Behance" class="fab fa-behance-square"></i>';
                break;
            case 'twitter':
                icon = '<i title="Twitter" class="fab fa-twitter-square"></i>';
                break;
            case 'youtube':
                icon = '<i title="Youtube" class="fab fa-youtube-square"></i>';
                break;
            case 'website':
                icon = '<i title="Website" class="fas fa-globe"></i>';
                break;
            default:
                icon = '<i title="Website" class="fas fa-globe"></i>';
                break;

        }
        url = params.redesSociais[rede];
        
        icon = $(icon).attr('onclick', `window.open('${url}')`);
        icon = $('<div>').append(icon).html();

        redesSociais += icon;
    });

    return `<div class="card">

    <img id="event-fotoEvento" class="card-img-top" src="${params.fotoEvento}" alt="Card image cap">
    <div class="card-body">
        <h6 id="event-tipo">${params.tipo}</h6>
        <h4 id="event-tituloEvento" class="card-title">${params.tituloEvento}</h4>
        <h5 id="event-nomeInstrutor" class="card-title">${params.nomeInstrutor} ${params.sobrenomeInstrutor}</h5>
        
        <div class="card-text">
            <div class="scrollbar scrollbar-primary">
                <div id="event-descricaoEvento">
                ${params.descricaoEvento}
                </div>
            </div>
        </div>
        
    </div>
    <div class="card-footer">
        <div class="card-medias">
            ${redesSociais}
        </div>
        <div id="event-inicioEvento">${inicio} - ${fim}h</div>
    </div>
</div>`;
}

function getCourseCard(params){
    let inicio = addZero(new Date(params.inicioEvento).getHours());
    let fim = addZero(new Date(params.fimEvento).getHours());

    let vagasRegulares = params.vagasPadrao - params.vagasOcupadas;
    let vagasAlternativas = params.vagasAlternativas - params.vagasAlterOcupadas;

    let dataInicio = new Date(params.inicioEvento);
    let dia = addZero(dataInicio.getDate());
    let mes = addZero(dataInicio.getMonth()+1);
    dataInicio = dia + '/' + mes;

    return `<div class="card">
    <label for="evento-${params.idEvento}" class="card-overlay"></label>
    <div class="picked alert alert-success">Inscrito</div>
    <input id="evento-${params.idEvento}" class="card-checkbox" value="${params.idEvento}" type="checkbox" onchange="selectItem(event, 'minicurso')">

    <div hidden class="req-org">${params.preRequisitosOrg}</div>
    <div hidden class="req-tec">${params.preRequisitosTec}</div>

    <div class="card-body">
        <h4 id="event-tituloEvento" class="card-title">${params.tituloEvento}</h4>
        <h5 id="event-nomeInstrutor" class="card-title">${params.nomeInstrutor} ${params.sobrenomeInstrutor}</h5>
        <div class="card-text">
            <div class="scrollbar scrollbar-primary">
                <div id="event-descricaoEvento">
                    <p>${params.descricaoEvento}</p>            
                </div>
            </div>
        </div>
        
    </div>
    <div class="card-footer">
        <div class="row h-100 w-100 m-0 align-items-end">

            <div class="col-9">
                <div class="row"><button data-toggle="modal" data-target="#requisitos-modal" class="btn-requisitos btn btn-secondary">Pré-requisitos</button></div>
                <div class="row">   
                    Vagas regulares: ${vagasRegulares}
                </div>
                <div class="row">
                    Vagas alternativas: ${vagasAlternativas}
                </div>
            </div>
            <div class="col-3">
                <div class="row">
                    <div class="col-12">
                        <div class="row justify-content-end">${dataInicio}</div>
                        <div class="row justify-content-end">${inicio}-${fim}h</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>`;
}

function getShirtCard(params){
    return `<div class="card">

    <label for="camisa-${params.tituloBrinde}" class="card-overlay"></label>
    <div class="picked alert alert-success">Escolhida</div>
    <input id="camisa-${params.tituloBrinde}" class="card-checkbox" value="${params.tituloBrinde}" type="checkbox" onchange="selectItem(event, 'camisa')">
    <div class="card-img-container" style="background-image:url(http://localhost/scti/assets/imgs/shirts/shirt.jpg)">  
    </div>
    <div class="card-body">
        <h4 id="event-tituloEvento" class="card-title">${params.tituloBrinde}</h4>     
    </div>
    <div class="card-footer">
        <select name="camisa-tamanho" class="form-control">
            <option selected disabled>Escolha um tamanho</option>
            <option>pp</option>
            <option>p</option>
            <option>m</option>
            <option>g</option>
            <option>gg</option>
        </select>
    </div>
</div>`;
}