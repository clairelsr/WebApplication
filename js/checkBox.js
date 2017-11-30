function gBox(nbCheck){
    if(document.getElementById(nbCheck).checked == true){
        document.getElementById('myform').submit();
    }
    else{
        alert('Vous devez cocher la case :)');
    }
}