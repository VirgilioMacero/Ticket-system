let addButton = document.getElementById('addButton');
let ServiceDataContainer = document.getElementById('ServiceDataContainer');
const firstValue = addButton.innerHTML


addButton.addEventListener('click',(e)=>{


    if(addButton.innerHTML == firstValue){

        addButton.innerHTML = "Close Option";
    
        addButton.classList.add("bg-red-500");
    
        addButton.classList.remove("bg-yellow-500");
        addButton.classList.remove("hover:bg-yellow-300");
        addButton.classList.add("hover:bg-red-100");

        ServiceDataContainer.classList.remove('hidden')
        ServiceDataContainer.classList.add('grid')


    }
    else{

        addButton.innerHTML = firstValue

        addButton.classList.remove("bg-red-500");
    
        addButton.classList.add("bg-yellow-500");
        addButton.classList.add("hover:bg-yellow-300");
        addButton.classList.remove("hover:bg-red-100");
        ServiceDataContainer.classList.add('hidden')
        ServiceDataContainer.classList.remove('grid')


    }


})




