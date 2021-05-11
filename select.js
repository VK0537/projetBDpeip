var selectdivs=document.getElementsByClassName("selectdiv");
var selElmnt,newselect,b,c;
for(let i=0;i<selectdivs.length;i++){
  selElmnt=selectdivs[i].querySelector("select");
  newselect=document.createElement("div");
  newselect.setAttribute("class", "newselect");
  newselect.innerHTML=selElmnt.options[selElmnt.selectedIndex].innerHTML;
  selectdivs[i].appendChild(newselect);
  b=document.createElement("div");
  b.setAttribute("class","select-items select-hide");
  for (let j=1;j<selElmnt.length;j++){
    c=document.createElement("div");
    c.innerHTML=selElmnt.options[j].innerHTML;
    c.addEventListener("click",function(event){
        var s=this.parentNode.parentNode.querySelector("select");
        var h=this.parentNode.previousSibling;
        var y;
        for(let i=0; i<s.length; i++){
          if(s.options[i].innerHTML==this.innerHTML){
            s.selectedIndex=i;
            h.innerHTML=this.innerHTML;
            y=this.parentNode.getElementsByClassName("selected");
            for(let k=0; k<y.length; k++){
              y[k].removeAttribute("class");
            }
            this.setAttribute("class","selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  selectdivs[i].appendChild(b);
  newselect.addEventListener("click",function(event){
    event.stopPropagation();
    closeAllSelect(this);
    this.nextElementSibling.classList.toggle("select-hide");
    this.classList.toggle("select-arrow-active");
  });
}

function closeAllSelect(elmnt){
  var x,y,arrNo=[];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("newselect");

  for (let i=0; i<y.length; i++){
    if (elmnt==y[i]){
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (let i=0; i<x.length; i++){
    if (arrNo.indexOf(i)){
      x[i].classList.add("select-hide");
    }
  }
}
document.addEventListener("click", closeAllSelect); 