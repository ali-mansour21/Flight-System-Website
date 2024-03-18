let scrollCounter = 0; 
let backgroundImage= document.getElementsByClassName("hero")

const handleScroll=()=> {
    let a=`<img id="" src="./../../assets/Egypt6 1.png" alt>`
   backgroundImage.innerHTML=a
   console.log("heriu")
}

// Add scroll event listener
window.addEventListener('scroll', ()=> {
    let a=`<img id="" src="./../../assets/Egypt6 1.png" alt>`
   backgroundImage.innerHTML=a
   console.log("heriu")}
   );
