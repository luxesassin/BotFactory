/*
 * This is a javascript file for assembly page
*/

// Validate selected parts 
// if each of head , body and foot parts is selected
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

     document.getElementById("head").dataset.code = head.dataset.code;
     document.getElementById("body").dataset.code = body.dataset.code;
     document.getElementById("foot").dataset.code = foot.dataset.code;
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
    var headCode = document.getElementById("head").dataset.code;
    var bodyCode = document.getElementById("body").dataset.code;
    var footCode = document.getElementById("foot").dataset.code;
    var headID = document.getElementById("head").dataset.id;
    var bodyID = document.getElementById("body").dataset.id;
    var footID = document.getElementById("foot").dataset.id;

    $("#assembleForm")
        .append('<input hidden name="headCode" value="' + headCode + '">')
        .append('<input hidden name="bodyCode" value="' + bodyCode + '">')
        .append('<input hidden name="footCode" value="' + footCode + '">')
        .append('<input hidden name="headID" value="' + headID + '">')
        .append('<input hidden name="bodyID" value="' + bodyID + '">')
        .append('<input hidden name="footID" value="' + footID + '">');
    return true;
   
}
