function FormatNumber(id1,id2)
{
    document.getElementById(id2).value = FormatNumberBy3(document.getElementById(id1).value);
}
function FormatNumberBy3(num, decpoint, sep) {
    // check for missing parameters and use defaults if so
    if (arguments.length == 2) {
        sep = ",";
    }
    if (arguments.length == 1) {
        sep = ",";
        decpoint = ".";
    }
    // need a string for operations
    num = num.toString();
    // separate the whole number and the fraction if possible
    a = num.split(decpoint);
    x = a[0]; // decimal
    y = a[1]; // fraction
    z = "";


    if (typeof(x) != "undefined") {
        // reverse the digits. regexp works from left to right.
        for (i=x.length-1;i>=0;i--)
            z += x.charAt(i);
        // add seperators. but undo the trailing one, if there
        z = z.replace(/(\d{3})/g, "$1" + sep);
        if (z.slice(-sep.length) == sep)
            z = z.slice(0, -sep.length);
        x = "";
        // reverse again to get back the number
        for (i=z.length-1;i>=0;i--)
            x += z.charAt(i);
        // add the fraction back in, if it was there
        if (typeof(y) != "undefined" && y.length > 0)
            x += decpoint + y;
    }
    return x;
}