if(getCurrentPath() == ''){

var cv = document.getElementById("drawCanvas");
var c = cv.getContext("2d");

var NODE_COUNT = 35;
var MAX_LINK_DISTANCE_SQR;
var globalAlpha = 0.3;
var nodes, mouseNode;
var lastW = 0, lastH = 0;

class Node {
    constructor(moves) {
        this.px = random(0, cv.width);
        this.py = random(0, cv.height);
        this.radius = ((cv.width * 0.005) / 2 + (cv.height * 0.005) / 2) * random(0.9, 1.4);
        this.vx = random(-0.5, 0.5) / window.devicePixelRatio;
        this.vy = random(-0.5, 0.5) / window.devicePixelRatio;
        this.linkedTo = [];
        this.moves = moves;
    }

    move() {
        this.px += this.vx;
        this.py += this.vy;

        if (this.px < -cv.width * 0.1 || this.px > cv.width * 1.1) this.vx *= -1;
        if (this.py < -cv.height * 0.1 || this.py > cv.height * 1.1) this.vy *= -1;
    }

    display() {
        c.strokeStyle = "rgb(255, 255, 255)";
        c.lineWidth = 1;
        c.beginPath();
        c.arc(this.px, this.py, this.radius, 0, 2 * Math.PI);
        c.stroke();

        for (let i = this.linkedTo.length - 1; i >= 0; i--) {
            c.lineWidth = this.linkedTo[i].width;
            c.beginPath();
            c.moveTo(this.px, this.py);
            c.lineTo(this.linkedTo[i].node.px, this.linkedTo[i].node.py);
            c.stroke();
            if (dist2dSqr(this.px, this.py, this.linkedTo[i].node.px, this.linkedTo[i].node.py) > MAX_LINK_DISTANCE_SQR) this.linkedTo.splice(i, 1);;
        }
    }
}

function reset() {
    let newW = cv.parentElement.scrollWidth;
    let newH = cv.parentElement.scrollHeight;
    if (Math.abs(newW - lastW) > 100 || Math.abs(newH - lastH) > 100) {
        cv.width = newW;
        cv.height = newH;
        c.globalAlpha = globalAlpha;
        MAX_LINK_DISTANCE_SQR = cv.width / 10 + cv.height / 10;
        MAX_LINK_DISTANCE_SQR *= MAX_LINK_DISTANCE_SQR;
        mouseNode = new Node();

        nodes = [];
        buildNodes();

        lastW = newW;
        lastH = newH;
    }
}

function buildNodes() {
    for (let i = 0; i < NODE_COUNT; i++) {
        nodes[i] = new Node(true);
    }
}

function checkLinks() {
    for (let i = 0; i < nodes.length; i++) {
        nodes[i].linkedTo = [];
    }
    for (let i = 0; i < nodes.length; i++) {
        for (let j = i + 1; j < nodes.length; j++) {
            var distSqr = dist2dSqr(nodes[i].px, nodes[i].py, nodes[j].px, nodes[j].py);
            if (distSqr < MAX_LINK_DISTANCE_SQR) {
                nodes[i].linkedTo.push({ node: nodes[j], width: map(distSqr, 0, MAX_LINK_DISTANCE_SQR, 1, 0) });
            }
        }
        var distSqr = dist2dSqr(nodes[i].px, nodes[i].py, mouseNode.px, mouseNode.py);
        if (distSqr < MAX_LINK_DISTANCE_SQR) {
            nodes[i].linkedTo.push({ node: mouseNode, width: map(distSqr, 0, MAX_LINK_DISTANCE_SQR, 1, 0) });
        }
    }
}

function draw() {
    c.clearRect(0, 0, cv.width, cv.height);

    for (let i = 0; i < nodes.length; i++) {
        if(nodes[i].moves) nodes[i].move();
        nodes[i].display();
    }
    checkLinks();

    window.requestAnimationFrame(draw);
}

document.getElementsByTagName("BODY")[0].addEventListener("mousemove", function (event) {
    mouseNode.px = event.clientX + document.documentElement.scrollLeft;
    mouseNode.py = event.clientY + document.documentElement.scrollTop;
});

document.getElementsByTagName("BODY")[0].addEventListener("mouseup", function (event) {
    var node = new Node(true);
    node.px = event.clientX + document.documentElement.scrollLeft;
    node.py = event.clientY + document.documentElement.scrollTop;
    nodes.push(node);
});

window.onresize = reset;
reset();
draw();

}