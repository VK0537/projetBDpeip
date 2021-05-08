if(document.querySelector('#usericon')!==null && document.querySelector('#usericonhover')!==null){
    let usericon=document.querySelector('#usericon')
    usericon.addEventListener("mouseover",(event)=>{
        document.querySelector('#usericonhover').style.display='block'
    });
    usericon.addEventListener("mouseout",(event)=>{
        document.querySelector('#usericonhover').style.display='none'
    });
};
if(document.querySelector('#tips')!==null && document.querySelector('#tipshover')!==null){
    let tips=document.querySelector('#tips')
    tips.addEventListener("mouseover",(event)=>{
        document.querySelector('#tipshover').style.display='block'
    });
    tips.addEventListener("mouseout",(event)=>{
        document.querySelector('#tipshover').style.display='none'
    });
};