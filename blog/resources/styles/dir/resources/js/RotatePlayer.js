var side_1 = 1;
var side_2 = 1;
var side_3 = 1;
var side_4 = 1;
var side_5 = 1;
var side_6 = 1;
var side_7 = 1;
var side_8 = 1;
function RotatePlayer(player){
    var s1 = document.getElementById("side"+player+1);
    var s2 = document.getElementById("side"+player+2);
    var s3 = document.getElementById("side"+player+3);
    if(player == 1){
        if(side_1 == 1){
            s1.style.display = "none";
            s3.style.display = "none";
            s2.style.display = "block";
            side_1 = 2;
            console.log(side_1);
        }
        else if(side_1 == 2){
            s1.style.display = "none";
            s2.style.display = "none";
            s3.style.display = "block";
            side_1 = 3;
        }
        else if(side_1 == 3){
            s2.display = "none";
            s3.display = "none";
            s1.display = "block";
            side_1 = 1;
        }
    }
    else if(player == 2){
        if(side_2 == 1){
            s1.style.display = "none";
            s2.style.display = "block";
            s3.style.display = "none";
            side_2 = 2;
        }
        else if(side_2 == 2){
            s1.style.display = "none";
            s2.style.display = "none";
            s3.style.display = "block";
            side_2 = 3;
        }
        else{
            s1.display = "block";
            s2.display = "none";
            s3.display = "none";
            side_2 = 1;
        }
    }
    else if(player == 3){
        if(side_3 == 1){
            s1.style.display = "none";
            s2.style.display = "block";
            s3.style.display = "none";
            side_3 = 2;
        }
        else if(side_3 == 2){
            s1.style.display = "none";
            s2.style.display = "none";
            s3.style.display = "block";
            side_3 = 3;
        }
        else{
            s1.display = "block";
            s2.display = "none";
            s3.display = "none";
            side_3 = 1;
        }
    }
    else if(player == 4){
        if(side_4 == 1){
            s1.style.display = "none";
            s2.style.display = "block";
            s3.style.display = "none";
            side_4 = 2;
        }
        else if(side_4 == 2){
            s1.style.display = "none";
            s2.style.display = "none";
            s3.style.display = "block";
            side_4 = 3;
        }
        else{
            s1.display = "block";
            s2.display = "none";
            s3.display = "none";
            side_4 = 1;
        }
    }
    else if(player == 5){
        if(side_5 == 1){
            s1.style.display = "none";
            s2.style.display = "block";
            s3.style.display = "none";
            side_5 = 2;
        }
        else if(side_5 == 2){
            s1.style.display = "none";
            s2.style.display = "none";
            s3.style.display = "block";
            side_5 = 3;
        }
        else{
            s1.display = "block";
            s2.display = "none";
            s3.display = "none";
            side_5 = 1;
        }
    }
    else if(player == 6){
        if(side_6 == 1){
            s1.style.display = "none";
            s2.style.display = "block";
            s3.style.display = "none";
            side_6 = 2;
        }
        else if(side_6 == 2){
            s1.style.display = "none";
            s2.style.display = "none";
            s3.style.display = "block";
            side_6 = 3;
        }
        else{
            s1.display = "block";
            s2.display = "none";
            s3.display = "none";
            side_6 = 1;
        }
    }
    else if(player == 7){
        if(side_7 == 1){
            s1.style.display = "none";
            s2.style.display = "block";
            s3.style.display = "none";
            side_7 = 2;
        }
        else if(side_7 == 2){
            s1.style.display = "none";
            s2.style.display = "none";
            s3.style.display = "block";
            side_7 = 3;
        }
        else{
            s1.display = "block";
            s2.display = "none";
            s3.display = "none";
            side_7 = 1;
        }
    }
    else{
        if(side_8 == 1){
            s1.style.display = "none";
            s2.style.display = "block";
            s3.style.display = "none";
            side_8 = 2;
        }
        else if(side_8 == 2){
            s1.style.display = "none";
            s2.style.display = "none";
            s3.style.display = "block";
            side_8 = 3;
        }
        else{
            s1.display = "block";
            s2.display = "none";
            s3.display = "none";
            side_8 = 1;
        }
    }
} 