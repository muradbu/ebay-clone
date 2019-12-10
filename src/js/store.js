var data = [];

function getId(str)
{
    return str.replace('product','');
}
function existingIDs()
{
    let response = [];
    var all = $("h5[id^='product']").each(function()
    {
        response.push(getId($(this)[0].id));
    });   
    return response
}
var exsistInArray;

function check(seconditem)
{
    if(data.includes(seconditem)){
        exsistInArray = true;        
    }
    else{
        data.push(seconditem);
         exsistInArray = false;        
    }
}


