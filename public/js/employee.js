let addButton = document.getElementById("addButton");
let EmployeeDataContainer = document.getElementById("EmployeeDataContainer");

const ValorInicial = addButton.innerHTML;

addButton.addEventListener("click", (e) => {
    
    if(addButton.innerHTML == ValorInicial){

        addButton.innerHTML = "Close Option";
    
        addButton.classList.add("bg-red-500");
    
        addButton.classList.remove("bg-yellow-500");
        addButton.classList.remove("hover:bg-yellow-300");
        addButton.classList.add("hover:bg-red-100");

        EmployeeDataContainer.classList.remove('hidden');
        EmployeeDataContainer.classList.add('grid');


    }else{

        addButton.innerHTML = ValorInicial

        addButton.classList.remove("bg-red-500");
    
        addButton.classList.add("bg-yellow-500");
        addButton.classList.add("hover:bg-yellow-300");
        addButton.classList.remove("hover:bg-red-100");
        EmployeeDataContainer.classList.add('hidden');
        EmployeeDataContainer.classList.remove('grid');

    }



});

function showEditEmployee(event){

    let showEditContainer = document.getElementById('editEmployee - '+ event.target.value)

    showEditContainer.classList.toggle('hidden')

}


