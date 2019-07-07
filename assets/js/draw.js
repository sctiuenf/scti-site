var cv = document.getElementById('drawCanvas'); //Elemento html do canvas
var c = cv.getContext('2d'); //Contexto do canvas onde os desenhos serão feitos
cv.width = cv.clientWidth;
cv.height = cv.clientHeight;


//Seção de constantes sobre o canvas
const UPDATE_WAIT = 10; //Espera por atualização do canvas em milisegundos
const GLOBAL_ALPHA = 0.2; //Transpacência com que todos os desenhos serão feitos no canvas, valores validos entre 0 e 1; 0 = transparente, 1 = opaco

//Seção de constantes sobre os NÓS
const NODE_MIN_RADIUS = 4, NODE_MAX_RADIUS = 8; //Tamanhos mínimo e máximo que os nós podem ter quando criádos (aleatório)
const NODE_MIN_SPEED = 0.2, NODE_MAX_SPEED = 1; //Velocidades mínima e máxima que o nos pode ter ao ser criado (aleatório)
const NODE_COLOR = 'rgb(255, 255, 255)'; //Cor dos nós em rgb
const NODE_AMOUNT = (cv.width * cv.height) / 10000; //Quantidade de nós na rede Ex: (cv.width * cv.height) / 10000 resulta em 1 nó por 10 mil de área do canvas
const NODE_IS_FILLED = false; //Valor booleano que define se os nós terão preenchimento

//Seção de constantes sobre os LINKS
const LINK_MAX_LENGTH_SQR = 14400; //Distância máxima ao quadrado para a existência de um link entre dois nós
const LINK_MIN_WEIGHT = 0, LINK_MAX_WEIGHT = 2; //Espessuras mínima e máxima do link de acordo com a proximidade dos nós
const LINK_COLOR = 'rgb(255, 255, 255)'; //Cor dos links em rgb
const LINK_WEIGHT_IS_DINAMIC = true; //Define se a força dos links cresce quando os nós estão próximos, caso falso, os nós sempre terão espessura igual a LINK_MAX_WEIGHT

//Classe que define um no da rede
class Node {
    constructor() {
        let ang = random(0, 2 * Math.PI);
        let dx = Math.cos(ang);
        let dy = Math.sin(ang);

        this.px = random(0, cv.width);
        this.py = random(0, cv.height);
        this.spd = random(NODE_MIN_SPEED, NODE_MAX_SPEED);
        this.spdX = dx * this.spd;
        this.spdY = dy * this.spd;
        this.radius = random(NODE_MIN_RADIUS, NODE_MAX_RADIUS);
        this.color = NODE_COLOR;
    }

    update() {
        this.move();
        this.display();
    }

    move() {
        this.px += this.spdX;
        if (this.px < 0 || this.px > cv.width) this.spdX *= -1;

        this.py += this.spdY;
        if (this.py < 0 || this.py > cv.height) this.spdY *= -1;
    }

    display() {
        if (!NODE_IS_FILLED) { 
            c.strokeStyle = this.color; 
        } else { 
            c.fillStyle = this.color;
        }
        c.lineWidth = 1.5;
        c.beginPath();
        c.arc(this.px, this.py, this.radius, 0, 2 * Math.PI);
        if(!NODE_IS_FILLED){
            c.stroke();
        } else {
            c.fill();
        }
        
    }
}

//Classe que define um link entre dois nós
class Link {

    constructor(n1, n2, strength) {
        this.no1 = n1;
        this.no2 = n2;
        this.color = LINK_COLOR;
        if(LINK_WEIGHT_IS_DINAMIC){
            this.wid = map(strength, 0, 1, LINK_MIN_WEIGHT, LINK_MAX_WEIGHT);
        } else {
            this.wid = LINK_MAX_WEIGHT;
        }
        
    }

    display() {
        c.strokeStyle = this.color;
        c.lineWidth = this.wid;
        c.beginPath();
        c.moveTo(this.no1.px, this.no1.py);
        c.lineTo(this.no2.px, this.no2.py);
        c.stroke();
    }
}

var nodes = []; //Array que guarda os nós

//Loop de instanciamento dos nós
for (let i = 0; i < NODE_AMOUNT; i++) {
    nodes[i] = new Node();
}

var links = []; //Array que guarda os links

//Função que cria os links entre os nós dependendo da distância entre eles
function buildLinks() {
    let newLinks = []
    for (let i = 0; i < nodes.length - 1; i++) {
        for (let j = i + 1; j < nodes.length; j++) {
            let distSqr = dist2dSqr(nodes[i].px, nodes[i].py, nodes[j].px, nodes[j].py);
            if (distSqr < LINK_MAX_LENGTH_SQR) {
                newLinks.push(new Link(nodes[i], nodes[j], map(distSqr, 0, LINK_MAX_LENGTH_SQR, 1, 0)));
            }
        }
    }

    return newLinks;
}

//Função de desenho anima a rede
function draw() {
    c.clearRect(0, 0, cv.width, cv.height);

    links = buildLinks();

    for (let i = 0; i < links.length; i++) {
        links[i].display();
    }

    for (let i = 0; i < nodes.length; i++) {
        nodes[i].update();
    }

    setTimeout(draw, UPDATE_WAIT);
}

c.globalAlpha = GLOBAL_ALPHA; //Aplicando transparência global dos desenhos no canvas
draw(); //Iniciando a animação