/*
 * This is a javascript file for assembly page
*/

////Validate selected parts 
//if each of head , body and foot parts is selected
function assemble(){
    var checkedItems = document.querySelectorAll('input[name="partCheckbox"]:checked');
    var numChecked = checkedItems.length;

    if(numChecked !== 3){
         alert('Select correct each of head,body and foot part');
         return;
     }

     var head,body,foot;
     for(var i=0; i<numChecked; i++){
         if(/[1]/.test(checkedItems[i].dataset.code))
             head = checkedItems[i];
         else if(/[2]/.test(checkedItems[i].dataset.code))
             body = checkedItems[i];
         else if(/[3]/.test(checkedItems[i].dataset.code))
             foot = checkedItems[i];
     }

     if(!head || !body || !foot){
         alert('Select correct each of head,body and foot part');
         return;
     }

     document.getElementById("head").src="/pix/" + head.dataset.image;
     document.getElementById("body").src="/pix/" + body.dataset.image;
     document.getElementById("foot").src="/pix/" + foot.dataset.image;

     document.getElementById("head").dataset.ca = head.dataset.ca;
     document.getElementById("body").dataset.ca = body.dataset.ca;
     document.getElementById("foot").dataset.ca = foot.dataset.ca;
     document.getElementById("head").dataset.id = head.dataset.id;
     document.getElementById("body").dataset.id = body.dataset.id;
     document.getElementById("foot").dataset.id = foot.dataset.id;

     $("#assemblingBot").show();
     $("#selectParts").hide();
}

//Cancel assembling
function cancel(){
    $("#assemblingBot").hide();
    $("#selectParts").show();
}

//Confirm assembling
//Creates input elements in the form to send post request.
function confirm(){
    var headCA = document.getElementById("head").dataset.ca;
    var bodyCA = document.getElementById("body").dataset.ca;
    var footCA = document.getElementById("foot").dataset.ca;
    var headID = document.getElementById("head").dataset.id;
    var bodyID = document.getElementById("body").dataset.id;
    var footID = document.getElementById("foot").dataset.id;

    if((headCA.substring(0, 1) == bodyCA.substring(0, 1)) 
            && (headCA.substring(0, 1) == footCA.substring(0, 1))){
        $("#assembleForm")
            .append('<input hidden name="headCA" value="' + headCA + '">')
            .append('<input hidden name="bodyCA" value="' + bodyCA + '">')
            .append('<input hidden name="footCA" value="' + footCA + '">')
            .append('<input hidden name="headID" value="' + headID + '">')
            .append('<input hidden name="bodyID" value="' + bodyID + '">')
            .append('<input hidden name="footID" value="' + footID + '">');
        return true;
    }else{
        alert('Select correct each of head,body and foot part');
        return false;
    }
}
