let canvas = document.getElementById('canvas');
canvas.width = document.documentElement.scrollWidth;
canvas.height = document.documentElement.scrollHeight;
let ctx = canvas.getContext('2d');
ctx.lineWidth = 4;
ctx.fillStyle = 'rgba(108, 108, 108, 1)';
class Random {
    constructor(min, max) {
        this.cdt = Math.floor(Math.random() * (max - min) + min);
        return this.cdt;
    }
}
let x = new Random(0, 760);
let y = new Random(0, 760);
let width = 1;
let height = 3;
function renderPointOrbit() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.beginPath();
    ctx.shadowColor = 'rgba(255, 255, 255, 0.5)';
    ctx.shadowBlur= width;
    ctx.lineWidth = width;
    ctx.strokeStyle = 'rgba(255, 255, 255, 1)';
    ctx.moveTo(x.cdt, y.cdt);
    ctx.lineTo(x.cdt + height, y.cdt);
    ctx.moveTo(x.cdt, y.cdt);
    ctx.lineTo(x.cdt - height, y.cdt);
    ctx.moveTo(x.cdt, y.cdt);
    ctx.lineTo(x.cdt, y.cdt + height);
    ctx.moveTo(x.cdt, y.cdt);
    ctx.lineTo(x.cdt, y.cdt - height);
    ctx.closePath();
    ctx.stroke();
    x.cdt += 1;
    y.cdt += 0.4;
    if (x.cdt >= canvas.width || x.cdt <= 0) {
        x.cdt = 0;
    }
    if (y.cdt >= canvas.height || y.cdt <= 0) {
        y.cdt = 0;
    }
    if (x.cdt < canvas.width / 2) {
        width += 0.02;
        height += 0.02;
    } else {
        width -= 0.015;
        height -= 0.015;
    }

    window.requestAnimationFrame(renderPointOrbit);
}
let middleX = canvas.width / 2;
let middleY = canvas.height / 2;
let radius = 80;
let randomX = new Random(middleX - radius, middleX + radius);
let randomY = new Random(middleY - radius, middleY + radius);

function renderPointFigure() {
    // (x-a)^2 + (y-b)^2 < r^2
    if (Math.pow(randomX.cdt - middleX, 2) + Math.pow(randomY.cdt - middleY, 2) < Math.pow(radius, 2)) {
        ctx.beginPath();
        ctx.lineWidth = 2;
        ctx.strokeStyle = 'rgba(255, 255, 255, 1)';
        ctx.moveTo(randomX.cdt, randomY.cdt);
        ctx.lineTo(randomX.cdt + 5, randomY.cdt);
        ctx.moveTo(randomX.cdt, randomY.cdt);
        ctx.lineTo(randomX.cdt - 5, randomY.cdt);
        ctx.moveTo(randomX.cdt, randomY.cdt);
        ctx.lineTo(randomX.cdt, randomY.cdt + 5);
        ctx.moveTo(randomX.cdt, randomY.cdt);
        ctx.lineTo(randomX.cdt, randomY.cdt - 5);
        ctx.closePath();
        ctx.stroke();
    }
    if (Math.pow(randomX.cdt, 2) > Math.pow(radius, 2) + 2 * randomX.cdt * middleX - Math.pow(middleX, 2) - Math.pow(randomY.cdt, 2) + 2 * randomY.cdt * middleY - Math.pow(middleY, 2)) {
        randomX.cdt = middleX;
    } else {
        randomX.cdt += 0.5;
    }
    window.requestAnimationFrame(renderPointFigure);
}
// R*COS/SIN(ANGLE) в координаты для движения по кругу
renderPointOrbit();
renderPointFigure();
