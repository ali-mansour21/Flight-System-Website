let scrollCounter = 0; 
let backgroundImage= document.getElementsByClassName("hero")

const card=document.getElementById("image-card");

window.addEventListener('scroll', ()=> {
const scroll=window.scrollY
   console.log(scroll);


window.addEventListener('wheel', (event) =>{
    if (event.deltaY > 0) {
        console.log('Scrolling down');
        
        switch (scrollCounter) {
            case 0:
        let a=`<img id="" src="./../../assets/Egypt6 1.png" alt>`;
   card.innerHTML =a
   console.log("heriu")}
                break;
        
            default:
                break;
        }

//    if(scroll>0 && scroll<100 )
//    window.scrollTo(0,550)
     else if (event.deltaY < 0) {
        console.log('Scrolling up');
   window.scrollTo(0,0)

    }
}});


//    if(scroll>500 && scroll<100)
//    window.scrollTo(0,0)

   
});
