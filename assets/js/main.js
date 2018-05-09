function Doge(){
    alert('DOGE ALERT!!!');Array.prototype.slice.call(document.getElementsByTagName('*')).forEach(function(f){f.style.backgroundImage='url(//goo.gl/SsmE4o)';f.style.fontFamily='Comic Sans MS,Verdana,Helvetica';});
}
function IsmailBuenuel(){
//Ismail.büül
}

/**
 * Adds a class to all elements loaded on the page Try ir out with: "addUniversalClass('xD');"
 * @param string class to add
 */
function addUniversalClass(string){
        Array.prototype.slice.call(document.getElementsByTagName('*')).forEach(function(f){f.classList.add(string);});
}

/**
 * Professional HD if empty checker that works B
 * @param data to check if it is empty or not
 * @returns {boolean} true or false depending on if it is empty, or not.
 */
function empty(data)
{
    if(typeof(data) === 'number' || typeof(data) === 'boolean')
    {
        return false;
    }
    if(typeof(data) === 'undefined' || data === null)
    {
        return true;
    }
    if(typeof(data.length) !== 'undefined')
    {
        return data.length === 0;
    }
    var count = 0;
    for(var i in data)
    {
        if(data.hasOwnProperty(i))
        {
            count ++;
        }
    }
    return count === 0;
}
function customMessage(title, content, good){
    if(empty(title) || empty(content)){
        return false;
    }
    document.getElementById("alertContainer").style.display="block";
    document.getElementById("alertBoxTitle").innerHTML=title;
    document.getElementById("alertBoxContent").innerHTML=content;
    if(good===false){
        document.getElementById("alertBoxTitle").style.backgroundColor="indianred";
    }else{
        document.getElementById("alertBoxTitle").style.backgroundColor="forestgreen";
    }
    document.getElementsByTagName("body")[0].style.overflow="hidden";
}


function closeMessage(){
    document.getElementById("alertContainer").style.display="none";
    document.getElementsByTagName("body")[0].style.overflow="";
}

function readURL(input,toChange) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var a = $('#'+toChange);
        reader.onload = function (e) {
            $(a)
                .attr('src', e.target.result)
                .css('visibility','visible');
                //.width(150)
                //.height(200);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
function readURLImage(input, toChange){
    var holder = document.getElementById(toChange);
    holder.src = URL.createObjectURL(input.files[0]);
}
var readURLVideo = function(event, toChange){
    var $source = $("#"+toChange);
    $source[0].src = URL.createObjectURL(event.target.files[0]);
    $source.load();
    makeVisible(toChange);

};
function makeVisible(toChange){
    document.getElementById(toChange).style.visibility="visible";
}
function debug(){
    console.log("mynamejeffxdddddddddddd");
}










