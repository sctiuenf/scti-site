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
    <img id="event-fotoEvento" class="card-img-top" src="assets/imgs/events/${params.fotoEvento}" alt="Card image cap">
    <div class="card-body">
        <h6 id="event-tipo">${params.tipo}</h6>
        <h4 id="event-tituloEvento" class="card-title">${params.tituloEvento}</h5>
        <h5 id="event-nomeInstrutor" class="card-title">${params.nomeInstrutor} ${params.sobrenomeInstrutor}</h6>
        
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