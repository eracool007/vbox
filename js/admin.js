
document.addEventListener("DOMContentLoaded", function () {
    const textboxSection = document.getElementById("ingredient-section");
    
    const textboxOriginal = document.getElementsByClassName('ingredient');
    
    const plus = document.getElementsByClassName("circle-plus");
    const minus = document.getElementsByClassName("circle-minus");
    
    
/*
    for (var i=0; i < textboxOriginal.length; i++){
        textboxOriginal[i].querySelector('.circle-btn').addEventListener('click', function(){
           // console.log(textboxOriginal); 

            minus[i].addEventListener('click', function(){
                console.log(`just added click listener on minus ${i}`);
                textboxOriginal[i].remove();
            }); 
            

        });
    } */
    for (var i=0; i < plus.length; i++){
        plus[i].addEventListener('click', function(){
            
            addBox();
        });
    }

    for (var i=0; i < plus.length; i++){
       
        minus[i].addEventListener('click', function(){
            
           this.remove();
        });
    }
/*
    for (var i=0; i < minus.length; i++){
        minus[i].addEventListener('click', function(){
           
            this.remove();
          
                       
    }); 
    } */


    var temp = 100;

    function addBox(){
       
        var newItem = document.createElement('div');
        newItem.classList.add(`ingredient${temp}`);
        
        newItem.innerHTML=`<label for="ing[${temp}]">Ingredient:</label> <input type="text" size="75" id="ing[${temp}]" name="ing[${temp}]" value=""><div class="circle-btn id="${temp}"><div class="circle-minus"><i class="fas fa-minus-circle minus"></i></div></div>`;

        const deleteBtn = newItem.querySelector('.circle-btn');

        deleteBtn.addEventListener('click', function(){
            newItem.remove();
        });

        textboxSection.append(newItem);
        temp++;
    }   


        
});
 
//count and returns number of text boxes for ingredients

