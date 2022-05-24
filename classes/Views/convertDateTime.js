function convertDateTime(datetime){
    let inicioDate = new Date(datetime);
    var tzoffset = (new Date()).getTimezoneOffset() * 60000; 
    var localISOTime = (new Date(inicioDate - tzoffset)).toISOString().slice(0, 19);

    return localISOTime;
}