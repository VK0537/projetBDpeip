if (document.querySelector(".ball") != null) {
  var ball = document.querySelector(".ball");
  var container = document.querySelector("#container");
  var colors = [
    "rgb(255, 0, 0)",
    "rgb(0, 255, 255)",
    "rgb(0, 255, 0)",
    "rgb(255, 0, 255)",
    "rgb(0, 0, 255)",
    "rgb(255, 255, 0)"
  ];
  var s = ball.getAttribute("speed") != null ? ball.getAttribute("speed") : 10;
  var v, w, x, y;
  v = w = 1;
  x = slc(ball.style.left);
  y = slc(ball.style.top);
  var inter = setInterval(function () {
    if (x === 0 || x === container.clientWidth - ball.offsetWidth) {
      v = -v;
      col();
    }
    if (y === 0 || y === container.clientHeight - ball.offsetHeight) {
      w = -w;
      col();
    }
    x += v;
    y += w;
    ball.style.left = x + "px";
    ball.style.top = y + "px";
  }, s);
}
function slc(a) {
  return parseInt(a.slice(0, -2));
}
function col() {
  let c = ball.style.color;
  ball.style.color = colors[(colors.indexOf(c) + 1) % colors.length];
}
