
document.addEventListener("DOMContentLoaded", function () {
    const textboxSection = document.getElementById("ingredient-section");
    
    const textboxOriginal = document.getElementsByClassName('ingredient');
    
    const plus = document.getElementsByClassName("circle-plus");
    const minus = document.getElementsByClassName("circle-minus");
    
    for (var i=0; i < plus.length; i++){
        plus[i].addEventListener('click', function(){
            
            addBox();
        });
    }

    for(let i=0; i<document.querySelectorAll(".circle-minus").length; i++){
        document.querySelectorAll(".circle-minus")[i].addEventListener('click', function(){
            var thisParent = this.closest('.ingredient');
            thisParent.remove();
        });
    }
    
    var temp = 100;

    function addBox(){
       
        var newItem = document.createElement('div');
        newItem.classList.add(`ingredient`);
        
        newItem.innerHTML=`<label for="ing[${temp}]">Ingredient:</label> <input type="text" size="75" id="ing[${temp}]" name="ing[${temp}]" value=""><div class="circle-btn" id="${temp}"><div class="circle-minus">&nbsp;<i class="fas fa-minus-circle minus"></i></div></div>`;

        const deleteBtn = newItem.querySelector('.circle-btn');

        deleteBtn.addEventListener('click', function(){
            newItem.remove();
        });

        textboxSection.append(newItem);
        temp++;
    }   
});