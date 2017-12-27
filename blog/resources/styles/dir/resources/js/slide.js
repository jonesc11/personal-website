var curr_slide;
var sec = 0;
var slidenum = 1;
var slidesw = setInterval(switchslide,1000);
function slide1(){
    curr_slide = document.getElementById("slide"+slidenum);
    curr_slide.style.opacity = "0";
    curr_slide.style.display = "none";
    slidenum = 1;
    curr_slide = document.getElementById("slide"+slidenum);
    curr_slide.style.display = "block";
    curr_slide.style.opacity = "1";
    sec = 0;
}
function slide2(){
    curr_slide = document.getElementById("slide"+slidenum);
    curr_slide.style.opacity = "0";
    curr_slide.style.display = "none";
    slidenum = 2;
    curr_slide = document.getElementById("slide"+slidenum);
    curr_slide.style.display = "block";
    curr_slide.style.opacity = "1";
    sec = 0;
}
function slide3(){
    curr_slide = document.getElementById("slide"+slidenum);
    curr_slide.style.opacity = "0";
    curr_slide.style.display = "none";
    slidenum = 3;
    curr_slide = document.getElementById("slide"+slidenum);
    curr_slide.style.display = "block";
    curr_slide.style.opacity = "1";
    sec = 0;
}
function slide4(){
    curr_slide = document.getElementById("slide"+slidenum);
    curr_slide.style.opacity = "0";
    curr_slide.style.display = "none";
    slidenum = 4;
    curr_slide = document.getElementById("slide"+slidenum);
    curr_slide.style.display = "block";
    curr_slide.style.opacity = "1";
    sec =  0;
}
function slide5(){
    curr_slide = document.getElementById("slide"+slidenum);
    curr_slide.style.opacity = "0";
    curr_slide.style.display = "none";
    slidenum = 5;
    curr_slide = document.getElementById("slide"+slidenum);
    curr_slide.style.display = "block";
    curr_slide.style.opacity = "1";
    sec = 0;
}

function switchslide(){
    sec++;
    console.log("sec: ",sec);
    if(sec > 5){
        if(slidenum == 1){
            slide2();   
        }
        else if(slidenum == 2){
            slide3()
        }
        else if(slidenum == 3){
            slide4();
        }
        else if(slidenum == 4){
            slide5();
        }
        else{
            slide1();
        }
    }
}