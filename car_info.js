"use strict";

var xmlPath = "./cars.xml" 
var tags = ["pid", "make", "model", "trim", "color", "year",
            "odo", "gearbox", "engine", "price", "location", 
            "description"]
var info;

//initialize the car info page on load
function init()
{
    let pid = getPID();
    let resp = getXML(xmlPath);
    let car = getCar(resp, pid);
    info = initInfoDict(car);
    let imgPaths = getImagePaths();
    insertImages(imgPaths);
    insertDescriptions();    
}

//Extracts the pid from the url
const getPID = ()=> 
{
    let query = window.location.search.substring(1);
    let query_list = query.split("&");
    for (var i = 0; i < query_list.length; ++i)  
    {
        let kv = query_list[i].split("=");
        if (kv[0] == "pid")
        {
            return kv[1];
        }
    }
    return -1;  
}

//Gets the XML response object
const getXML = (path) =>
{
    let request = new XMLHttpRequest();
    request.open("GET", xmlPath, false);
    request.send();
    return request.responseXML;
}

//Retrieve the specific car from the XML response using the pid
const getCar = (resp, pid) =>
{
    let pids = resp.getElementsByTagName("pid");
    for(var item of pids)   
    {
        //the firstChild property gets id from element <pid>id<pid>, it returns an object
        //using the nodeValue property will return a string
        if(item.firstChild.nodeValue == pid)
        {
            //returns the parent car node of the matching pid
            return item.parentNode;
        }
    }
}

//getting specific information, indicated by the tag, of a given car. 
const getCarInfo = (car, tag) =>
{
    return car.getElementsByTagName(tag)[0].firstChild.nodeValue;
}

//initialize the dictionary of car info
const initInfoDict = (car) =>
{  
    var dict = {};
    for(var tag of tags)
    {
        dict[tag] = getCarInfo(car, tag);
    }
    dict["category"] = car.parentNode.tagName;
    return dict;
}

const getImagePaths = () =>
{
    var paths = [];
    for(var i = 1; i <= 3; ++i)
    {
        paths.push("./img/" + info["category"] + "/" + info["pid"] + "/" + i + ".jpg");
    }
    return paths;   
}

const insertImages = (paths) =>
{
    var imgsDiv = document.getElementsByClassName("images")[0];
    for(const path of paths)
    {
        imgsDiv.innerHTML += "<img src=" + path + " width=350 height=350>";
    } 
}

const insertDescriptions = () =>
{
    var desDiv = document.getElementById("description_table");
    desDiv.innerHTML += "<thead><tr><th colspan=\"2\">Specifications</th></tr></thead> <tbody>";

    for(var i = 1; i < tags.length; ++i)
    {
        let tagName = tags[i].replace(/^./,tags[i][0].toUpperCase());
        desDiv.innerHTML += "<tr><td>" + tagName + "</td>" + "<td>" + info[tags[i]] + "</td>" + "</tr>";
    }
    desDiv.innerHTML += "</tbody>";

}

const orderNowOnClick = () =>
{
    window.open("./checkout.html?make=" + info["make"] + "&model=" + info["model"] + "&trim=" + info["trim"]);
}