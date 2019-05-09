function toInvert(str) {
    var x = str.length;
    var invertStr = "";
    
    while (x>=0) {
        invertStr = invertStr + str.charAt(x);
        x--;
    }
    return invertStr;
}
    
function getAllPosibilities(name, path){
    var allPath = new Array();
    var bool = true;
    var concatPath = "";
    var sizePath = path.lastIndexOf(name);
    while(bool){
        var finalPath;
        var pos = path.indexOf(name);
        var invertPath = toInvert(path);
        var posIn = invertPath.lastIndexOf(toInvert(name));
        var initialPath = path.substring(0, pos) + name;
    		
        finalPath = concatPath + initialPath;
        var newPath = toInvert(invertPath.substring(0, posIn));

        //console.log(initialPath + " ------------ " + newPath + " -------------- " + concatPath +" -------- " + finalPath);
    		
        path = newPath;
        concatPath = finalPath;
        if(sizePath === finalPath.lastIndexOf(name)){
            bool = false;
        } 
        //console.log(sizePath + " / " +finalPath.length)
        allPath.push(finalPath);
    }
    //console.log(cadenas);
    return allPath;
}