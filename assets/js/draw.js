if(getCurrentPath() == ''){

var cv = document.getElementById('drawCanvas'); //Elemento html do canvas
var c = cv.getContext('2d'); //Contexto do canvas onde os desenhos serão feitos
cv.width = cv.clientWidth;
cv.height = cv.clientHeight;
var u = (cv.width * cv.height) / 200000;


//Seção de constantes sobre o canvas
const GLOBAL_ALPHA = 0.2; //Transpacência com que todos os desenhos serão feitos no canvas, valores validos entre 0 e 1; 0 = transparente, 1 = opaco

//Seção de constantes sobre os NÓS
const NODE_SHAPE_CIRCLE = 'CIRCLE', NODE_SHAPE_SQUARE = 'SQUARE'; //Formatos possíveis para os nós
const NODE_MIN_SIZE = 1.5, NODE_MAX_SIZE = 2; //Tamanhos mínimo e máximo que o raio(CIRCULO) ou a metade do lado(QUADRADO) que o nó pode ter(aleatório);
const NODE_BORDER_WIDTH = 0.3; //Espessura em pixels da borda do nó
const NODE_MIN_SPEED = 0.1, NODE_MAX_SPEED = 0.15; //Velocidades mínima e máxima que o nos pode ter ao ser criado (aleatório)
const NODE_COLOR = 'rgb(255, 255, 255)'; //Cor dos nós em rgb
const NODE_AMOUNT = 6; //Quantidade de nós na rede Ex: (cv.width * cv.height)
const NODE_IS_FILLED = false; //Valor booleano que define se os nós terão preenchimento
const NODE_SHAPE = NODE_SHAPE_CIRCLE; //Formato do nó, valores válidos são NODE_SHAPE_CIRCLE e NODE_SHAPE_SQUARE

//Seção de constantes sobre os LINKS
const LINK_MAX_LENGTH_SQR = 10000; //Distância máxima ao quadrado para a existência de um link entre dois nós
const LINK_MIN_WEIGHT = 0.125, LINK_MAX_WEIGHT = 0.3; //Espessuras mínima e máxima do link de acordo com a proximidade dos nós
const LINK_COLOR = 'rgb(255, 255, 255)'; //Cor dos links em rgb
const LINK_WEIGHT_IS_DYNAMIC = true; //Define se a força dos links cresce quando os nós estão próximos, caso falso, os nós sempre terão espessura igual a LINK_MAX_WEIGHT
const LINK_CONECTION_SPEED = 0.1; //Velocidade de conexão e desconexão dos links em % Ex: 0.1 significa que 10% da conexão vai ser desenhada a cada frame
const LINK_CONNECTION_IS_DYMAMIC = true; //Animação da conexão sendo feita e desfeita é dinâmica ou não

//Classe que define um no da rede
class Node {
    constructor(isMouse) {
        let ang = random(0, 2 * Math.PI);
        let dx = Math.cos(ang);
        let dy = Math.sin(ang);

        this.px = random(0, cv.width);
        this.py = random(0, cv.height);
        this.spd = random(NODE_MIN_SPEED * u, NODE_MAX_SPEED * u);
        this.spdX = dx * this.spd;
        this.spdY = dy * this.spd;
        this.size = random(NODE_MIN_SIZE * u, NODE_MAX_SIZE * u);
        this.color = NODE_COLOR;
        this.isMouse = isMouse;
    }

    update() {
        if (this.isMouse) {
            this.move();
            this.display();
        }
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
        c.lineWidth = NODE_BORDER_WIDTH * u;
        c.beginPath();
        if (NODE_SHAPE == NODE_SHAPE_CIRCLE) {
            c.arc(this.px, this.py, this.size, 0, 2 * Math.PI);
        } else {
            c.rect(this.px - this.size, this.py - this.size, this.size * 2, this.size * 2);
        }
        if (!NODE_IS_FILLED) {
            c.stroke();
        } else {
            c.fill();
        }

    }
}

//Classe que define um link entre dois nós
class Link {

    constructor(n1, n2) {
        this.no1 = n1;
        this.no2 = n2;
        this.color = LINK_COLOR;
        this.size = 0;
        this.isLinked = false;
        this.isUnlinked = false;
        this.linking = true;
        this.unlinking = false;
        this.dist;
        this.wid = LINK_MAX_WEIGHT * u;

    }

    update() {
        this.dist = dist2dSqr(this.no1.px, this.no1.py, this.no2.px, this.no2.py);

        if (this.linking) {
            this.link();
        } else if (!this.unlinking) {
            this.checkLink();
        } else {
            this.unlink();
        }
        if (LINK_WEIGHT_IS_DYNAMIC) this.updateLinkWid();
        this.display();
    }

    checkLink() {
        if (this.dist > LINK_MAX_LENGTH_SQR * u) {
            this.unlinking = true;
            this.isLinked = false;
        }
    }

    updateLinkWid() {
        this.wid = map(this.dist, 0, LINK_MAX_LENGTH_SQR * u, LINK_MAX_WEIGHT * u, LINK_MIN_WEIGHT * u);
    }

    link() {
        if (LINK_CONNECTION_IS_DYMAMIC) {
            this.size += LINK_CONECTION_SPEED;
            if (this.size >= 1) {
                this.isLinked = true;
                this.linking = false;
            }
        } else {
            this.isLinked = true;
            this.linking = false;
        }
    }

    unlink() {
        if (LINK_CONNECTION_IS_DYMAMIC) {
            this.size -= LINK_CONECTION_SPEED;
            if (this.size <= 0) {
                this.size = 0;
                this.isUnlinked = true;
                this.unlinking = false;
            }
        } else {
            this.size = 0;
            this.isUnlinked = true;
            this.unlinking = false;
        }
    }

    display() {
        c.strokeStyle = this.color;
        c.lineWidth = this.wid;
        c.beginPath();
        c.moveTo(this.no1.px, this.no1.py);
        if (this.isLinked) {
            c.lineTo(this.no2.px, this.no2.py);
        } else {
            c.lineTo(this.no1.px + (this.no2.px - this.no1.px) * this.size / 2, this.no1.py + (this.no2.py - this.no1.py) * this.size / 2);
            c.moveTo(this.no2.px, this.no2.py);
            c.lineTo(this.no2.px + (this.no1.px - this.no2.px) * this.size / 2, this.no2.py + (this.no1.py - this.no2.py) * this.size / 2);
        }
        c.stroke();
    }
}

var nodes = []; //Array que guarda os nós

var mouseNode = new Node(false);

//Loop de instanciamento dos nós
for (let i = 0; i < NODE_AMOUNT * u; i++) {
    nodes[i] = new Node(true);
}

nodes.push(mouseNode);

var links = []; //Array que guarda os links

//Função que cria os links entre os nós dependendo da distância entre eles
function buildLinks() {
    for (let i = links.length - 1; i >= 0; i--) {
        if (links[i].isUnlinked) links.splice(i, 1);
    }

    for (let i = 0; i < nodes.length - 1; i++) {
        for (let j = i + 1; j < nodes.length; j++) {
            let distSqr = dist2dSqr(nodes[i].px, nodes[i].py, nodes[j].px, nodes[j].py);
            if (distSqr < LINK_MAX_LENGTH_SQR * u) {
                let linkExists = false;

                for (let k = 0; k < links.length; k++) {
                    if ((links[k].no1 == nodes[i] && links[k].no2 == nodes[j]) || (links[k].no2 == nodes[i] && links[k].no1 == nodes[j])) {
                        linkExists = true;
                        break;
                    }
                }

                if (!linkExists) links.push(new Link(nodes[i], nodes[j], map(distSqr, 0, LINK_MAX_LENGTH_SQR, 1, 0)));
            }
        }
    }

}

//Função de desenho anima a rede
function draw() {

    c.clearRect(0, 0, cv.width, cv.height);

    buildLinks();

    for (let i = 0; i < links.length; i++) {
        links[i].update();
    }

    for (let i = 0; i < nodes.length; i++) {
        nodes[i].update();
    }

    window.requestAnimationFrame(draw);
}

function resetAnimation() {
    cv.width = cv.clientWidth;
    cv.height = cv.clientHeight;
    c.globalAlpha = GLOBAL_ALPHA;
    /*u = (cv.width * cv.height) / 200000;

    nodes = [];
    for (let i = 0; i < NODE_AMOUNT * u; i++) {
        nodes[i] = new Node(true);
    }

    links = [];*/
}

window.onresize = resetAnimation; //Aplicando transparência global dos desenhos no canvas

document.getElementsByTagName("BODY")[0].addEventListener("mousemove", function (event) {
    mouseNode.px = event.clientX + document.documentElement.scrollLeft;
    mouseNode.py = event.clientY + document.documentElement.scrollTop;
});

c.globalAlpha = GLOBAL_ALPHA;
draw(); //Iniciando a animação
}