var selectdivs, l, ll, selElmnt, newselect, b, c;
selectdivs = document.getElementsByClassName("selectdiv");
l = selectdivs.length;
for (let i = 0; i < l; i++) {
  selElmnt = selectdivs[i].querySelector("select");
  ll = selElmnt.length;
  newselect = document.createElement("DIV");
  newselect.setAttribute("class", "newselect");
  newselect.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  selectdivs[i].appendChild(newselect);
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (let j = 1; j < ll; j++) {
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        var y, s, h, sl, yl;
        s = this.parentNode.parentNode.querySelector("select");
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (let i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("selected");
            yl = y.length;
            for (let k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  selectdivs[i].appendChild(b);
  newselect.addEventListener("click", function(e) {
    e.stopPropagation();
    closeAllSelect(this);
    this.nextSibling.classList.toggle("select-hide");
    this.classList.toggle("select-arrow-active");
  });
}

function closeAllSelect(elmnt) {
  var x, y, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("newselect");
  xl = x.length;
  yl = y.length;
  for (let i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (let i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}

document.addEventListener("click", closeAllSelect); 