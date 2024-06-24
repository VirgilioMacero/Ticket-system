// Show or Hide The Create of new Service - Area

let addButton = document.getElementById('addButton')

let addAreaNameContainer = document.getElementById('addAreaNameContainer')

const addButtonContent = addButton.innerHTML

addButton.addEventListener('click',(e)=>{

if(addButton.innerHTML == addButtonContent){

    addButton.innerHTML = "Close Option";
    
    addButton.classList.add("bg-red-500");

    addButton.classList.remove("bg-yellow-500");
    addButton.classList.remove("hover:bg-yellow-300");
    addButton.classList.add("hover:bg-red-100");

    addAreaNameContainer.classList.remove('hidden')

}
else{

    addButton.innerHTML = addButtonContent

    addButton.classList.remove("bg-red-500");

    addButton.classList.add("bg-yellow-500");
    addButton.classList.add("hover:bg-yellow-300");
    addButton.classList.remove("hover:bg-red-100");
    addAreaNameContainer.classList.add('hidden')

}


})

// Show or Hide The Update of Service - Areas

    const labelsClickable = document.querySelectorAll('.label-clickable')

    labelsClickable.forEach((label)=>{

        label.addEventListener('click',()=>{

           const areaId = label.getAttribute('id')

           if(areaId){

            showUpdate(areaId)

           }

        })


    })

   function  showUpdate(areaId){


       let EditAreaNameContainer = document.getElementById('EditAreaNameContainer-'+areaId)

       EditAreaNameContainer.classList.toggle('hidden')

   }










