
// ** 1. All Questions **

var questions = [
 ["Are they..?", "Male", "Female", "whocares"],
 ["How old are they ", "under 16", "16 to 34", " 35 to 50", "51 to 69 ", "over 70"],
 ["What is their top priority? Their ...", "face", "body", "mind", "stomach", "hair" ,"lets have some fun", "help I dont know"],
 ["Come on , level with us what does Anna really need this christmas ", "to save the planet ", "to kick back and relax ", "to be the clostest kid in school", "to prepare for that maraton ", "to party party ", "a romantic night in "],
 ["its the million-dollar question -how geberous are you feeling? ", "£10 and under", "£20 and under", " £50 and under", "oh hey , big spender ! "],
];


//  ** 1. End All Questions 

// ** 2. All variables **
var quiz = document.getElementById("quiz");
var ques = document.getElementById("question");
var res = document.getElementById("result");
var nextbutton = document.querySelector(".giftfinder__next");
var q = document.getElementById('quit');
var progressvalue = document.getElementById('progress-value');
var totalanswered = document.getElementById("total-answered");
var progress = document.querySelector(".progress");
var progressarrowback = document.querySelector(".progress-arrow-back");
var tques = questions.length;
var score = 0;
var quesindex = 0;
var quesindexfirstload = quesindex + 1;
progressarrowback.style.display = "none";
showindex = quesindex;

// 2. End All variables 
// 3. ** On load  **
document.querySelector(".progress-bar").style.display = "none";
// 3. ** End  On load  **

// 4. ** ALL FUNCTIONS  **

// a . ** First Next Ques  **
function firstnextques() {
    var enternameval = document.querySelector(".enter-name").value;
    var qnc = document.querySelector(".question-name-container");
    var wqn = document.querySelector(".wrap-questions-name");
    var questionContainer = document.querySelector(".wrap-questions");
    if (enternameval !== null && enternameval !== '') {
        wqn.style.display = "none";
        questionContainer.style.display = "block";
        progressarrowback.style.display = "block";
    } else {
        alert("ENTER YOUR NAME ");
    }

    $(".progress-arrow-back").click(function() {

        if (showindex == 0) {
            $(".wrap-questions").css("display", "none");
            $(".wrap-questions-name ").css("display", "block");
        }
    });

}

// a . ** End First Next Ques  **
// b . ** Prev Ques  **


function prevques() {
    var selected_ans = document.querySelector('input[type=radio]:checked');
    showindex = quesindex;
    console.log(showindex);
    console.log(selected_ans);
    questions[quesindex][5]
    var obtained = showindex - 1;
    var total = tques;
    var percent = obtained * 100 / total;
    progress.style.width = percent + "%";
    progress.style.background = "blue";

    if (quesindex > 1) {
        var str = quesindex + "/" + tques;
        $('.progress-bar').css("display", "block");
        $(".total-answered").html(str)
        progressvalue.innerHTML = quesindex + "/" + questions.length;
        console.log("indexsss");
        progressarrowback.style.display = "block";
        document.querySelector(".progress-bar").style.display = "block";
        $('.progress-value').css("display", "block");
        $('.progress-bar').css("display", "block");
    }

    if (quesindex == 1) {
        $('.progress-bar').css("display", "none");
        $('.progress-value').css("display", "block");
        $('.total-answered').html('Hello World');
        var str = "1/" + tques;
        progressvalue.innerHTML = quesindex + "/" + questions.length;
        $(".total-answered").html(str);

    }

    if (quesindex == 0) {
        $('.progress-bar').css("display", "none");
        $('.progress-value').css("display", "none");
        $('.total-answered').html('Hello World');
        var str = "1/" + tques;
        progressarrowback.style.display = "none";
        $(".total-answered").html('');
        console.log("indexsssssss");
        progressvalue.innerHTML = '';
    }


    if (percent > 0)
        $('.progress-bar').css("display", "block");

    if (showindex !== 0) {
        quesindex--;
    }
    give_ques(quesindex);

}

// b . ** End  Prev Ques  **


// c . ** quit function  **
function quit() {
    quiz.style.display = 'none';
    result.style.display = '';
    var f = score / tques;
    var fn = tques;
    result.textContent = "SCORE =" + f * 100;
    q.style.display = "none";
}
// c . ** End quit function  **


// d . ** Give questions   **

function give_ques(quesindex) {

    ques.textContent = quesindex + 1 + ". " + questions[quesindex][0];
    var string = ques.textContent;
    substring = "priority";
    var ee = string.includes(substring);


    if (ee == true) {
        $('.question').addClass('priority');
        $('.priority').each(function() {
            $(this).siblings(".wrap-checkboxes").addClass("wrap-checkboxes-count");
        });

    } else {
        $('.question').removeClass('priority');
    }


    for (var key in questions) {
        var value = questions[key];
        var position = key;
        var pp = 1;
        //  for(var i=1; i < value.length; i++) {
        for (var i = 1; i <= 11; i++) {

            if (questions[quesindex][pp] && questions[quesindex][pp] != '') {

                if (questions[quesindex][pp] == 'under 16') {
                    emoji = '<span class="checkbox-emoji">👶</span>';

                } else if (questions[quesindex][pp] == 'over 70') {
                    emoji = '<span class="checkbox-emoji">👵</span>';

                } else if (questions[quesindex][pp] == 'face') {
                    emoji = '<span class="checkbox-emoji">💆</span>';

                } else if (questions[quesindex][pp] == 'body') {

                    emoji = '<span class="checkbox-emoji">💪</span>';
                } else if (questions[quesindex][pp] == 'mind') {

                    emoji = '<span class="checkbox-emoji">🧠</span>';
                } else if (questions[quesindex][pp] == 'stomach') {

                    emoji = '<span class="checkbox-emoji">🍽️</span>';
                } else if (questions[quesindex][pp] == 'hair') {

                    emoji = '<span class="checkbox-emoji">💇</span>';
                } else if (questions[quesindex][pp] == 'lets have some fun') {

                    emoji = '<span class="checkbox-emoji fun">🎉</span>';

                    $('.fun').parent().parent().addClass("addTitle");
                } else if (questions[quesindex][pp] == 'help I dont know') {

                    emoji = '<span class="checkbox-emoji">🤷‍♂️</span>';
                } else if (questions[quesindex][pp] == 'to save the planet ') {

                    emoji = '<span class="checkbox-emoji">🌍</span> <input class="hideenValue" name="prodId" type="hidden" value="vegan">';

                } else if (questions[quesindex][pp] == 'to kick back and relax ') {

                    emoji = '<span class="checkbox-emoji">🛀</span> <input class="hideenValue" name="prodId" type="hidden" value="vegan">';

                } else if (questions[quesindex][pp] == 'to be the clostest kid in school') {

                    emoji = '<span class="checkbox-emoji">😎</span> <input class="hideenValue" name="prodId" type="hidden" value="vegan">';

                } else if (questions[quesindex][pp] == 'to prepare for that maraton ') {

                    emoji = '<span class="checkbox-emoji">🏃‍</span> <input class="hideenValue" name="prodId" type="hidden" value="vegan">';

                } else if (questions[quesindex][pp] == 'to party party ') {

                    emoji = '<span class="checkbox-emoji">💃</span> <input class="hideenValue" name="prodId" type="hidden" value="vegan">';

                } else if (questions[quesindex][pp] == 'a romantic night in ') {

                    emoji = '<span class="checkbox-emoji">💖</span> <input class="hideenValue" name="prodId" type="hidden" value="vegan">';

                } else {
                    emoji = '';
                }

                 document.getElementById("option"+pp).innerHTML = emoji+'<span class="real">'+questions[quesindex][pp]+'<span>';
                document.getElementById("option" + pp).parentNode.style.display = "";

            } else {
                document.getElementById("option" + pp).parentNode.style.display = "none";
            }
            var x = document.querySelectorAll(".labelCheck").innerHTML;
            pp++;

        }
    }
    return; // body...
};


// d . ** End Give questions   **

// e  . ** generic Load function   **

$(document).ready(function() {

    $('.giftfinder__next').click(function() {

        $('.struggling').css("display", "none");

        $('.wrap-checkboxes-count label').each(function() {

            //$(this).find(".checkbox-label span").hasClass("fun");

            if ($(this).find(".checkbox-label span").hasClass('fun')) {
                $(".fun").parent().parent().prepend('<h2 class ="struggling">Struggling</h2>');
                $(".struggling").insertBefore(".addTitle");
            } else {

            }

        });


    });

    $('.progress-arrow-back').click(function() {
        $('.wrap-checkboxes h2').each(function() {
            $('.wrap-checkboxes h2').remove();
        });

        $('.wrap-checkboxes label').each(function() {
            if ($(this).find(".checkbox-label span").hasClass('fun')) {
                $(".fun").parent().parent().prepend('<h2 class ="struggling">Struggling</h2>');

                if ($(this).css('display') == 'none') {
                    //do something
                } else {
                    $(".struggling").insertBefore(".addTitle");
                }
            } else {}

        });
    });

    $('.giftfinderfirst__next').click(function() {

        if (quesindex == 0) {
            var str = "1/" + tques;

            progressvalue.innerHTML = str;

        }
    });

});
// e  . ** end  generic Load function   **

// f  . ** function Next qustions   **

var sendinfo = [];
give_ques(0);


function nextques() {
    var selected_ans = document.querySelector('input[type=radio]:checked');

    if (!selected_ans) {
        alert("SELECT AN OPTION");
        return;
    }
    var selected_ansval = document.querySelector('input[type=radio]:checked').value;
    //var nextSibling = selected_ans.nextSibling.innerHTML;
    var nextSibling = document.getElementById("option" + selected_ansval).innerHTML;

    if (selected_ans.value == questions[quesindex][5]) {
        score = score + 1;
    }
    selected_ans.checked = false;
    showindex = quesindex + 1;
    showindexIn = showindex + 1


    if (quesindex >= 1) {
        progressarrowback.style.display = "block";
        document.querySelector(".progress-bar").style.display = "block";
        $('.progress-value').css("display", "block");

        $('.progress-bar').css("display", "block");

    }
    
    if (quesindex <= 1) {
        $('.progress-bar').css("display", "none");
        $('.progress-value').css("display", "block");
        $('.total-answered').html('Hello World');
        var str = "1/" + tques;
        $(".total-answered").html(str);
    }

    progressvalue.innerHTML = showindexIn + "/" + questions.length;

    var obtained = showindex;
    var total = tques;
    var percent = obtained * 100 / total;
    //console.log(percent);  
    //progress.setAttribute("style", "width: 40%;");

    if (percent > 0)
        $('.progress-bar').css("display", "block");

    progress.style.width = percent + "%";
    progress.style.background = "blue";
    quesindex++;
    console.log(sendinfo);
    var stringify = JSON.stringify(sendinfo);
    console.log(stringify);
    if (quesindex == tques - 1)
        nextbutton.textContent = "Submit";

    var f = score / tques;
    if (quesindex == tques) {
        q.style.display = 'none';
        quiz.style.display = 'none';
        progressarrowback.style.display = 'none';
        result.style.display = '';
        result.textContent = "thanks for sumitting ";
        console.log(sendinfo);
        progressvalue.innerHTML = '';
        //result.textContent="SCORED:"+(f*100).toFixed(2)+"%";
        //
        return r;

    }
    give_ques(quesindex);

}

// f  . ** end function Next qustions   **


// g  . ** generic load function 2   **


$(document).ready(function() {
    $('.giftfinderfirst__next').css("cursor", "defult");
    $('.giftfinderfirst__next').css("background-color", "#a06814");
    $('.giftfinderfirst__next').css("opacity", ".30");


    $('.giftfinder__next').css("cursor", "default");
    $('.giftfinder__next').css("background-color", "#a06814");
    $('.giftfinder__next').css("opacity", ".30");


      $('.question input').change(function(){
       $question_val =  $(this).val();
       if($question_val != ""){
           $('.giftfinder__next').css("cursor", "pointer");
            $('.giftfinder__next').css("background-color", "#a06814");

       }
    });

   
    $(".giftfinder__next").click(function() {
        $('.giftfinder__next').css("cursor", "defult");
        $('.giftfinder__next').css("background-color", "#a06814");
        $('.giftfinder__next').css("opacity", ".30");

    });

    $(":radio").on('click', function() {
        sendinfo[0] = $(".enter-name").val();
        if ($(this).is(':checked')) {
			var val = $(this).prev().find(".hideenValue").val();
			
            var html = $(this).prev().find("span.real").text();
			 //html=$(this).prev().find("span.real").text();
			 if(val && val!='')
			 {
				var html=val; 
				 
			 }
            var quesindexs = quesindex + 1;
            sendinfo[quesindexs] = html;

            $(this).parent().addClass("checkedradio");
            $('.giftfinder__next').css("cursor", "pointer");
            $('.giftfinder__next').css("background-color", "#a06814");

        } else {

            $(this).parent().removeClass("checkedradio");
            $('.giftfinder__next').css("cursor", "defult");
            $('.giftfinder__next').css("background-color", "#a06814");
            $('.giftfinder__next').css("opacity", ".30");
        }

    });

    $('.checkedradio input').on('click', function() {
       $('.giftfinder__next').css("cursor", "pointer");
       $('.giftfinder__next').css("background-color", "#a06814");
    });

});

// g  . ** generic load function 2   **



